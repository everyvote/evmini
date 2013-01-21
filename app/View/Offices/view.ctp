<div class="offices view">
<h2><?php  echo __('Office'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($office['Office']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Constituency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($office['Constituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $office['Constituency']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($office['Office']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($office['Office']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Term Start'); ?></dt>
		<dd>
			<?php echo h($office['Office']['term_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Term End'); ?></dt>
		<dd>
			<?php echo h($office['Office']['term_end']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Office'), array('action' => 'edit', $office['Office']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Office'), array('action' => 'delete', $office['Office']['id']), null, __('Are you sure you want to delete # %s?', $office['Office']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Offices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Office'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Candidacies'), array('controller' => 'candidacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Candidacy'), array('controller' => 'candidacies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Candidacies'); ?></h3>
	<?php if (!empty($office['Candidacy'])): ?>
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
		foreach ($office['Candidacy'] as $candidacy): ?>
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
