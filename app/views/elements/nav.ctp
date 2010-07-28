<?php $nav_elements = $this->requestAction(array(
	'controller' => $this->params['controller'],
	'action' => 'buildNavElements'
), array(
	'pass' => array($this->params['action'])
)); ?>

<?php if (isset($nav_elements) && !empty($nav_elements)) : ?>
	<nav id="main_nav">
		<ul>
			<?php foreach($nav_elements as $nav_element) : ?>
				<li <?php 
					if(!empty($nav_element['classes'])) {
						echo 'class="'
						   . implode(' ', $nav_element['classes'])
						   . '"';
					}
				?>>
					<?php echo $html->link(
						$nav_element['label'], 
						array(
							'controller' 	=> $nav_element['controller'], 
							'action' 		=> $nav_element['action'],
						)
					); ?>
					<?php if (
							    in_array('current', $nav_element['classes']) 
							 &&	isset($nav_element['sub_elements']) 
							 && !empty($nav_element['sub_elements'])
						 ) : ?>
						<ul>
							<?php foreach($nav_element['sub_elements'] as $sub_element) : ?>
								<li <?php 
									if(!empty($sub_element['classes'])) {
										echo 'class="'
										   . implode(' ', $sub_element['classes'])
										   . '"';
									}
								?>>
									<?php echo $html->link(
										$sub_element['label'],
										array(
											'controller' 	=> $nav_element['controller'], 
											'action' 		=> $sub_element['action'],
										)
									); ?>
								</li>
							<?php endforeach;?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>