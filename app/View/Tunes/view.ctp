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

<section class="wrapper">
	<div class="wrapper-inner">
		<?= $this->element('btn_wpn') ?>
	</div>
</section>
