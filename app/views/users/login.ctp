<?php 
	echo $form->create();
	echo $form->input('username');
	echo $form->input('password');
	echo $form->submit('Log in');
	echo $form->end();