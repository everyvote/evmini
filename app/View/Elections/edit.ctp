<div class="elections form">
<?php echo $this->Form->create('Election'); ?>
	<fieldset>
		<legend><?php echo __('Edit Election'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('constituency_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('startdate');
		echo $this->Form->input('enddate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Election.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Election.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Elections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Constituencies'), array('controller' => 'constituencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Constituency'), array('controller' => 'constituencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Candidacies'), array('controller' => 'candidacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Candidacy'), array('controller' => 'candidacies', 'action' => 'add')); ?> </li>
	</ul>
</div>
