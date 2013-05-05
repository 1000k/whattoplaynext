<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>What To Play Next?</title>
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
			'app'
		]);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body data-snap-ignore="true">
	<?= $this->element('drawer') ?>

	<div id="content-home" class="drawer-swipable">
		<div class="wrapper">
			<?= $this->element('btn-drawer-trigger') ?>

			<div class="wrapper-inner">
				<?= $this->element('btn-wpn') ?>
			</div>
		</div>
			
		<?= $this->element('footer') ?>
	</div>

	<script>
		<?= $this->element('init-script-drawer-trigger') ?>
	</script>
</body>
</html>
