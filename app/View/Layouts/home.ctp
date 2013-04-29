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
	<div class="relative tall">
		<?= $this->Element('drawer') ?>

		<div id="content">
			<div class="relative tall">
				<button class="btn btn-drawer-trigger"></button>
			</div>
		</div>

<?php if (false): ?>
		<div id="content" class="wrapper">

			<div class="wrapper-inner">
				<button class="btn drawer-trigger">open drawer</button>
				<?= $this->element('btn_wpn') ?>
			</div>
		</div>

		<?= $this->element('footer') ?>
	</div>
<?php endif; ?>
		
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
