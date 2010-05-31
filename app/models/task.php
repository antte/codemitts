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
		 * Given a tag return a random task with that tag
		 * @params mixed
		 * @return a task
		 */
		function random() {
			
			if(func_num_args() == 1) {
				
				if(!($dataSet = $this->Tag->findByName(func_get_arg(0))))
					$dataSet = $this->Tag->findById(func_get_arg(0));
					
				if($return = $dataSet['Task'][rand( 0, (sizeof($dataSet['Task'])-1))]) {
					return $return;
				} else {
					return false;
				}
				
			} else {
				
				$dataSet = $this->find('all');
				return $dataSet[rand( 0 ,(sizeof($dataSet)-1) )]['Task'];
				
			}
			
		}
		
	}