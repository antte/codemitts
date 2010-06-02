<script>
	$(document).ready(function(){
		//$("form#register").validate();
	});
</script>
<?php
	if(isset($registrated) && $registrated) {
		//This will happen after the user is registrated 
		?>
		<h2>You're now successfully registrated, you can login below:</h2>
		<?php echo $this->element('login_form');?>
		<?php 
	} else {
		echo $form->create('User', array('id' => 'register'));
		echo $form->input('username', array('class' => 'required'));
		echo $form->input('password', array('type' => 'password', 'class' => 'required'));
		echo $form->input('repassword', array('type' => 'password', 'class' => 'required', 'label' => 'Re-type password'));
		echo $form->end('Register');
	}