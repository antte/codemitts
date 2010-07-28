<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
		<?php echo ' | Codemitts'; ?>
	</title>
	<?php
		echo $this->Html->meta('icon', 'img/favicon.ico');
		echo $this->Html->css('style.css');
		echo $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
		echo $this->Javascript->link('http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js');
		echo $scripts_for_layout;
	?>
	<!-- [if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body class="default">
	<section>
		<header>
			<?php echo $this->element('login_status'); ?>
			<h1><?php echo $html->link('CodeMitts', array('controller' => 'pages', 'action' => 'home'))?></h1>
			<?php echo $this->element('nav'); ?>
		</header>
		<section>
		
			<header id="contentHeader">
				<?php if(isset($content_title)) echo '<h2>' . $content_title . '</h2>'; ?>
			</header>
			
			<section id="content">
				
				<?php echo $this->Session->flash(); ?>
				
				<?php echo $content_for_layout; ?>
				
			</section>
			
			<aside id="sidebar">
				<?php echo $this->element('sidebar');?>
			</aside>
		
		</section>
		<footer>
			<?php echo $this->element('cake_power'); ?>
			<?php echo $this->element('sql_dump'); ?>
		</footer>
	</section>
</body>
</html>