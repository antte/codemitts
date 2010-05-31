<?php
	class Project extends AppModel {
		var $belongsTo = 'User';
		var $hasMany = 'Task';
		
		/**
		 * tries to find a project by name first, then id
		 * if nothing is found return false 
		 * @param $mixed
		 * @return mixed
		 */
		function findMixed($mixed) {
			
			//Try to find project by name
			$project = $this->find('first', array('conditions' => array('Project.name' => $mixed), 'recursive' => 2));
			
			//If no project is found by name try and find by id
			if(!$project && is_numeric($mixed)) {
				$project = $this->find('first', array('conditions' => array('Project.id' => $mixed), 'recursive' => 2));				
			}
			
			//If no project is found by id either, return false
			if(!$project) return false;
			
			return $project;
			
		}
	}