<?php
	class Tag extends AppModel {
		var $hasAndBelongsToMany = array(
			'Task',
			'User' => array('with' => 'TagsUser')
		);
		
		var $hasMany = array(
			'TagsUser'
		);
		
		/**
		 * @param string $tagName
		 * @return array the tag, whether it existed already or was just created
		 */
		function addTagIfNotExists($tagName) {
			
			$tag = $this->find('first', array('conditions' => array('name' => $tagName), 'recursive' => -1));
			
			if($tag) {
				return $tag;
			} else {
				$this->set('name', $tagName);
				$success = $this->save($this->data);
				
				if($success) {
					return $this->find('first', array('conditions' => array('id' => $this->id), 'recursive' => -1));
				} else {
					return false;
				}
			}
			
		}
		
	}