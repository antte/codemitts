<?php
	class Task extends AppModel {
		
		var $belongsTo = 'Project';
		var $hasAndBelongsToMany = 'Tasktype';
		
		/**
		 * Given a taskType return a random task of that type
		 * @params mixed
		 * @return a task
		 */
		function random() {
			
			if(func_num_args() == 1) {
				
				if(!($dataSet = $this->Tasktype->findByName(func_get_arg(0))))
					$dataSet = $this->Tasktype->findById(func_get_arg(0));
				
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