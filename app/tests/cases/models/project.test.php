<?php
	
	App::import('Model', 'Project');
	
	class ProjectTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.project',
			'app.task',
			'app.user'
		);
		
		function ProjectTestCase() {
			$this->Project =& ClassRegistry::init('Project');
			
			/*
			 * This line shouldn't be nessessary cake is supposed to detect
			 * that we use fixtures and automatically use the "test" db connection
			 * if i understand this correctly:
			 * @see http://book.cakephp.org/view/358/Preparing-test-data#Creating-a-test-case-365
			 */
			$this->Project->useDbConfig = "test";
		}
		
	}