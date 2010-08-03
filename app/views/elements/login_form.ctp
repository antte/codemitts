<?php echo $this->Javascript->link('login_form.js'); ?>
<section id="loginForm">
	<?php 
		echo $form->create('User', array('action' => 'login'));
		echo $form->input('username', array('type' => 'text'));
		echo $form->input('password');
		echo $form->end('Login');
	?>
	<p>New user? <?php echo $html->link("Sign up here", array('controller' => 'Users', 'action' => 'register'));?>.</p>
</section>