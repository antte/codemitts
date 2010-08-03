<?php

	App::import('Sanitize');
	
	class AppController extends Controller {
		
		public $helpers = array(
			'Html',
			'Form',
			'Javascript',
			'Session'
		);
		
		public $components = array(
			'Auth',
			'Session',
		);
		
		private $controllersToAppearInNavigation = array(
			'users',
			'tasks',
			'projects',
		);
		
		private $navElements = array();
		
		public function beforeFilter() {
			$this->Auth->loginError = 'Wrong username or password';
			$this->Auth->authError = 'You have to be logged in to do that.';
		}
		
		/*
		 * This function is meant to be overridden by a controller
		 */
		public function sidebar($action) {
			//Fallback
			return array();
		}
		
		public function appSidebar($action) {
			
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
		
		public function getHumanTitle() {
			
			if(!isset($this->params['requested'])) $this->cakeError('error404');
			
			if(isset($this->humanTitle)) {
				return $this->humanTitle;
			} else {
				return Inflector::humanize($this->params['controller']);
			}
			
		}
		
		public function buildNavElements($currentAction) {
			
			if(!isset($this->params['requested'])) $this->cakeError('error404');
			
			if( !isset($this->controllersToAppearInNavigation) 
			    || empty($this->controllersToAppearInNavigation)
			) {
				return array();
			}
			
			//Lets start building the nav elements array
			$this->navElements = array();
			
			$currentController 	= $this->params['controller'];
			
			for ($i = 0; $i < sizeof($this->controllersToAppearInNavigation); $i++) {
				
				$controller = $this->controllersToAppearInNavigation[$i];
				
				$this->navElements[$i]['label'] = $this->requestAction(array(
					'controller' 	=> $controller,
					'action' 		=> 'getHumanTitle',
				));
				
				$this->navElements[$i]['controller'] = $controller;
				
				$this->navElements[$i]['action'] = 'index';
				
				if($currentController == $controller) {
					$this->navElements[$i]['classes'] = array('current');
				} else {
					$this->navElements[$i]['classes'] = array('not_current');
				}
				
				$subElements = $this->requestAction(array(
					'controller' 	=> $controller,
					'action' 		=> 'buildSubNavElements',
				));
				
				if (
						isset($subElements) 
					 && !empty($subElements)
					 && $subElements
				) {
					$this->navElements[$i]['sub_elements'] = $subElements;
					
					if($currentController == $controller) {
						foreach($this->navElements[$i]['sub_elements'] as &$sub_element) {
							if($sub_element['action'] == $currentAction) {
								$sub_element['classes'] = array('current');
							}
						}
					}
					
				} else {
					$this->navElements[$i]['sub_elements'] = array();
				}
				
				
			}
			
			return $this->navElements;
			
		}
		
		/*
		 * Meant to be overridden by controllers
		 */
		public function buildSubNavElements() {
			
			if(!isset($this->params['requested'])) $this->cakeError('error404');
			
			if(isset($this->actionsToAppearInNavigation)) {
				return $this->actionsToAppearInNavigation;
			}
			
		}
		
	}