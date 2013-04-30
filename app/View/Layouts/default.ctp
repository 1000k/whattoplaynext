<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>
		What To Play Next?
		<?= $title_for_layout ? ": {$title_for_layout}" : ''; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(['wpn', 'carousel.min', 'carousel-style.min']);
		echo $this->Html->script(['jquery', 'jquery.mousewheel.min', 'jquery.hook.min', 'carousel.min', 'html5lightbox', 'snap.min', 'wpn']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga') ?>
</head>
<body>
	<div class="hook" id="hook"></div>
	
	<?= $this->element('drawer') ?>

	<div id="content" class="scrollable drawer-swipable">
		<?= $this->element('btn-drawer-trigger') ?>

		<?= $this->Session->flash(); ?>
		<?= $this->fetch('content'); ?>
	</div>

	<script>
$(document).ready(function(){
	<?= $this->element('init-script-drawer-trigger') ?>
	<?= $this->element('init-script-carousel') ?>
	<?= $this->element('init-script-wpn') ?>
});
	</script>
</body>
</html>
