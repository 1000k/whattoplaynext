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
		<?= $this->Element('btn-drawer-trigger') ?>

		<div class="wrapper">
			<div class="wrapper-inner">
				<?= $this->element('btn-wpn') ?>
			</div>
		</div>
			
		<?= $this->element('footer') ?>
	</div>

	<script>
$(document).ready(function(){
	var snapper = new Snap({
		element: $('#content')[0]
		, disable: 'right'
	});

	$('.btn-drawer-trigger').click(function() {
		if( snapper.state().state=="left" ){
			snapper.close();
		} else {
			snapper.open('left');
		}
	});
});
	</script>
</body>
</html>
