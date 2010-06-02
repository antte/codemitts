<?php 
	echo $form->create('User', array('action' => 'login'));
	echo $form->input('username');
	echo $form->input('password');
	echo $form->end('Login');
	?>
	<p>New user? You can <?php echo $html->link("register here", array('controller' => 'Users', 'action' => 'register'));?>.</p>