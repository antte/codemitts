<?php
	
	class ProjectsController extends AppController {
		
		function view($mixed) {
			
			$mixed = Sanitize::clean($mixed);
			
			$project = $this->Project->findMixed($mixed);
			
			if(!$project) {
				$this->cakeError("error404");
			} 
			
			$this->set('project', $project);
			
		}
		
		/**
		 * Create new project
		 */
		function create() {
			$this->set('fields', $this->Project->getCreateFields());
			
			if(!empty($this->data)) {
				
				$this->data['Project']['user_id'] = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
				
				$this->Project->set($this->data);
				$success = $this->Project->save($this->Project->data);
				
				if ($success) {
					$this->redirect(array('action' => 'view', $this->Project->id));
				} else {
					$this->setFlash("Something went wrong.", "user_error");
				}
				
			}
			
		}
		
	}