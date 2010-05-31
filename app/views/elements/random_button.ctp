<?php 
	
	$tags = $this->requestAction('tasks/getTags');
	$tags['all'] = 'all';
	
	echo $form->create('Task', array('action' => 'random'));
	echo $form->input('Tag.id', array('options' => $tags, 'label' => 'Type of task'));
	echo $form->submit('Hit me!');
	echo $form->end();