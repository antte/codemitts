<?php
	
	class UsersController extends AppController {
		
		/**
		 * Login action for the login view
		 */
		function login(){
			if($this->data) {
				
				$verifies =
				$this->User->verify($this->data['User']['username'], $this->data['User']['password']);
				
				if($verifies) {
					$this->Session->write("loggedIn", 1);
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash("Wrong username or password");
				}
				
			}
		}
	}