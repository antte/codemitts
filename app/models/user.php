<?php
	class User extends AppModel {
		
		var $hasMany = 'Project';
		var $hasAndBelongsToMany = array('Tag');
		
		var $validate = array(
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
			'repassword' => array (
	 			'password_verification' => array(
					'rule' => array('sameAs', 'password'),
					'message' => 'You have to fill in the same password again.'
				)
	 		)
		);
		
		/**
		 * Verifies that $username and $password is a valid user
		 * @param $username
		 * @param $password
		 * @return boolean
		 */
		function verify($username, $password) {
			
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
		 * 
		 * @param $data User data
		 * @return true on success
		 */
		function register($data = null) {
			$data['User']['password'] = md5($data['User']['password']);
			$data['User']['repassword'] = md5($data['User']['repassword']);
			
			$user = $this->save($data);
			return !empty($user);
		}
		
	}