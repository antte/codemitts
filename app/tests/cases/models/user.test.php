<?php
	
	App::import('Model', 'User');
	
	class UserTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.user'
		);
		
		var $users = array(
			0 => array(
				'User' => array('username' => 'normalUser15', 'password' => 'zCv#5$6')
			),
			1 => array(
				'User' => array('username' => "'; DROP TABLE users_omg; --'", 'password' => 'maliciousmaster')
			)
		);
		
		function testVerify() {
			
			$this->User =& ClassRegistry::init('User');
			
			foreach($this->users as $user) {
				
				//retrieve a username and a password from the fixture
				$username = $user['User']['username'];
				$password = $user['User']['password'];
				
				$verifies = $this->User->verify($username, $password);
				
				if(!$verifies) {
					debug('Error using... Username: "' . $username . '" Password: "' . $password .'"');
				}
				
				$this->assertTrue($verifies);
				
			}
			
			// TODO test if weird input verifies false 
			
		}
		
	}