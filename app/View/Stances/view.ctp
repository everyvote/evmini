<div class="stances view">
<h2><?php  echo __('Stance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stance['Stance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stance['Stance']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($stance['Stance']['desc']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stance'), array('action' => 'edit', $stance['Stance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stance'), array('action' => 'delete', $stance['Stance']['id']), null, __('Are you sure you want to delete # %s?', $stance['Stance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stance'), array('action' => 'add')); ?> </li>
	</ul>
</div>
