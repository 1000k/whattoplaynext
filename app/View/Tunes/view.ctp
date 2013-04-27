<section class="title">
	<?= $tune['Tune']['name'] ?>
</section>

<section class="published">
	<h2>載ってます</h2>

	<ul class="thumbnails">
	<?php foreach($tune['Book'] as $book): ?>
		<li class="thumbnail">
			<a href="<?= $book['url_amazon'] ?>" target="_blank">
				<?= $this->Html->image("books/{$book['image_path']}", ['alt' => $book['name']]) ?>
				<p><?= $book['name'] ?><img src="<?= $book['url_amazon_conversion_image'] ?>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</section>

<?php $count_sample = count($tune['Sample']); ?>
<?php if ($count_sample > 0): ?>
<section class="samples">
	<h2>こんな曲です</h2>

	<div style="max-width:600px; margin:0 auto;">
		<div class="m-carousel m-fluid m-carousel-photos">
			<div class="m-carousel-inner">
			<?php foreach ($tune['Sample'] as $key => $sample): ?>
				<div class="m-item">
					<?= $this->Html->image("samples/{$sample['thumbnail']}", ['alt' => $sample['title'], 'style' => 'width:100%']); ?>
					<a href="http://www.youtube.com/embed/<?= $sample['url'] ?>" title="<?= $sample['title'] ?>" class="html5lightbox">
						<?= $this->Html->para("m-caption", $sample['title']) ?>
					</a>
				</div>
			<?php endforeach; ?>
			</div>

			<div class="m-carousel-controls m-carousel-bulleted">
				<?php for ($i=1; $i <= $count_sample; $i++): ?>
					<a href="#" data-slide="<?= $i ?>"><?= $i ?></a>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="wrapper">
	<div class="wrapper-inner">
		<?= $this->element('btn_wpn') ?>
	</div>
</section>
