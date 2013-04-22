<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>
		What Play Next?
		<?= $title_for_layout ? ": {$title_for_layout}" : ''; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(['bootstrap.min', 'bootstrap-responsive.min']);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 63px;
        padding: 52px 72px;
      }
      .credit {
        text-align: center;
      }
    </style>
    <script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-40337964-1', 'cloudapp.net');
ga('send', 'pageview');
    </script>
</head>
<body>
	<div class="container">
		<?= $this->Session->flash(); ?>
		<?= $this->fetch('content'); ?>

		<hr>

		<footer class="footer">
			<p class="credit">&copy; <?= $this->Html->link('What Play Next? / 次なにやる？', '/') ?></p>
		</footer>
	</div>
</body>
</html>
