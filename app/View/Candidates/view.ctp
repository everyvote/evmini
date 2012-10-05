<?php if (!empty($currentUser)) { ?>
<h2>Current Facebook User</h2>
<pre>
        <?php print_r($currentUser); ?>
    </pre>
<?php } ?>

<div class="candidacies view">
    <h2><?php  echo __('Candidate Profile'); ?></h2>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit candidate'), array('action' => 'edit', $candidate['candidate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete candidate'), array('action' => 'delete', $candidate['candidate']['id']), null, __('Are you sure you want to delete # %s?', $candidate['candidate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Candidacies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New candidate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Elections'), array('controller' => 'elections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Election'), array('controller' => 'elections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offices'), array('controller' => 'offices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Office'), array('controller' => 'offices', 'action' => 'add')); ?> </li>
	</ul>
</div>-->

    <!-- Candidate frame. should be a class helper eventually -->
    <div class="row well candidate-frame">
        <div class="span3" style="text-align:center;">
            <img src="http://placehold.it/150x150&text=Candidate+Pic" class="img-polaroid">
            <div class="row">
                <div class="span3">
                    <div class="btn-group">
                        <button class="btn" style="width:66px"><i class="icon-thumbs-up"></i></button>
                        <button class="btn" style="width:66px"><i class="icon-thumbs-down"></i></button>
                        <button class="btn" style="width:66px"><?php echo count($comments);  ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <span class="candidate-name"><?php echo $candidate['User']['name']; ?></span><br/>
            Running for <strong><?php echo $candidate['Office']['name']; ?></strong> of NIU Student Association(2012-2013)
            <p/> <br/> <?php echo $candidate['Candidate']['about_text'];  ?>
        </div>
    </div>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Supporters</br>(###)</a></li>
            <li><a href="#tab2" data-toggle="tab">Dissenters</br>(###)</a></li>
            <li><a href="#tab3" data-toggle="tab">Undecided</br>(###)</a></li>
            <li><a href="#tab4" data-toggle="tab">Votes</br>(###)</a></li>
            <li><a href="#tab5" data-toggle="tab">Comments</br>(<?php count($comments); ?>)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                Section 1
            </div>
            <div class="tab-pane" id="tab2">
                <p>Howdy, I'm in Section 2.</p>
            </div>
            <div class="tab-pane" id="tab3">
                <p>I'm in Section 3.</p>
            </div>
            <div class="tab-pane" id="tab4">
                <p>Howdy, I'm in Section 4.</p>
            </div>
            <div class="tab-pane" id="tab5">
                <p>I'm in Section 5.</p>
            </div>
        </div>
    </div>
