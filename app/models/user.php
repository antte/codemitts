<?php
	class User extends AppModel {
		
		public $hasMany = array(
			'TagsUser',
		);
		
		public $hasAndBelongsToMany = array(
			'Tag' => array('with' => 'TagsUser')
		);
		
		public $validate = array(
			'username' => array(
				'alphaNumeric' => array(
					'rule' => 'alphaNumeric',
					'required' => true,
					'message' => 'Username must contain only letters and numbers.',
				),
				'between' => array(
					'rule' => array('between', 4, 15),
					'message' => 'Username must be between 4 and 15 characters.'
				)
			),
			'password' => array(
				'between' => array(
					'rule' => array('between', 4, 64),
					'message' => 'Password must be between 4 and 64 characters.'
				)
			),
		);
		
		public function setState($user) {
			$this->user = $user;
			$user = $this->findById($user['User']['id']);
			$this->user['Tag'] = $user['Tag'];
		}
		
		/**
		 * Verifies that $username and $password is a valid user
		 * @param $username
		 * @param $password
		 * @return boolean
		 */
		public function verify($username, $password) {
			
			//Assumes username is unique
			$user = $this->find('first', array('conditions' => array('username' => $username), 'recursive' => -1));
			
			return ($user['User']['password'] == md5($password));
			
		}
		
		/**
		 * Add a new preferred tag on the user
		 * @param $userId
		 * @param $tagName
		 * @return unknown_type
		 */
		function addTag($data) {
			
			if(empty($data)) return false;
			
			$tag = $this->Tag->addTagIfNotExists($data['Tag']['name']);
			
			if(!$tag || empty($tag)) return false;
			
			unset($data['Tag']['name']);
			$data['Tag']['id'] = $tag['Tag']['id'];
			
			$this->Tag->set($data);
			
			return $this->Tag->save($this->data);
			
		}
		
		/**
		 * Fetch this users prefered tags.
		 * @param $userId
		 * @return array with strings
		 */
		function getPreferedTags($userId = null) {
			
			if(is_null($userId)) {
				$userId = $this->user['User']['id'];
			}
			
			$tags = array();
			$user = $this->findById($userId);
			
			foreach($user['Tag'] as $tag) {
				$tags[] = $tag['name'];
			}
			
			return $tags;
			
		}
		/*
		 * Checks if username is available
		 */
		function available($username) {
			
			if(!$username) {
				return false;
			}
			
			$user = $this->find('first', array('conditions' => array('User.username' => $username),'recursive' => -1));
			
			return empty($user);
			
		}
		
		public function isLoggedIn() {
			return ($this->user);
		}
		
		public function getUserId() {
			return $this->user['User']['id'];
		}
		
		public function getUser($mixed = null) {
			if(is_null($mixed)) {
				return $this->user;
			} else if (is_integer($mixed)) {
				return $this->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $mixed)));
			} else if (is_string($mixed)) {
				return $this->find('first', array('recursive' => -1, 'conditions' => array('User.username' => $mixed)));
			} else {
				return false;
			}
		}
		
	}