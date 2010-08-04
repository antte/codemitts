<?php
	class TasksController extends AppController {
		
		protected $actionsToAppearInNavigation = array(
			1 => array(
				'label' 	=> 'Give me a random task!',
				'action' 	=> 'random',
			),
		);
		
		public function index() {
			$this->redirect(array('action' => 'view'));
		}
		
		public function view($name = null) {
			
			if($name) {
				$this->set('task', $this->Task->findByName($name));
			} else {
				$this->set('tasks', $this->Task->find('all'));
			}
			
		}
		
		/**
		 * Tries to find a task for the user based upon his preferences
		 * puts that task in session and redirects to next step in the process
		 * @param mixed $taskType an id or string that corresponds to a tasktype (searches for type based on string first)
		 */
		function random() {
			
			$preferedTags = $this->requestAction(array('controller' => 'users', 'action' => 'getPreferedTags'));
			
			$task = $this->Task->random($preferedTags);
			
			if(!$task || empty($task)) {
				$this->Session->setFlash("Sorry, couldn't find a task for you.", 'user_notice');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			
			$this->Task->id = $task['Task']['id'];
			
			$this->Task->lock();
			
			$this->redirect(array('action' => 'view', $task['Task']['name']));
			
		}
		
		function getTags() {
			if(!isset($this->params['requested'])) return;
			
			return $this->Task->Tag->find('list');
		}
		
	}