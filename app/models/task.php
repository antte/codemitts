<?php
	class Task extends AppModel {
		
		var $belongsTo = array(
			'Project',
		);
		var $hasMany = array('TagsTask');
		private $lockTime = 1800; //seconds
		var $hasAndBelongsToMany = array(
			'Tag' => array('with' => 'TagsTask')
		);
		
		/**
		 * Return a random task that has any of the given tags
		 * @param array $tags
		 * @param boolean $inclusive
		 * @return a task
		 */
		public function random($tags = array()) {
			
			$tasks = array();
			
			if(!empty($tags)) {
				
				$tags = $this->Tag->getTagIdByName($tags);

				$tagstasks = $this->TagsTask->find('all', array('recursive' => -1, 'conditions' => array('TagsTask.tag_id' => $tags)));
				
				$taskIds = array();
				
				foreach($tagstasks as $tagtask) {
					//God, what am i doing? Say tagstasks quickly 10 times.
					
					if(!$this->isLocked($tagtask['TagsTask']['task_id'])) {
						$taskIds[] = $tagtask['TagsTask']['task_id'];
					}
					
				}
				
				if(empty($taskIds)) return false;
				
				$tasks = $this->find('all', array('conditions' => array('Task.id' => $taskIds)));
				
			} else {
				$tasks = $this->Task->find('all');
			}
			
			return $tasks[rand( 0 ,(sizeof($tasks)-1) )];
			
		}
		
		/**
		 * Determines if a task is locked
		 * @return true if task is locked, false if not
		 */
		public function isLocked($taskId = null) {
			
			if(!$taskId) $taskId = $this->id;
			
			$task = $this->findById($taskId);
			
			if($task['Task']['locked'] === null) {
				return false;
			}
			
			$timeDiff = (mktime() - strtotime($task['Task']['locked']));
			
			if($timeDiff < 0) {
				return true;
			} else if($timeDiff < $this->getLockTime()) {
				return true;
			} else if ($timeDiff > $this->getLockTime()) {
				$this->unlock($taskId);
				return false;
			}
			
			//fallback
			return true;
			
		}
		
		public function unlock($taskId = null) {
			
			if( $taskId === null
			 && isset($this->id)
			)   $taskId = $this->id;
			
			if (
				!$this->exists($taskId)
			) {
				$this->cakeError('internal');
			}
			
			$this->read(array('locked', 'locked_by'), $taskId);
			
			$this->data['Task']['locked'] = null;
			$this->data['Task']['locked_by'] = null;
			
			if($this->save()) {
				return true;
			} else {
				$this->cakeError('internal');
			}
			
		}
		
		public function lock($taskId, $userId) {
			
			if (
				!Classregistry::init('User')->exists($userId)
			 || !$this->exists($taskId)
			) {
				$this->cakeError('internal');
			}
			
			$this->read(array('locked', 'locked_by'), $taskId);
			
			$this->data['Task']['locked'] = date('Y-m-d H:i:s');
			$this->data['Task']['locked_by'] = $userId;
			
			return $this->save();
			
		}
		
		public function getLockTime() {
			return $this->lockTime;
		}
		
		public function setLockTime($newTime) {
			
			if(!is_integer($newTime)) {
				$this->cakeError('internal');
			}
			
			return $this->lockTime = $newTime;
			
		}
	}