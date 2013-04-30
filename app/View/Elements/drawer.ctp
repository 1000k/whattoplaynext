<nav class="drawers">
	<div class="left-drawer">
		<h2>検索対象</h2>
		<?php
			echo $this->Form->create('Config', ['action' => 'save', 'default' => false]);

			echo $this->Form->select('enabled_books', $books, ['multiple' => 'checkbox']);

			echo $this->Form->end([
				'label' => 'Save',
				'div' => ['class' => 'update-config submit']
			]);
		?>
	</div>

	<div class="right-drawer"></div>
</nav>