<h1>Your tags</h1>
<?php if(!empty($tags)):?>
<ul>
	<?php foreach($tags as $tag):?>
		<li>
			<?php echo $tag['name']; ?>
			<?php echo $html->link('Remove', array('action' => 'removeTagFromUser', $tag['id'])); ?>
		</li>
	<?php endforeach;?>
</ul>
<?php else:?>
<p>You currently have no preferred tags.</p>
<?php endif;?>
<h2>Add new preferred tag</h2>
<?php echo $form->create();?>
<?php echo $form->input('Tag.name', array('label' => 'Tag name'));?>
<?php echo $form->input('User.id', array('type' => 'hidden', 'value' => $userId));?>
<?php echo $form->end('Add');?>