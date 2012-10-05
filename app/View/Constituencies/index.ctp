<div class="constituencies index">
	<h2><?php echo __('Constituencies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($constituencies as $constituency): ?>
	<tr>
		<td><?php echo h($constituency['Constituency']['id']); ?>&nbsp;</td>
		<td><?php echo h($constituency['Constituency']['name']); ?>&nbsp;</td>
		<td><?php echo h($constituency['Constituency']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($constituency['ParentConstituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $constituency['ParentConstituency']['id'])); ?>
		</td>
		<td><?php echo h($constituency['Constituency']['lft']); ?>&nbsp;</td>
		<td><?php echo h($constituency['Constituency']['rght']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $constituency['Constituency']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $constituency['Constituency']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $constituency['Constituency']['id']), null, __('Are you sure you want to delete # %s?', $constituency['Constituency']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Constituency'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituents'), array('controller' => 'constituents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituent'), array('controller' => 'constituents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Elections'), array('controller' => 'elections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Election'), array('controller' => 'elections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offices'), array('controller' => 'offices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Office'), array('controller' => 'offices', 'action' => 'add')); ?> </li>
	</ul>
</div>
