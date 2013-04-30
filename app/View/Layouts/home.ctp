<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>What To Play Next?</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(['wpn']);
		echo $this->Html->script(['jquery', 'wpn', 'snap.min']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body>
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

	<?= $this->element('script-drawer-trigger') ?>
	<?= $this->element('script-wpn') ?>
</body>
</html>
