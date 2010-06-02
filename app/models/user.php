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
		
		function beforeSave() {
			$this->data['User']['password'] = md5($this->data['User']['password']);
			$this->data['User']['repassword'] = md5($this->data['User']['repassword']);
			return true;
		}
		
		/**
		 * Checks if its a valid user
		 * @param $username
		 * @param $password
		 */
		function verify($username, $password) {
			
			$username = Sanitize::clean($username);
			$password = Sanitize::clean($password);
			
			$user = $this->findByUsername($username);
			
			if($user['User']['password'] == md5($password))
				return true;
			else
				return false;
			
		}
		
	}