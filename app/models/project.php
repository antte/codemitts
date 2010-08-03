<?php
	class Project extends AppModel {
		var $hasMany = 'Task';
		var $automaticFields = array(
			'id',
			'created',
			'modified'
		);
		
		/**
		 * Tries to find a project by name first, then id
		 * If nothing is found return false 
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
		/**
		 * check schema, if any of the fields is automatic, remove it, return result
		 * @return unknown_type
		 */
		function getCreateFields() {
			$schema = array();
			foreach($this->_schema as $fieldName => $info) {
				if(!in_array($fieldName, $this->automaticFields)) {
					$schema[$fieldName] = $info;
				}
			}
			return $schema;
		}
		
	}