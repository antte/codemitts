<?php if(isset($task)) : ?>
	<?php $this->set('content_title', $task['Task']['name']); ?>
	<p class="TaskDescription"><?php echo $task['Task']['description']; ?></p>
<?php elseif (isset($tasks)) : ?>
	<ul>
		<?php foreach($tasks as $task) : ?>
			<li>
				<?php echo $html->link($task['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $task['Task']['name'])); ?>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>