<?php
	class PagesController extends AppController {
		
		var $uses = array();
		
		var $contentTitles = array(
			'home' => 'Welcome to Codemitts'
		);
		
		function beforeFilter() {
			$this->Auth->allow('display', 'home');
		}
		
		function sidebar($action) {
			if(!isset($this->params['requested'])) $this->cakeError("error404");
			
			$options = array();
			
			if($action == "display") $options['sidebar']['elements'][0]['name'] = 'login_form';
			
			return $options;
			
		}
		
		/**
		 * Displays a view
		 * 
		 * @param mixed What page to display
		 * @access public
		 * @see cake/libs/controller/pages_controller.php
		 */
		function display() {
			$path = func_get_args();
	
			$count = count($path);
			if (!$count) {
				$this->redirect('/');
			}
			$page = $subpage = $title_for_layout = null;
	
			if (!empty($path[0])) {
				$page = $path[0];
			}
			if (!empty($path[1])) {
				$subpage = $path[1];
			}
			if (!empty($path[$count - 1])) {
				$title_for_layout = Inflector::humanize($path[$count - 1]);
			}
			$this->set(compact('page', 'subpage', 'title_for_layout'));
			
			if($page == "home") {
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			
			$this->render(implode('/', $path));
		}
		
	}