<?php
	
	class UsersController extends AppController {
		
		function beforeFilter() {
			if(!$this->Session->check("loggedIn")) {
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
		
		/**
		 * Checks to see if the action is one of the action permitted for guests to view without being logged in
		 * @param $action the action to be checked
		 */
		function actionIsPermitted($action) {
			//hilol :d
			if ($action == "login") return true;
			else return false;
		}
		
	}