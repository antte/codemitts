<?php
	class TagsUsersFixture extends CakeTestFixture {
		
		var $name = 'TagsUsers';
		
		var $import = array('table' => 'test_data_tags_users', 'connection' => 'test', 'records' => true);
		/*
		var $records = array(
			array('tag_id' => 1, 'user_id' => 1)
		);
		*/
	}