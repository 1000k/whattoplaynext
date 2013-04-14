<header class="hero-unit">
	<h1><?= $tune['Tune']['name'] ?></h1>
</header>

<h2>こんな曲です</h2>
<p>(coming soon)</p>

<h2>載ってます</h2>
<?php foreach($tune['Book'] as $book): ?>
<p><?= $book['name'] ?></p>
<p><?= $this->Html->image($book['image_path'], ['alt' => $book['name']]) ?></p>
<p><?= $book['url_amazon'] ?></p>
<?php endforeach; ?>

<?= $this->element('btn_whatplaynext') ?>