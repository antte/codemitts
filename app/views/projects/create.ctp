<h2>Create a new project!</h2>
<?php 
	echo $form->create('Project');
	foreach($fields as $fieldName => $info) {
		echo $form->input($fieldName);
	}
	echo $form->end('Create');