<?php 
	
	$tasktypes = $this->requestAction('tasks/getTasktypes');
	$tasktypes['all'] = 'all';
	
	echo $form->create('Task', array('action' => 'random'));
	echo $form->input('Tasktype.id', array('options' => $tasktypes, 'label' => 'Tasktype'));
	echo $form->submit('Hit me!');
	echo $form->end();