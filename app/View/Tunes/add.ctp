<div class="tunes form">
<?php echo $this->Form->create('Tune'); ?>
	<fieldset>
		<legend><?php echo __('Add Tune'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('movies');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tunes'), array('action' => 'index')); ?></li>
	</ul>
</div>
