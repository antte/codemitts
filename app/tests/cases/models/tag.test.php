<?php
	
	App::import('Model', 'Tag');
	
	class TagTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.tag',
			'app.task',
			'app.user'
		);
		
		var $testTags = array(
			'php',
			'finnsinte'
		);
		
		function TagTestCase() {
			$this->Tag =& ClassRegistry::init('Tag');
			
			/*
			 * This line shouldn't be nessessary cake is supposed to detect
			 * that we use fixtures and automatically use the "test" db connection
			 * if i understand this correctly:
			 * @see http://book.cakephp.org/view/358/Preparing-test-data#Creating-a-test-case-365
			 */
			$this->User->useDbConfig = "test";
		}
		
		function testAddTagIfNotExists() {
			
			foreach($this->testTags as $tag) {
				
				$tagBefore = $this->Tag->find('all', array('conditions' => array('name' => $tag)));
				
				$returned = $this->Tag->addTagIfNotExists($tag);
				
				$tagAfter = $this->Tag->find('all', array('conditions' => array('name' => $tag)));
				
				$this->assertTrue( !empty($tagAfter) , 'Cannot retrieve tag "'.$tag.'" after operation' );
				
				$foundMoreThanOneTagAfter = false;
				if(sizeof($tagAfter) > 1) {
					$foundMoreThanOneTagAfter = true;
				}
				
				$this->assertFalse( $foundMoreThanOneTagAfter , 'Found more than one tag with tagname "'.$tag.'"' );
					
				if(!empty($tagBefore))
					$this->assertEqual( $tagBefore, $tagAfter, 'Tagname "'.$tag.'" changed by operation' );
				
				//Check if tag is returned
				$this->assertTrue( $returned['Tag']['name'] == $tag, 'Tag "'.$tag.'" was not correctly returned by operation' );
			}
			
		}
		
	}