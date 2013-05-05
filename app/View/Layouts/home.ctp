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

			<?= $this->element('footer') ?>
		</div>

		<div id="tunes" class="scrollable drawer-swipable">
		<script type="text/template" id="template-tunes">
			<section class="title">
				<%- name %>
			</section>

			<section class="published">
				<h2>Ýd¤Ã¤Æ¤Þ¤¹</h2>

				<ul class="thumbnails">
					<% _.each(Book, function(val, i) { %>
					<li class="thumbnail">
						<a href="<%- val.url_amazon %>" target="_blank">
							<img src="<?= IMAGES_URL . 'books/' ?><%- val.image_path %>" alt="<%- val.name %>">
							<p><%- val.name %><img src="<%- val.url_amazon_conversion_image %>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
						</a>
					</li>
					<% }); %>
				</ul>
			</section>

			<% if (Sample.length > 0) { %>
			<section class="samples">
				<h2>¤³¤ó¤ÊÇú¤Ç¤¹</h2>

				<div class="carousel-wrapper">
					<div class="m-carousel m-fluid m-carousel-photos">
						<div class="m-carousel-inner">
							<% _.each(Sample, function(val) { %>
							<div class="m-item">
								<img src="<?= IMAGES_URL . 'samples/' ?><%- val.thumbnail %>" alt="<%- val.title %>" style="width:100%">
								<a href="http://www.youtube.com/embed/<%- val.url %>" title="<%- val.title %>" class="html5lightbox">
									<p class="m-caption"><%- val.title %></p>
								</a>
							</div>
							<% }); %>
						</div>

						<div class="m-carousel-controls m-carousel-bulleted">
							<% for (var i = 1; i <= Sample.length; i++) { %>
							<a href="#" data-slide="<%- i %>"><%- i %></a>
							<% } %>
						</div>
					</div>
				</div>
			</section>
			<% } %>

			<section class="next">
				<?= $this->element('btn-wpn') ?>
			</section>

			<footer class="footer">
				<p><small>&copy; <?= $this->Html->link('What To Play Next?', '/') ?></small></p>
			</footer>
		</script>
		</div>
	</div>

	<script>
		<?= $this->element('init-script-drawer-trigger') ?>
	</script>
</body>
</html>
