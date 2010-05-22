<?php
	class Tasktype extends AppModel {
		var $hasAndBelongsToMany = 'Task';
	}