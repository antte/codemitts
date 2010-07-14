<h1>Logged in as <span class="username"><?php echo $user['User']['username']; ?></span></h1>
<h2>Your preferred tags:</h2>
<?php if(empty($user['Tag']) || !isset($user['Tag']) ):?>
	<p>You don't have any preferred tags yet, you can <?php echo $html->link('create preferred tags here', array('action' => 'editTags'));?>.</p>	
<?php else:?>
	<p>You can <?php echo $html->link('edit your preferred tags here', array('action' => 'editTags'));?>.</p>
	<ul id="preferredTags">
	<?php 
		foreach($user['Tag'] as $tag) {
			echo '<li>';
			echo $tag['name'];
			echo '</li>';
		}
	?>
	</ul>
<?php endif; //if tag is empty?>
<?php echo $this->element('random_button'); ?>