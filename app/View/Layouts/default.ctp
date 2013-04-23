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
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-40337964-1', 'cloudapp.net');
ga('send', 'pageview');
	</script>
</head>
<?php if (Router::url() === '/'): ?>
<body id="home">
<?php else: ?>
<body>
<?php endif; ?>
	<div class="container">
		<article>
			<?= $this->Session->flash(); ?>
			<?= $this->fetch('content'); ?>
		</article>

		<footer class="footer">
			<p><small>&copy; <?= $this->Html->link('What To Play Next? / 次なにやる？', '/') ?></small></p>
		</footer>
	</div>
</body>
</html>
