<?php
	
	class ProjectsController extends AppController {
		
		function view($mixed) {
			
			$mixed = Sanitize::clean($mixed);
			
			if( !($project = $this->Project->findByName($mixed)) ) {
				if( is_numeric($mixed) ) {
					$project = $this->Project->findById($mixed);
				} else {
					return; //404
				}
			}
			
			$this->set('project', $project);
			
		}
		
	}