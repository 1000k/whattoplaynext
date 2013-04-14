<div class="tunes form">
<?php echo $this->Form->create('Tune'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tune'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('movies');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tune.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tune.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tunes'), array('action' => 'index')); ?></li>
	</ul>
</div>
