<section class="title">
	<?= $tune['Tune']['name'] ?>
</section>

<section class="published">
	<h2>載ってます</h2>

	<ul class="thumbnails">
	<?php foreach($tune['Book'] as $book): ?>
		<li class="thumbnail">
			<?= $this->Html->image("books/{$book['image_path']}", ['alt' => $book['name'], 'url' => $book['url_amazon']]) ?>
			<p><?= $this->Html->link($book['name'], $book['url_amazon']) ?><img src="<?= $book['url_amazon_conversion_image'] ?>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
		</li>
	<?php endforeach; ?>
	</ul>
</section>

<section class="wrapper">
	<div class="wrapper-inner">
		<?= $this->element('btn_wpn') ?>
	</div>
</section>
