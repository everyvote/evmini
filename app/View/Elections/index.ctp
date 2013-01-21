<div class="elections index">
	<h2><?php echo __('Elections'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('constituency_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('startdate'); ?></th>
			<th><?php echo $this->Paginator->sort('enddate'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($elections as $election): ?>
	<tr>
		<td><?php echo h($election['Election']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($election['Constituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $election['Constituency']['id'])); ?>
		</td>
		<td><?php echo h($election['Election']['name']); ?>&nbsp;</td>
		<td><?php echo h($election['Election']['description']); ?>&nbsp;</td>
		<td><?php echo h($election['Election']['startdate']); ?>&nbsp;</td>
		<td><?php echo h($election['Election']['enddate']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $election['Election']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $election['Election']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $election['Election']['id']), null, __('Are you sure you want to delete # %s?', $election['Election']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Election'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Candidacies'), array('controller' => 'candidacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Candidacy'), array('controller' => 'candidacies', 'action' => 'add')); ?> </li>
	</ul>
</div>
