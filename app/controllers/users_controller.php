<?php
	
	class UsersController extends AppController {
		
		var $actionsPermittedWithoutLogin = array(
			'login',
			'register'
		);
		
		/**ACTIONS WITH A CORRESPONDING VIEW**/
		
		/**
		 * Login action for the login view
		 */
		function login(){
			
			if($this->data) {
				$username = $this->data['User']['username'];
				$password = $this->data['User']['password'];
			} else if(func_num_args() == 2) {
				$username = func_get_arg(0);
				$password = func_get_arg(1);
			}
			
			if(isset($username) && isset($password)) {
			
				$verifies = $this->User->verify($username, $password);
				
				if($verifies) {
					$this->Session->write("User", $this->User->find('first', array('conditions' => array('username' => $username))));
					$this->Session->setFlash("You are now logged in.");
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash("Wrong username or password");
				}
			
			}
			
		}
		
		function register() {
			if(!empty($this->data)) {				
				if($this->User->register($this->data)) {
					$this->set('registrated', true);
				}
			}			
		}
		
		function dashboard() {
			$this->set('user', $this->Session->read('User'));
		}
		
		function editTags() {
			
			if(isset($this->data)) {
				$this->User->addTag($this->data);
			}
			
			$currentUserId = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
			
			$user = $this->User->findById($currentUserId);			
			$this->set('tags', $user['Tag']);
			$this->set('userId', $currentUserId);
			
		}
		
		/**ACTIONS WITHOUT A VIEW**/
		
		function index() {
			$this->redirect(array('action' => 'dashboard'));
		}
		
		function logout() {
			if($this->Session->read('User')) {
				$this->Session->delete('User');
				$this->Session->setFlash('You are now logged out.');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			} else {
				//We shouldn't be able to get here, since logout isnt permitted without login
				$this->Session->setFlash('You are already logged out.');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}
		}
		
		/**
		 * This is the pinnacle of my career.
		 * I'm tired of this ¤%&/#&% function. It works now...
		 * Also, cakes HABTM is awesome.
		 */
		function removeTagFromUser($tagId) {
			
			$userId = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
			
			$tags = $this->User->Tag->find('all');

			foreach($tags as &$tag) {
				if($tag['Tag']['id'] == $tagId) {
					
				} else {
					$tag['User'] = array();					
				}
			}
			
			$this->User->Tag->saveAll($tags);
			
			$this->redirect($this->referer());
			
		}
		
		/**ACTIONS THAT ARE MADE TO BE REQUESTED**/
		
		function isLoggedIn() {
			if(!$this->params['requested']) $this->cakeError('error404');
			
			if($this->Session->check('User')) return true;
			return false;
		}
		
		function getUserId() {
			if(!$this->params['requested']) $this->cakeError('error404');

			return $this->Session->read('User.User.id');
		}
		
		function getUser() {
			if(!$this->params['requested']) $this->cakeError('error404');
			
			return $this->Session->read('User');
		}
		
	}