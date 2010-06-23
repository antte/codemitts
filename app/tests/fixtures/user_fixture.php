<?php
	class UserFixture extends CakeTestFixture {
		
		var $name = 'User';
		
		var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'username' => array('type' => 'string', 'length' => 128),
			'password' => array('type' => 'string', 'length' => 128)
		);
		
		var $records = array(
			array('id' => 1, 'username' => 'normalUser15', 'password' => 'd79aeddd52e8d918c199e708809d3078'),
			array('id' => 2, 'username' => "'; DROP TABLE users_omg; --'", 'password' => 'a61d0b1bc4b3d333671efe8ce079d7fd')
		);
		
	}