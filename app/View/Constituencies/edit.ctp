<div class="constituencies form">
<?php echo $this->Form->create('Constituency'); ?>
	<fieldset>
		<legend><?php echo __('Edit Constituency'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Constituency.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Constituency.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('action' => 'index')); ?></li>
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
