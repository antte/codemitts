<?php
	class Project extends AppModel {
		var $belongsTo = 'User';
		var $hasMany = 'Task';
	}