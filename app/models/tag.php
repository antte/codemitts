<?php
	class Tag extends AppModel {
		var $hasAndBelongsToMany = array(
			'Task' => array('with' => 'TagsTask'),
			'User' => array('with' => 'TagsUser'),
		);
		
		var $hasMany = array(
			'TagsUser',
			'TagsTask',
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
		
		public function getTagIdByName($mixed) {
			
			$tagNames = array();
			
			if(is_string($mixed)) {
				$tagNames[0] = $mixed;
			} else if (is_array($mixed)) {
				$tagNames = $mixed;
			} else {
				return false;
			}
			
			$tagIds = array();
			
			foreach($tagNames as $tagName) {
				$tag = $this->find('first', array('conditions' => array('Tag.name' => $tagName), 'fields' => array('Tag.id'), 'recursive' => -1));
				$tagIds[] = $tag['Tag']['id'];
			}
			
			if(is_string($mixed)) {
				return $tagIds[0];
			}
			
			return $tagIds;
			
		}
		
	}