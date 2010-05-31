<?php
	class TasksController extends AppController {
		
		/**
		 * Tries to find a task for the user based upon tasktype,
		 * puts that task in session and redirects to next step in the process
		 * @param mixed $taskType an id or string that corresponds to a tasktype (searches for type based on string first)
		 */
		function random($taskType = null) {
			
			//TODO Needs code review where we:
			//	Refactor: Try to make this action shorter, easier or as easy to understand and more DRY
			
			//1.	If we got "all" from post try to find a random task of any type
			if($this->data['Tag']['id'] == 'all') {
				
				$task = $this->Task->random();
				
				//1.1	If we didn't find a task redirect back and tell user
				if(!$task) {
					$this->Session->setFlash("Sorry, we couldn't find a task for you. :[");
					$this->redirect($this->referer());
				}
				
			}
			
			//2.	If we have a tasktype from post try to find a random task of that type
			if(!$task && isset($this->data['Tag']['id'])) {
				
				$task = $this->Task->random($this->data['Tag']['id']);
				
				//2.1	If we didn't find a task with that type redirect back and tell user
				if(!$task) {
					$this->Session->setFlash("Sorry, we couldn't find a task with that type for you. :O");
					$this->redirect($this->referer());
				}	
				
			}
			
			//3.	If we got "all" as a parameter we do same as 1.
			if($taskTag == 'all') {
				
				$task = $this->Task->random();
				
				//1.1	If we didn't find a task redirect back and tell user
				if(!$task) {
					$this->Session->setFlash("Sorry, we couldn't find a task for you. :[");
					$this->redirect($this->referer());
				}
				
			}
			
			//4.	Lastly we check the first
			// 		parameter and try to find a random task of that type
			if($taskType) {
				
				$task = $this->Task->random($taskType);
				
				//4.1	If we didn't find a task with that type redirect back and tell user
				if(!$task) {
					$this->Session->setFlash("Sorry, we couldn't find a task for you. :[");
					$this->redirect($this->referer());
				}				
				
			}
			
			//5.	If we got a task by any method above we put it in session and send user along
			if ($task) {
				$this->Session->write('currentTask', $task);
				$this->redirect(array('controller' => 'projects', 'action' => 'view', $task['project_id']));
			} else {
				//5.1 	If not we redirect back and tell the user 
				$this->Session->setFlash("Sorry, we couldn't find a task for you. :C");
				$this->redirect($this->referer());
			}
			
		}
		
		function getTags() {
			if(!isset($this->params['requested'])) return;
			
			return $this->Task->Tag->find('list');
		}
		
	}