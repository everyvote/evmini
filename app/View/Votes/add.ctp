<div class="votes form">
<?php echo $this->Form->create('Vote'); ?>
	<fieldset>
		<legend><?php echo __('Add Vote'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('candidacy_id');
		echo $this->Form->input('comment_id');
		echo $this->Form->input('stances_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Votes'), array('action' => 'index')); ?></li>
	</ul>
</div>
