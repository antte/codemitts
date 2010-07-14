<?php
	
	App::import('Model', 'User');
	
	class UserTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.user',
			'app.tag',
			'app.project'
		);
		
		var $testUsers = array(
			0 => array(
				'User' => array('username' => 'normalUser15', 'password' => 'zCv#5$6')
			),
			1 => array(
				'User' => array('username' => "'; DROP TABLE users_omg; --'", 'password' => 'maliciousmaster')
			)
		);
		
		var $testTags = array(
			'',
			'php',
			'some345678thing324567weird3456789'
		);
		
		function UserTestCase() {
			$this->User =& ClassRegistry::init('User');
			
			/*
			 * This line shouldn't be nessessary cake is supposed to detect
			 * that we use fixtures and automatically use the "test" db connection
			 * if i understand this correctly:
			 * @see http://book.cakephp.org/view/358/Preparing-test-data#Creating-a-test-case-365
			 */
			$this->User->useDbConfig = "test";
		}
		
		function testVerify() {
			
			foreach($this->testUsers as $user) {
				
				//retrieve a username and a password from the fixture
				$username = $user['User']['username'];
				$password = $user['User']['password'];
				
				$verifies = $this->User->verify($username, $password);
				
				if(!$verifies) {
					debug('Error using... Username: "' . $username . '" Password: "' . $password .'"');
				}
				
				$this->assertTrue($verifies);
				
			}
			
		}
		
		function testAddTag() {
			
			$user = $this->User->find('first');
			
			foreach($this->testTags as $tag) {
				
				$data['User']['id'] = $user['User']['id'];
				$data['Tag']['name'] = $tag;
				
				$this->User->addTag($data);
				
				$userAfter = $this->User->findById($user['User']['id']);
				
				$tagWasAdded = in_array( array('id' => $this->User->Tag->id, 'name' => $tag) ,$userAfter['Tag']);
				
				if(!$tagWasAdded) {
					debug('The tag "'.$tag.'" was not added.');
				}
				
				$this->assertTrue($tagWasAdded);
				
			}
			
		}
		
	}