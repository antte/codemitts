<?php 
	echo $this->Html->link(
		$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
		'http://www.cakephp.org/',
		array('target' => '_blank', 'escape' => false)
	);