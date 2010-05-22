<?php
	
	class ProjectsController extends AppController {
		
		function view($name) {
			
			$name = Sanitize::clean($name);
			
			$this->set('project', $this->Project->findByName($name));
			
		}
	}