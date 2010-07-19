<?php

	App::import('Sanitize');
	
	class AppController extends Controller {
		
		var $helpers = array(
			'Html',
			'Form',
			'Javascript',
			'Session'
		);
		
		var $appControllerActionsPermittedWithoutLogin = array(
			array('controller' => 'users', 'action' => 'isLoggedIn'),
			array('controller' => 'any', 'action' => 'appSidebar'),
			array('controller' => 'any', 'action' => 'sidebar'),
			array('controller' => 'any', 'action' => 'getContentTitle'),
		);
		
		var $defaultContentTitle = "Codemitts";
		
		function beforeRender() {
			$this->set('content_title', $this->getContentTitle());
		}
		
		/**
		 * This function will be called:
		 *  each time a user requests a new page
		 *  each time an action is requested
		 *  
		 * (non-PHPdoc)
		 * @see cake/libs/controller/Controller#beforeFilter()
		 */
		function beforeFilter() {
			
			foreach($this->appControllerActionsPermittedWithoutLogin as $pair) {
				if(
					$this->params['action'] == $pair['action'] &&
					(
						$this->params['controller'] == $pair['controller'] || 
						$pair['controller'] === 'any'
					)
				) {
					return; //proceed as normal
				}
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
		
		function sidebar($action) {
			//Fallback
			return array();
		}
		
		function appSidebar($action) {
			
			if(!isset($this->params['requested'])) $this->cakeError("error404");
			
			return $this->requestAction( 
				array(
					'controller' => $this->params['controller'], 
					'action' => 'sidebar'
				),
				array(
					'pass' => array($action)
				)
			);
		}
		
		protected function getContentTitle() {
			if(isset($this->contentTitles)) {
				if($this->params['controller'] == 'pages') {
					//pages controller needs to be handled differently because it renders views differently (with display)
					return $this->contentTitles[$this->params['pass'][0]];
				}
				return $this->contentTitles[$this->params['action']];
			} else {
				return $this->defaultContentTitle;
			}
		}
		
	}