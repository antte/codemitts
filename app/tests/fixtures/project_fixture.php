<?php
	class ProjectFixture extends CakeTestFixture {
		
		var $name = 'Project';
		
		var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'name' => array('type' => 'string', 'length' => 128),
			'description' => array('type' => 'text'),
			'user_id' => array('type' => 'integer'),
			'created' => array('type' => 'datetime'),
			'modified' => array('type' => 'datetime')
		);
		
		var $records = array(
			array('id' => 1, 'name' => 'someproject', 'description' => 'hilol', 'user_id' => 1, 
			'created' => '2010-05-22 00:00:00', 'modified' => '2010-05-22 00:00:00')
		);
		
	}