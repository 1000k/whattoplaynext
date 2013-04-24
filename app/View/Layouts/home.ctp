<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>
		What To Play Next?
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(['wpn']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body id="home">
	<div class="container">
		<?= $this->fetch('content'); ?>

		<?= $this->element('footer') ?>
	</div>
</body>
</html>
