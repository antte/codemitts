<?php
	class Task extends AppModel {
		
		var $belongsTo = 'Project';
		
		/**
		 * Given a taskType return a random task
		 * @param $taskType
		 * @return a task
		 */
		function random($taskType) {

			$task = array();
			
			return $task;
			
		}
		
	}