<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>What To Play Next?</title>
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
	<?= $this->element('configs') ?>

	<div class="wrapper">
		<div class="wrapper-inner">
			<?= $this->element('btn_wpn') ?>
		</div>
	</div>

	<?= $this->element('footer') ?>
</body>
</html>
