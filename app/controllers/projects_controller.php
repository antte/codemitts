<?php
	
	class ProjectsController extends AppController {
		
		function view($mixed) {
			
			$mixed = Sanitize::clean($mixed);
			
			$project = $this->Project->findMixed($mixed);
			
			if(!$project) return;
			
			$this->set('project', $project);
			
		}
		
	}