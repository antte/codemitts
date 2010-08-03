<?php 
	class AllGroupTest extends GroupTest { 
		var $label = 'all'; 
		
		function allGroupTest() {
			TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'models');
			TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'helpers'); 
			TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'controllers'); 
			TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'components'); 
			TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'behaviors'); 
		}
		
	} 