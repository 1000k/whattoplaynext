<nav class="drawers">
	<div class="left-drawer">
		<h2>検索対象</h2>
		<?php
			echo $this->Form->create('Config', ['default' => false]);

			echo $this->Form->select('enabled_books', $books, ['multiple' => 'checkbox']);

			echo $this->Form->end();
		?>
	</div>

	<div class="right-drawer"></div>
</nav>