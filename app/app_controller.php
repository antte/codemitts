<?php

	App::import('Sanitize');
	
	class AppController extends Controller {
		var $helpers = array(
			'Html',
			'Form',
			'Javascript',
			'Session'
		);
	}