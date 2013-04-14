<div class="tunes view">
<h2><?php  echo __('Tune'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tune['Tune']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tune['Tune']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tune['Tune']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tune['Tune']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Movies'); ?></dt>
		<dd>
			<?php echo h($tune['Tune']['movies']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tune'), array('action' => 'edit', $tune['Tune']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tune'), array('action' => 'delete', $tune['Tune']['id']), null, __('Are you sure you want to delete # %s?', $tune['Tune']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tunes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tune'), array('action' => 'add')); ?> </li>
	</ul>
</div>
