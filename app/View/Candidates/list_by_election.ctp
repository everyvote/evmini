<?php
	if(!count($candidates)) :
?>
<div class="alert alert-info">
	There aren't any candidates who run for this election.
</div>
<?php
	else :
?>
	<?php foreach($candidates as $candidate) : ?>
            <div class="row">
                <div class="span3">
					<p><?= $this->Html->link(
						$this->Html->image($candidate['User']['image'], array('class'=>"img_rounded")),
						"/candidates/view/".$candidate['Candidate']['id']."/".$candidate['Candidate']['election_id'],
						array('class'=>'thumbnail','escape'=>false));
					?></p>
					<p class="pagination-centered" id="votes<?=$candidate['Candidate']['id']?>">
					<?php //if(!$candidate['Votes']['casted']['Vote']['stances_id']) : ?>
					<a class="btn btn-small btn-success" id="votes<?=$candidate['Candidate']['id']?>_1" href="#" onclick="vote(<?=$candidate['Candidate']['id']?>,1);">
                                            <i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_1"><?=$candidate['Votes']['positive']?></span>
                                        </a>
                                        <a class="btn btn-small btn-danger" id="votes<?=$candidate['Candidate']['id']?>_3" href="#" onclick="vote(<?=$candidate['Candidate']['id']?>,3);">
                                            <i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_3"><?=$candidate['Votes']['negative']?></span>
                                        </a>
					<?php //else : ?>
                        <!--
					<a class="btn btn-small disabled <?=$candidate['Votes']['casted']['Vote']['stances_id']==1 ? 'btn-success' : '' ?>" id="votes<?=$candidate['Candidate']['id']?>_1" href="#"><i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_1"><?=$candidate['Votes']['positive']?></span></a>
                	<a class="btn btn-small disabled <?=$candidate['Votes']['casted']['Vote']['stances_id']==3 ? 'btn-danger' : '' ?>" id="votes<?=$candidate['Candidate']['id']?>_3" href="#"><i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_3"><?=$candidate['Votes']['negative']?></span></a>
                        -->
					<?php //endif; ?>
					</p>
				</div>

                <div class="span6">
                    <h3><?= $this->Html->link(
						$candidate['User']['name'],
						"/candidates/view/".$candidate['Candidate']['id']."/".$candidate['Candidate']['election_id']);
					?></h3>
                    <p><strong>Running for:</strong> <?=$candidate['Office']['name']?></p>
                    <p><?=substr($candidate['Candidate']['about_text'], 0, 350) ?>...</p>
                </div>
            </div>
            <hr>
	<?php endforeach; ?>
<?php
	endif;
?>