<?php
	App::import('Sanitize');
	
	class AppModel extends Model {
		
		/**
	     * Matches one field against data (another field)
	     * @param $data to match with
	     * @param $field a field to match against
	     */
		function sameAs($data, $field) {
			$value = Set::extract($data, "{s}");
			return ($value[0] == $this->data[$this->name][$field]);
		}
	
	}