<header class="jumbotron">
	<h1><?= $tune['Tune']['name'] ?></h1>
</header>

<h2>載ってます</h2>
<ul class="thumbnails">
<?php foreach($tune['Book'] as $book): ?>
	<li class="span4">
		<div class="thumbnail">
			<?= $this->Html->image("books/{$book['image_path']}", ['alt' => $book['name'], 'url' => $book['url_amazon']]) ?>
			<p><?= $this->Html->link($book['name'], $book['url_amazon']) ?><img src="<?= $book['url_amazon_conversion_image'] ?>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
		</div>
	</li>
<?php endforeach; ?>
</ul>

<h2>こんな曲です</h2>
<p>(coming soon)</p>

<?= $this->element('btn_whatplaynext') ?>