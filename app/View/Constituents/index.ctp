<div class="constituents index">
	<h2><?php echo __('Constituents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('constituency_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($constituents as $constituent): ?>
	<tr>
		<td><?php echo h($constituent['Constituent']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($constituent['User']['name'], array('controller' => 'users', 'action' => 'view', $constituent['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($constituent['Constituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $constituent['Constituency']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $constituent['Constituent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $constituent['Constituent']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $constituent['Constituent']['id']), null, __('Are you sure you want to delete # %s?', $constituent['Constituent']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Constituent'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
