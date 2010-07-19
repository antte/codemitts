<?php
	
	App::import('Model', 'TagsUser');
	
	class TagsUsersTestCase extends CakeTestCase {
		
		var $fixtures = array(
			'app.tags_users',
			'app.user',
			'app.tag'
		);
		
	}