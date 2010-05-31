<?php
	class Tag extends AppModel {
		var $hasAndBelongsToMany = array(
			'User',
			'Task'
		);
	}