<?php
	
	App::import('Model', 'Task');
	
	class TaskTestCase extends CakeTestCase {
		
		var $fixtures = array('app.task');
		
		/**
		 * test the random functions output when not supplying any parameters
		 * Note: test will fail if you don't have tasks in your database
		 */
		function testRandomOutputWithoutParameters() {
			
			//We start by creating an instance of our fixture based Task model
			$this->Task =& ClassRegistry::init('Task');
			
			//and then run our random() method.
			$result = $this->Task->random();
			
			//Now we want to test if random returns a task
			foreach ($this->Task->_schema as $fieldName => $infos) { 
				//fieldName is a key in result (keys from schema and result matches ie result is a task or atleast has all the values of a task)
				$this->assertTrue(in_array( $fieldName ,array_keys($result)));
			}
			
		}
		
	}