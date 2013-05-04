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
		echo $this->Html->css([
			'wpn',
			'carousel.min',
			'carousel-style.min'
		]);
		echo $this->Html->script([
			'vendor/jquery/jquery',
			'vendor/jquery-mousewheel/jquery.mousewheel',
			'vendor/underscore/underscore',
			'vendor/backbone/backbone',
			'vendor/backbone.localStorage/backbone.localStorage',
			'vendor/hook/hook.min',
			'vendor/mobify-modules/carousel/src/carousel',
			'vendor/html5lightbox',
			'vendor/snap/snap.min',
			'wpn'
		]);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga') ?>
</head>
<body data-snap-ignore="true">
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
