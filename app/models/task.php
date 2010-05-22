<?php
	class Task extends AppModel {
		
		var $belongsTo = 'Project';
		var $hasAndBelongsToMany = 'Tasktype';
		
		/**
		 * Given a taskType return a random task
		 * @param $taskType
		 * @return a task
		 */
		function random($taskType) {
			
			$dataSet = $this->Tasktype->findByName($taskType);
			
			return $dataSet['Task'][rand( 0, (sizeof($dataSet['Task'])-1))];
			
		}
		
	}