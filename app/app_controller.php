<?php

	App::import('Sanitize');
	
	class AppController extends Controller {
		
		var $helpers = array(
			'Html',
			'Form',
			'Javascript',
			'Session'
		);
		
		/**
		 * This function will be called each time a user requests a new page
		 * (non-PHPdoc)
		 * @see cake/libs/controller/Controller#beforeFilter()
		 */
		function beforeFilter() {
			
			if( 
				//We want to always allow the application to check if the user is logged in
				$this->params['action'] == 'isLoggedIn' && 
				$this->params['controller'] == 'users'
			) {
				return; //proceed as normal
			}
			
			if( 
				//primitive UAC
				!$this->requestAction(array('controller' => 'users', 'action' => 'isLoggedIn')) &&
				!$this->actionIsPermittedWithoutLogin()
			) {
				$this->Session->setFlash("You have to be logged in to do that.", "user_error");
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			} else {
				return; //proceed as normal
			}
			
			//Always fall back to a safe option?
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
			
		}
		
		/**
		 * Checks to see if the action is one of the action permitted for guests to view without being logged in
		 * @return true if current controller/action is permitted without being logged in
		 */
		function actionIsPermittedWithoutLogin() {
			if( 
				isset($this->actionsPermittedWithoutLogin) &&
				!empty($this->actionsPermittedWithoutLogin)
			) {
				foreach($this->actionsPermittedWithoutLogin as $action) {
					if( !is_string($action) ) continue;
					if( low($this->params['action']) == low($action) ) return true;
				}
			} else {
				return false;
			}
			
		}
		
	}