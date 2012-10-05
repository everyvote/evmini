<div class="candidates index">
	<h2><?php echo __('Candidates'); ?></h2>

	<?php
	foreach ($candidates as $candidate): ?>
        <!-- Candidate frame. should be a class helper eventually -->
        <div class="row well candidate-frame">
            <div class="span3" style="text-align:center;">
                <img src="http://placehold.it/150x150&text=Candidate+Pic" class="img-polaroid">
                <div class="row">
                    <div class="span3">
                        <div class="btn-group">
                            <button class="btn" style="width:66px"><i class="icon-thumbs-up"></i></button>
                            <button class="btn" style="width:66px"><i class="icon-thumbs-down"></i></button>
                            <button class="btn" style="width:66px"><?php echo "0"; ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <span class="candidate-name"><?php echo $this->Html->link($candidate['User']['name'], array('action' => 'view', $candidate['Candidate']['id'])); ?></span><br/>
                Running for <strong><?php echo $candidate['Office']['name']; ?></strong> of NIU Student Association(2012-2013)
                <p/> <br/> <?php echo $candidate['Candidate']['about_text']; ?>
            </div>
        </div>
<?php endforeach; ?>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<!--<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>-->
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Candidate'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Elections'), array('controller' => 'elections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Election'), array('controller' => 'elections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offices'), array('controller' => 'offices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Office'), array('controller' => 'offices', 'action' => 'add')); ?> </li>
	</ul>
</div>
