<?php
	class TasksController extends AppController {
		
		/**
		 * Tries to find a task for the user based upon his preferences
		 * puts that task in session and redirects to next step in the process
		 * @param mixed $taskType an id or string that corresponds to a tasktype (searches for type based on string first)
		 */
		function random() {
			
			$preferedTags = $this->requestAction(array('controller' => 'users', 'action' => 'getPreferedTags'));
			
			//Given array of tags give any task of that tag
			$this->Task->random();
			
		}
		
		function getTags() {
			if(!isset($this->params['requested'])) return;
			
			return $this->Task->Tag->find('list');
		}
		
	}