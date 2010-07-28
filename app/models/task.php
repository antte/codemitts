<?php
	class Task extends AppModel {
		
		var $belongsTo = 'Project';
		var $hasAndBelongsToMany = array(
			'Tag' => array(
				'className' =>  'Tag',
				'joinTable' => 'tags_tasks',
				'foreignKey' => 'task_id',
				'associationForeignKey' => 'tag_id'
			)
		);
		
		/**
		 * Return a random task that has any of the given tags
		 * @param array $tags
		 * @param boolean $inclusive
		 * @return a task
		 */
		function random($tags = array()) {
			
			$tasks = $this->find('all');
			
			if(!empty($tags)) {
				for($i = 0; $i < sizeof($tasks); $i++) {
					
					$hasAnyOfTheTags = false;
					
					foreach($tasks[$i]['Tag'] as $taskTag) {
						foreach($tags as $tag) {
							if($taskTag['name'] == $tag) {
								$hasAnyOfTheTags = true;
							}
						}
					}
					
					if($hasAnyOfTheTags) {
						continue;
					} else {
						unset($tasks[$i]);
					}
					
				}
			}
			
			$random = rand( 0 ,(sizeof($tasks)-1) );
			
			$i = 0;
			
			foreach($tasks as $task) {
				
				if($i == $random) {
					return $task;
				}
				
				$i++;
				
			}
			
		}
		
	}