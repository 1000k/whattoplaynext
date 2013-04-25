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
		echo $this->Html->css(['wpn']);
		echo $this->Html->script(['jquery', 'jquery.fitvids', 'jquery.mousewheel.min', 'jquery.hook.min']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga') ?>
	<script>
$(document).ready(function(){
	$('#hook').hook({
		locationHref: '<?= Router::url('/next', true) ?>'
	});
});
	</script>
</head>
<body>
	<div class="hook" id="hook"></div>

	<div class="container">
		<article>
			<?= $this->Session->flash(); ?>
			<?= $this->fetch('content'); ?>
		</article>

		<?= $this->element('footer') ?>
	</div>
</body>
</html>
