<?php  
$options = $this->requestAction(
	array(
		'controller' 	=> $this->params['controller'],
		'action' 		=> 'appSidebar',
	), 
	array(
		'pass' => array($this->params['action'])
	)
); 

if(isset($options) && !empty($options)) {
	foreach($options['sidebar'] as $optionName => $values) {
		if ($optionName == 'elements') {
			foreach($values as $element) {
				echo $this->element($element['name']);
			}
		}
	}
}

?>