<?php $currentUser = $this->requestAction(array(
	'controller' 	=> 'users', 
	'action' 		=> 'getUser',
)); ?>

<p id="login_status"><?php if($currentUser) {
	echo $currentUser['User']['username']
	   . ', '
	   . $html->link('logout', array(
	   		'controller' 	=> 'users',
	   		'action' 		=> 'logout'
	   ))
	   . '.';
} else {
	/**
	 * Note that we're not suppose to be able to be here. You have to be logged
	 * in to view the default layout in which this element is normally rendered.
	 */ 
	echo 'Not logged in, '
	   . $html->link('login', array(
	   		'controller' 	=> 'pages',
	   		'action' 		=> 'home'
	   ))
	   . '.';
} ?></p>