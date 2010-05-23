<?php
	class TasksController extends AppController {
		
		/**
		 * gives user a random task
		 */
		function random($taskType = null) {
			
			if(isset($this->data['Tasktype']['id']) && !($this->data['Tasktype']['id'] == 'all') ) {
				$task = $this->Task->random($this->data['Tasktype']['id']);
			} elseif($taskType) {
				//if we have $taskType but can't find a random task by it 404
				if(!($task = $this->Task->random($taskType))) return;
			} else {
				$task = $this->Task->random();
			}
				
			$this->Session->write('currentTask', $task);
			
			$this->redirect(array('controller' => 'projects', 'action' => 'view', $task['project_id']));
			
		}
		
		function getTasktypes() {
			if(!isset($this->params['requested'])) return;
			
			return $this->Task->Tasktype->find('list');
		}
		
	}