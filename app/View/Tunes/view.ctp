<header class="hero-unit">
	<h1><?= $tune['Tune']['name'] ?></h1>
</header>

<h2>こんな曲です</h2>
<p>(coming soon)</p>

<h2>載ってます</h2>
<?php foreach($tune['Book'] as $book): ?>
<p><?= $this->Html->image("books/{$book['image_path']}", ['alt' => $book['name'], 'url' => $book['url_amazon']]) ?></p>
<p><?= $this->Html->link($book['name'], $book['url_amazon']) ?><img src="<?= $book['url_amazon_conversion_image'] ?>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;"></p>
<?php endforeach; ?>

<?= $this->element('btn_whatplaynext') ?>