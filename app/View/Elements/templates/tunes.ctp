<script type="text/template" id="template-tunes">
	<section class="title">
		<%- Tune.name %>
	</section>

	<section class="published">
		<h2>載ってます</h2>

		<ul class="thumbnails">
			<% _.each(Book, function(val, i) { %>
			<li class="thumbnail">
				<a href="<%- val.url_amazon %>" target="_blank">
					<img src="<?= FULL_BASE_URL . '/' . IMAGES_URL . 'books/' ?><%- val.image_path %>" alt="<%- val.name %>">
					<p><%- val.name %><img src="<%- val.url_amazon_conversion_image %>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
				</a>
			</li>
			<% }); %>
		</ul>
	</section>

	<% if (Sample.length > 0) { %>
	<section class="samples">
		<h2>こんな曲です</h2>

		<div class="carousel-wrapper">
			<div class="m-carousel m-fluid m-carousel-photos">
				<div class="m-carousel-inner">
					<% _.each(Sample, function(val) { %>
					<div class="m-item">
						<img src="<?= FULL_BASE_URL . '/' . IMAGES_URL . 'samples/' ?><%- val.thumbnail %>" alt="<%- val.title %>" style="width:100%">
						<a href="http://www.youtube.com/embed/<%- val.url %>" title="<%- val.title %>" class="html5lightbox" data-bypass='true'>
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
		<?= $this->element('link-back-to-home') ?>
	</footer>
</script>