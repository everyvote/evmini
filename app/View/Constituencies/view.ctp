<div class="constituencies view">
<h2><?php  echo __('Constituency'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($constituency['Constituency']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($constituency['Constituency']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($constituency['Constituency']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Constituency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($constituency['ParentConstituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $constituency['ParentConstituency']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($constituency['Constituency']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($constituency['Constituency']['rght']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Constituency'), array('action' => 'edit', $constituency['Constituency']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Constituency'), array('action' => 'delete', $constituency['Constituency']['id']), null, __('Are you sure you want to delete # %s?', $constituency['Constituency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Constituencies'); ?></h3>
	<?php if (!empty($constituency['ChildConstituency'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($constituency['ChildConstituency'] as $childConstituency): ?>
		<tr>
			<td><?php echo $childConstituency['id']; ?></td>
			<td><?php echo $childConstituency['name']; ?></td>
			<td><?php echo $childConstituency['description']; ?></td>
			<td><?php echo $childConstituency['parent_id']; ?></td>
			<td><?php echo $childConstituency['lft']; ?></td>
			<td><?php echo $childConstituency['rght']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'constituencies', 'action' => 'view', $childConstituency['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'constituencies', 'action' => 'edit', $childConstituency['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'constituencies', 'action' => 'delete', $childConstituency['id']), null, __('Are you sure you want to delete # %s?', $childConstituency['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Constituents'); ?></h3>
	<?php if (!empty($constituency['Constituent'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Constituency Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($constituency['Constituent'] as $constituent): ?>
		<tr>
			<td><?php echo $constituent['id']; ?></td>
			<td><?php echo $constituent['user_id']; ?></td>
			<td><?php echo $constituent['constituency_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'constituents', 'action' => 'view', $constituent['user_id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'constituents', 'action' => 'edit', $constituent['user_id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'constituents', 'action' => 'delete', $constituent['user_id']), null, __('Are you sure you want to delete # %s?', $constituent['user_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Constituent'), array('controller' => 'constituents', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Elections'); ?></h3>
	<?php if (!empty($constituency['Election'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Constituency Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Startdate'); ?></th>
		<th><?php echo __('Enddate'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($constituency['Election'] as $election): ?>
		<tr>
			<td><?php echo $election['id']; ?></td>
			<td><?php echo $election['constituency_id']; ?></td>
			<td><?php echo $election['name']; ?></td>
			<td><?php echo $election['description']; ?></td>
			<td><?php echo $election['startdate']; ?></td>
			<td><?php echo $election['enddate']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'elections', 'action' => 'view', $election['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'elections', 'action' => 'edit', $election['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'elections', 'action' => 'delete', $election['id']), null, __('Are you sure you want to delete # %s?', $election['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Election'), array('controller' => 'elections', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Offices'); ?></h3>
	<?php if (!empty($constituency['Office'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Constituency Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Term Start'); ?></th>
		<th><?php echo __('Term End'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($constituency['Office'] as $office): ?>
		<tr>
			<td><?php echo $office['id']; ?></td>
			<td><?php echo $office['constituency_id']; ?></td>
			<td><?php echo $office['name']; ?></td>
			<td><?php echo $office['description']; ?></td>
			<td><?php echo $office['term_start']; ?></td>
			<td><?php echo $office['term_end']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'offices', 'action' => 'view', $office['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'offices', 'action' => 'edit', $office['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'offices', 'action' => 'delete', $office['id']), null, __('Are you sure you want to delete # %s?', $office['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Office'), array('controller' => 'offices', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
