<div class="constituents view">
<h2><?php  echo __('Constituent'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($constituent['Constituent']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($constituent['User']['name'], array('controller' => 'users', 'action' => 'view', $constituent['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Constituency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($constituent['Constituency']['name'], array('controller' => 'constituencies', 'action' => 'view', $constituent['Constituency']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Constituent'), array('action' => 'edit', $constituent['Constituent']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Constituent'), array('action' => 'delete', $constituent['Constituent']['id']), null, __('Are you sure you want to delete # %s?', $constituent['Constituent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituent'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
