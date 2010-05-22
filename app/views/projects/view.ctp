<h1><?php echo ucfirst($project['Project']['name'])?></h1>
<p><?php echo $project['Project']['description']?></p>
<?php if(isset($project['Task'])):?>
<ul id="tasks">
	<?php foreach($project['Task'] as $task): ?>
	<li <?php if(isset($project['Task']['is_active'])) echo $project['Task']['is_active'] ? 'class="active"' : ''; ?> >
		<h2><?php echo ucfirst($task['name'])?></h2>
		<p><?php echo $task['description']?></p>
	</li>
	<?php endforeach;?>
</ul>
<?php endif;?>