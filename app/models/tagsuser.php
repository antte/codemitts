<?php
	class TagsUser extends AppModel {
		
		var $belongsTo = array(
			'Tag',
			'User'
		);
		
	}