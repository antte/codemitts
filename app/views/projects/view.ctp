<h1><?php echo ucfirst($project['Project']['name'])?></h1>
<p><?php echo $project['Project']['description']?></p>

<?php if(isset($project['Task'])):?>

	<h2>These are all the tasks for this project</h2>
	<ul id="tasks">
		<?php foreach($project['Task'] as $task): ?>
		<li
		<?php 
			if($task['id'] == $this->Session->read('currentTask.id')) {
				echo ' class="active" ';
			}
		?>
		>
			<h3><?php echo ucfirst($task['name'])?></h3>
			<p><?php echo $task['description']?></p>
		</li>
		<?php endforeach;?>
	</ul>

<?php endif;?>