<?php
	
	class UsersController extends AppController {
		
		var $permittedActionsWithoutLogin = array(
			'login',
			'register'
		);
		
		function beforeFilter() {
			if(!$this->Session->read("loggedIn")) {
				if (!$this->actionIsPermitted($this->params['action']))
					//how horribly will this fail if login isnt one of the permitted actions :D
					$this->redirect(array('action' => 'login'));
			}
		}
		
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
					$this->Session->write("loggedIn", 1);
					$this->Session->setFlash("You are now logged in.");
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash("Wrong username or password");
				}
			
			}
			
		}
		
		/**
		 * Checks to see if the action is one of the action permitted for guests to view without being logged in
		 * @param $action the action to be checked
		 */
		function actionIsPermitted($action) {
			if 		(in_array($action, $this->permittedActionsWithoutLogin)) return true;
			else return false;
		}
		
		function logout() {
			if($this->Session->read('loggedIn')) {
				$this->Session->write("loggedIn", 0);
				$this->Session->setFlash('You are now logged out.');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			} else {
				//We shouldn't be able to get here, since logout isnt permitted without login
				$this->Session->setFlash('You are already logged out.');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}
		}
		
		function register() {
			if(!empty($this->data)) {
				$this->User->set($this->data);
				if($this->User->save()) {
					$this->set('registrated', true);
				}
			}			
		}
		
	}