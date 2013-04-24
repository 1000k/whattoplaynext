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
		echo $this->Html->script(['jquery', 'jquery.fitvids']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga') ?>
	<script>
$(document).ready(function(){
	$(".video-container").fitVids();
});
	</script>
</head>
<body>
	<div class="container">
		<article>
			<?= $this->Session->flash(); ?>
			<?= $this->fetch('content'); ?>
		</article>

		<?= $this->element('footer') ?>
	</div>
</body>
</html>
