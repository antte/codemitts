<?php
	class User extends AppModel {
		
		var $hasMany = 'Project';
		var $hasAndBelongsToMany = array('Tag');
		
		/**
		 * Checks if its a valid user
		 * @param $username
		 * @param $password
		 */
		function verify($username, $password) {
			
			$user = $this->findByUsername($username);
			
			if($user['User']['password'] == md5($password))
				return true;
			else
				return false;
			
		}
		
	}