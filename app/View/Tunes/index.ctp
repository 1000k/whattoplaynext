<div class="tunes index">
	<h2><?php echo __('Tunes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('movies'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tunes as $tune): ?>
	<tr>
		<td><?php echo h($tune['Tune']['id']); ?>&nbsp;</td>
		<td><?php echo h($tune['Tune']['created']); ?>&nbsp;</td>
		<td><?php echo h($tune['Tune']['modified']); ?>&nbsp;</td>
		<td><?php echo h($tune['Tune']['name']); ?>&nbsp;</td>
		<td><?php echo h($tune['Tune']['movies']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tune['Tune']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tune['Tune']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tune['Tune']['id']), null, __('Are you sure you want to delete # %s?', $tune['Tune']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Tune'), array('action' => 'add')); ?></li>
	</ul>
</div>
