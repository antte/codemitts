<?php
	
	App::import('Model', 'Task');
	
	class TaskTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.task',
			'app.tag',
			'app.project'
		);
		
		function TaskTestCase() {
			$this->Task =& ClassRegistry::init('Task');
			
			/*
			 * This line shouldn't be nessessary cake is supposed to detect
			 * that we use fixtures and automatically use the "test" db connection
			 * if i understand this correctly:
			 * @see http://book.cakephp.org/view/358/Preparing-test-data#Creating-a-test-case-365
			 */
			$this->User->useDbConfig = "test";
		}
		
		/**
		 * Test the random functions output when not supplying any parameters
		 * Note: test will fail if you don't have tasks in your database since fixture is based upon the $database records not the $test records.
		 */
		function testRandomOutputWithoutParameters() {
			
			$result = $this->Task->random();
			
			//Now we want to test if random returns a task
			foreach ($this->Task->_schema as $fieldName => $unused) {
				//fieldName is a key in result (keys from schema and result matches ie result is a task or atleast has all the values of a task)
				$this->assertTrue(in_array( $fieldName ,array_keys($result)));
			}
		}
		
	}