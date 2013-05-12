<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title><?= $title_for_layout ?></title>
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
			'vendor/hook/hook',
			'vendor/mobify-modules/carousel/src/carousel',
			'vendor/snap/snap',
			'vendor/html5lightbox',
			'app',
			// 'wpn.min',
			// 'vendor/html5lightbox',
		]);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body data-snap-ignore="true">
	<?= $this->element('drawer') ?>

	<div id="content" class="scrollable drawer-swipable">
		<?= $this->element('btn-drawer-trigger') ?>
		<span class="spinner"></span>

		<div id="home">
			<div class="home-wrapper">
				<div class="home-wrapper-inner">
					<?= $this->element('btn-wpn') ?>
				</div>
			</div>
			<?= $this->element('footer') ?>
		</div>

		<?= $this->fetch('content') ?>
	</div>

	<script>
	<?= $this->element('script-drawer-trigger') ?>
	
	$(document).ready(function(){
		<?= $this->element('init-script-carousel') ?>
	});
	</script>
</body>
</html>
