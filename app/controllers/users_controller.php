<?php
	
	class UsersController extends AppController {
		
		public $humanTitle = "User";
		
		protected $actionsPermittedWithoutLogin = array(
			'login',
			'register'
		);
		
		protected $actionsToAppearInNavigation = array(
			0 => array(
				'label' 	=> 'Profile',
				'action' 	=> 'view',
			),
			1 => array(
				'label' 	=> 'Tags',
				'action' 	=> 'editTags',
			),
		);
		
		
		/**ACTIONS WITH A CORRESPONDING VIEW**/
		
		function view($user = null) {
			$this->set('user', $this->Session->read('User'));
		}
		
		function editTags() {
			
			if(isset($this->data)) {
				$this->User->addTag($this->data);
			}
			
			$currentUserId = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
			
			$user = $this->User->findById($currentUserId);			
			$this->set('tags', $user['Tag']);
			$this->set('userId', $currentUserId);
			
		}
		
		/**ACTIONS WITHOUT A VIEW**/
		
		function index() {
			$this->redirect(array('action' => 'view'));
		}
		
		function login(){
			
			if($this->data) {
				$username = $this->data['User']['username'];
				$password = $this->data['User']['password'];
			} else if(func_num_args() == 2) {
				$username = func_get_arg(0);
				$password = func_get_arg(1);
			}
			
			if(isset($username) && isset($password)) {
			
				$verifies = $this->User->verify($username, $password);
				
				if($verifies) {
					$this->Session->write("User", $this->User->find('first', array('conditions' => array('username' => $username))));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash("Wrong username or password", "user_notice");
					$this->redirect($this->referer());
				}
			
			}
			
		}
		
		function register() {
			if(!empty($this->data)) {				
				if($this->User->register($this->data)) {
					$this->Session->setFlash("You are registered! Try logging in.", 'user_notice');
					$this->redirect($this->referer());
				} else {
					$this->Session->setFlash("Something went wrong. Try again please.", 'user_error');
					$this->redirect($this->referer());
				}
			}			
		}
		
		function logout() {
			
			if($this->Session->read('User')) {
				$this->Session->delete('User');
			}
			
			$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			
		}
		
		/**
		 * This is the pinnacle of my career.
		 * I'm tired of this ¤%&/#&% function. It works now...
		 * Also, cakes HABTM is awesome.
		 */
		function removeTagFromUser($tagId) {
			
			$userId = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
			
			$tags = $this->User->Tag->find('all');

			foreach($tags as &$tag) {
				if($tag['Tag']['id'] == $tagId) {
					
				} else {
					$tag['User'] = array();					
				}
			}
			
			$this->User->Tag->saveAll($tags);
			
			$this->redirect($this->referer());
			
		}
		
		/**ACTIONS THAT ARE MADE TO BE REQUESTED**/
		
		function isLoggedIn() {
			if(!$this->params['requested']) $this->cakeError('error404');
			
			if($this->Session->check('User')) return true;
			return false;
		}
		
		function getUserId() {
			if(!$this->params['requested']) $this->cakeError('error404');

			return $this->Session->read('User.User.id');
		}
		
		function getUser() {
			if(!$this->params['requested']) $this->cakeError('error404');
			
			return $this->Session->read('User');
		}
		
		/**
		 * 
		 * @param optional int $userId
		 * @return prefered tags
		 */
		function getPreferedTags($id = null) {
			if(!$this->params['requested']) $this->cakeError('error404');
			
			$preferedTags = array();
			
			if($id) {
				$preferedTags = $this->User->getPreferedTags($id);
			} else {
				$preferedTags = $this->User->getPreferedTags($this->requestAction(array('controller' => 'users', 'action' => 'getUserId')));
			}
			
			if(!empty($preferedTags) && $preferedTags) {
				return $preferedTags;
			} else {
				return false;
			}
			
		}
		
	}