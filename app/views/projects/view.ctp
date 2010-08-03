<h1><?php echo ucfirst($project['Project']['name'])?></h1>
<p><?php echo $project['Project']['description']?></p>

<?php if(isset($project['Task'])):?>

	<h2>Project tasks</h2>
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
			<?php if(!empty($task['Tag'])):?>
			<div class="tags">
				<h4>Tags:</h4>
				<ul>
					<?php foreach($task['Tag'] as $i => $tag):?>
					<li>
						<?php echo $tag['name'];?>
						<?php if(!(sizeof($task['Tag']) == ($i+1))) echo ",";?>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endif;?>
			<p><?php echo $task['description']?></p>
		</li>
		<?php endforeach;?>
	</ul>

<?php endif;?>