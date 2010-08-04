<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout . ' | Codemitts'; ?>
	</title>
	<?php
		echo $this->Html->meta('icon', 'img/favicon.ico');
		echo $this->Html->css('style.css');
		echo $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
		echo $this->Javascript->link('http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js');
		echo $this->Javascript->link('welcome.js');
		echo $scripts_for_layout;
	?>
	<!-- [if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body class="welcome">
	<section>
	
		<section id="content">
			
			<?php echo $session->flash(); ?>

			<?php if(isset($content_title)) echo '<h1>' . $content_title . '</h1>'; ?>

			<?php echo $content_for_layout; ?>
			
		</section>
		
		<aside id="sidebar">
			<?php echo $session->flash('auth'); ?>
			<?php echo $this->element("login_form");?>
		</aside>
	
	</section>
</body>
</html>