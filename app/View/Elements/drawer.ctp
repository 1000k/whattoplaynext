<?php if (false): ?>
<div class="drawers">
	<div class="left-drawer">
		<h2>検索対象</h2>
		<?php
			echo $this->Form->create('Config', ['action' => 'save']);

			echo $this->Form->select('enabled_books', $books, ['multiple' => 'checkbox']);

			echo $this->Form->end('save');
		?>
	</div>
</div>
<?php endif; ?>

<nav class="drawers absolute">
	<div class="left-drawer">
		<h2>検索対象</h2>
		<?php
			echo $this->Form->create('Config', ['action' => 'save']);

			echo $this->Form->select('enabled_books', $books, ['multiple' => 'checkbox']);

			echo $this->Form->end('save');
		?>
	</div>

	<div class="right-drawer"></div>
</nav>