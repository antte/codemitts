<?php
	class TagFixture extends CakeTestFixture {
		
		var $name = 'Tag';
		
		var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'name' => array('type' => 'string', 'length' => 128)
		);
		
		var $records = array(
			array('id' => 1, 'name' => 'php')
		);
		
	}