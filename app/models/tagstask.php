<?php
	class TagsTask extends AppModel {
		
		var $belongsTo = array(
			'Tag',
			'Task'
		);
		
	}