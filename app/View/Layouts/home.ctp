<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>What To Play Next?</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(['wpn']);
		echo $this->Html->script(['jquery', 'snap.min']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body>
	<?= $this->Element('drawer') ?>

	<div id="content">
		<div class="wrapper">
			<?= $this->Element('btn-drawer-trigger') ?>
			
			<div class="wrapper-inner">
				<?= $this->element('btn-wpn') ?>
			</div>
		</div>
			
		<?= $this->element('footer') ?>
	</div>

	<?= $this->Element('script-drawer-trigger') ?>
</body>
</html>
