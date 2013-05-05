<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->Html->charset(); ?>
	<title>What To Play Next?</title>
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
			'vendor/hook/hook.min',
			'vendor/mobify-modules/carousel/src/carousel',
			'vendor/html5lightbox',
			'vendor/snap/snap.min',
			'app'
		]);
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?= $this->element('ga'); ?>
</head>
<body data-snap-ignore="true">
	<?= $this->element('drawer') ?>

	<div id="content" class="drawer-swipable">
		<?= $this->element('btn-drawer-trigger') ?>

		<div id="home">
			<div class="home-wrapper">
				<div class="home-wrapper-inner">
					<?= $this->element('btn-wpn') ?>
				</div>
			</div>
		</div>

		<div id="tunes" class="scrollable drawer-swipable">
			<section class="title">
				title
			</section>

			<section class="published">
				<h2>Ýd¤Ã¤Æ¤Þ¤¹</h2>
				<ul class="thumbnails">
					<li class="thumbnail">
						<a href="%url_amazon%" target="_blank">
							<img src="%book.image_path%" alt="%book.name%">
							<p>%book.name%<img src="%book.url_amazon_conversion_image%" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
						</a>
					</li>
				</ul>
			</section>

			<section class="samples">
				<h2>¤³¤ó¤ÊÇú¤Ç¤¹</h2>

				<div class="carousel-wrapper">
					<div class="m-carousel m-fluid m-carousel-photos">
						<div class="m-carousel-inner">
							<div class="m-item">
								<img src="%sample.thumbnail%" alt="%sample.title%" style="width:100%">
								<a href="http://www.youtube.com/embed/%sample.url%" title="%sample.title%" class="html5lightbox">
									<p class="m-caption">%sample.title%</p>
								</a>
							</div>
						</div>

						<div class="m-carousel-controls m-carousel-bulleted">
							<a href="#" data-slide="%i%">%i%</a>
						</div>
					</div>
				</div>
			</section>

			<section class="next trailer-6">
				<?= $this->element('btn-wpn') ?>
			</section>
		</div>

		<?= $this->element('footer') ?>
	</div>

	<script>
		<?= $this->element('init-script-drawer-trigger') ?>
	</script>
</body>
</html>
