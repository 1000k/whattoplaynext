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
		<?= $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(['bootstrap.min', 'bootstrap-responsive.min']);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<?= $this->Html->link('次なにやる？', '/', ['class' => 'brand']); ?>
		</div>
	</div>

	<div class="container">
		<?= $this->Session->flash(); ?>
		<?= $this->fetch('content'); ?>
	</div>

	<footer>
		<div class="container">
			<p>&copy; What Play Next? / 次なにやる？</p>
		</div>
	</footer>
</body>
</html>
