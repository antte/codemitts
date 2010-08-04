<?php
	
	class UsersController extends AppController {
		
		public $humanTitle = "User";
		
		protected $actionsPermittedWithoutLogin = array(
			'login',
			'register',
			'checkAvailability',
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
		
		function beforeFilter() {
			$this->{$this->modelClass}->setState($this->Auth->user());
			$this->Auth->allow('login', 'logout', 'register', 'checkAvailability');
			$this->Auth->autoRedirect = false;
			parent::beforeFilter();
		}
		
		/**ACTIONS WITH A CORRESPONDING VIEW**/
		
		function view($username = null) {
			
			if(is_null($username)) {
				$user = $this->User->getUser();
			} else {
				$user = $this->User->getUser($username);
			}
			
			$this->set('user', $user);
			
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
		
		function login(){
			$this->layout = 'welcome';
			if(!empty($this->data) && $this->Auth->user()) {
				// User just logged in successfully
				if(
					$this->Auth->redirect() == '/users/login'
				 || $this->Auth->redirect() == '/'
				 || $this->Auth->redirect() == '/pages/home'
				 || $this->Auth->redirect() == '/pages'
				) {
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				} else {
					$this->redirect($this->Auth->redirect());
				}
			}
		}
		
		/**ACTIONS WITHOUT A VIEW**/
		
		function index() {
			$this->redirect(array('action' => 'view'));
		}
		
		function register() {
			if($this->data) {
				if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['repassword'])) {
					
					$this->User->create();
					
					if($this->User->save($this->data)) {
						$this->Auth->login($this->data);
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash("Something went wrong. Try again please.", 'user_error');
						$this->redirect($this->referer());
					}
					
				}
			}			
		}
		
		function logout() {
			$this->redirect($this->Auth->logout());
		}
		
		/**
		 * Current user won't have any "prefers" association (tags_users) with tag anymore
		 * @param integer $tagId id of tag to be removed
		 */
		function removeTagFromUser($tagId) {
			
			$userId = $this->requestAction(array('controller' => 'users', 'action' => 'getUserId'));
			
			$assoc = $this->User->TagsUser->find('first', array('conditions' => array('TagsUser.tag_id' => $tagId, 'TagsUser.user_id' => $userId)));
			
			if(empty($assoc)) {
				$this->setFlash('Something went wrong, try again.', 'user_warning');
			} else {
				$this->User->TagsUser->delete($assoc['TagsUser']['id']);
			}
			
			$this->redirect($this->referer());
			
		}
		
		/**ACTIONS THAT ARE MADE TO BE CALLED WITH AJAX**/
		
		function checkAvailability($username = '') {
			$this->layout = 'bare';
			$this->set('available', $this->User->available($username));
		}
		
		/**ACTIONS THAT ARE MADE TO BE REQUESTED**/

		function isLoggedIn() {
			if(!$this->params['requested']) $this->cakeError('error404');
			return $this->User->isLoggedIn();
		}
		function getUserId() {
			if(!$this->params['requested']) $this->cakeError('error404');
			return $this->User->getUserId();
		}
		function getUser() {
			if(!$this->params['requested']) $this->cakeError('error404');
			return $this->User->getUser();
		}
		function getPreferedTags($id = null) {
			if(!$this->params['requested']) $this->cakeError('error404');
			return $this->User->getPreferedTags($id);
		}
		
	}