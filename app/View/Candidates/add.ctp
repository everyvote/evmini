<div class="candidates form">
<?php echo $this->Form->create('Candidate'); ?>
	<fieldset>
		<legend><?php echo __('Add Candidate'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('election_id');
		echo $this->Form->input('office_id');
		echo $this->Form->input('about_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Candidates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Elections'), array('controller' => 'elections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Election'), array('controller' => 'elections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offices'), array('controller' => 'offices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Office'), array('controller' => 'offices', 'action' => 'add')); ?> </li>
	</ul>
</div>
