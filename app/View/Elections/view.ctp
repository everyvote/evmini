<div class="elections view">
<h2><?php  echo __('Election'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($election['Election']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Constituency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($election['Constituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $election['Constituency']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($election['Election']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($election['Election']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Startdate'); ?></dt>
		<dd>
			<?php echo h($election['Election']['startdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($election['Election']['enddate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Election'), array('action' => 'edit', $election['Election']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Election'), array('action' => 'delete', $election['Election']['id']), null, __('Are you sure you want to delete # %s?', $election['Election']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Elections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Election'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Candidacies'), array('controller' => 'candidacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Candidacy'), array('controller' => 'candidacies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Candidacies'); ?></h3>
	<?php if (!empty($election['Candidacy'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Election Id'); ?></th>
		<th><?php echo __('Office Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($election['Candidacy'] as $candidacy): ?>
		<tr>
			<td><?php echo $candidacy['id']; ?></td>
			<td><?php echo $candidacy['user_id']; ?></td>
			<td><?php echo $candidacy['election_id']; ?></td>
			<td><?php echo $candidacy['office_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'candidacies', 'action' => 'view', $candidacy['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'candidacies', 'action' => 'edit', $candidacy['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'candidacies', 'action' => 'delete', $candidacy['id']), null, __('Are you sure you want to delete # %s?', $candidacy['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Candidacy'), array('controller' => 'candidacies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
