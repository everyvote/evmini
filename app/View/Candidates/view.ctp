<?php $this->Html->script('candidate', array('inline' => false)); ?>

<div class="candidacies view">
    <h2><?php  echo __('Candidate Profile'); ?></h2>

    <div class="row">
        <div class="span3">
            <p><a href="#" class="thumbnail"><img src="<?=$candidate['User']['image']?>" class="img-rounded" /></a></p>
            <p class="pagination-centered" id="votes<?=$candidate['Candidate']['id']?>">
            <?php if(!$votes['casted']['Vote']['stances_id']) : ?>
                <a class="btn btn-small btn-success" id="votes<?=$candidate['Candidate']['id']?>_1" href="#" onclick="vote(<?=$candidate['Candidate']['id']?>,1);"><i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_1"><?=$votes['positive']?></span></a>
                <a class="btn btn-small btn-danger" id="votes<?=$candidate['Candidate']['id']?>_3" href="#" onclick="vote(<?=$candidate['Candidate']['id']?>,3);"><i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_3"><?=$votes['negative']?></span></a>
            <?php else : ?>
                <a class="btn btn-small disabled <?=$votes['casted']['Vote']['stances_id']==1 ? 'btn-success' : '' ?>" id="votes<?=$candidate['Candidate']['id']?>_1" href="#"><i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_1"><?=$votes['positive']?></span></a>
                <a class="btn btn-small disabled <?=$votes['casted']['Vote']['stances_id']==3 ? 'btn-danger' : '' ?>" id="votes<?=$candidate['Candidate']['id']?>_3" href="#"><i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_3"><?=$votes['negative']?></span></a>
            <?php endif; ?>
            </p>
        </div>
        <div class="span6">
            <button class="btn pull-right btn-small btn-primary" id="share" data-toggle="modal" data-target="#shareModal"><i class="icon-white icon-bullhorn"></i> Share the profile</button>
            <h3><a href="#"><?=$candidate['User']['name']?></a></h3>
            <p><strong>Running for:</strong> <?=$candidate['Office']['name']?> <em>(<?=$candidate['Office']['term_end']?>)</em></p>
            <p id="aboutme"><?= $this->EvText->format($candidate['Candidate']['about_text']) ?></p>
            <?php if ($candidate['User']['id'] == $currentUser['User']['id']): ?>
                <p><a data-toggle="modal" data-target="#aboutModal" href="#">Edit Profile</a></p>
            <? endif; ?>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="btn-group span6" data-toggle="buttons-radio">
            <button class="show-comments btn btn-small active">Comments <span class="badge"><?=count($comments)?></span></button>
            <button id="show-supporters" class="show-votes btn btn-success btn-small">Supporters <span class="badge badge-success"><?=$votes['positive']?></span></button>
            <button id="show-opposers" class="show-votes btn btn-danger btn-small">Opposers <span class="badge badge-important"><?=$votes['negative']?></span></button>
        </div>
        <div class="span3">
            <button class="btn btn-small btn-primary pull-right add-comment" id="add-comment-<?= $candidate['Candidate']['id'] ?>"><i class="icon-comment"></i> Add new comment <span class="badge badge-inverse" id="votes_c<?=$candidate['Candidate']['id']?>_2"><?=count($comments)?></span></button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div id="comments">
            <? foreach ($comments as $comment): ?>
                <div class="row comment-row">
                    <div class="comment-user-image span1"><a href="#" class="thumbnail"><img src="<?=$comment['User']['image']?>" class="img-rounded" /></a></div>
                    <div class="comment-main span8">
                        <div class="row">
                            <div class="comment-user-name span5">
                                <a href="#" class="bold-link"><?= htmlentities($comment['User']['name']) ?></a>
                                <?php
                                    // Get stance
                                    $stance = null;
                                    foreach ($all_votes as $vote) {
                                        if ($vote['User']['id'] == $comment['User']['id']) {
                                            $stance = $vote['Vote']['stances_id'];
                                            break;
                                        }
                                    }
                                ?>
                                <?php if ($stance == 1): ?>
                                   <span class="label label-success">Supporter</span>
                                <?php elseif ($stance == 3): ?>
                                   <span class="label label-important">Opposer</span>
                                <?php endif; ?>
                            </div>
                            <div class="comment-date span3"><?= date('M j, Y g:i a', strtotime($comment['Comment']['date'])) ?></div>
                        </div>
                        <div class="row">
                            <div class="comment-body span7 row"><?= $this->EvText->format($comment['Comment']['body']) ?></div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div id="votes" style="display:none">
            <?php foreach($all_votes as $vote) : ?>
                <div class="row <?=($vote['Vote']['stances_id']==1) ? 'support' : 'oppose'?>">
                    <div class="span1">
                        <a href="#" class="thumbnail"><img src="<?=$vote['User']['image']?>" class="img-rounded" /></a>
                    </div>
                    <div class="span5 bordered">
                        <a href="#" class="bold-link"><?= htmlentities($vote['User']['name']) ?></a><br/>
                        <?php if($vote['Vote']['stances_id']==1) : ?>
                        <span class="label label-success">Supporter</span>
                        <?php else: ?>
                        <span class="label label-important">Opposer</span>
                        <?php endif; ?>
                    </div>
                    <div class="span3">
                         <p><strong>Date:</strong> <?= date('M j, Y g:i a', strtotime($comment['Comment']['date'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="modal" style="display:none" id="add-comment-hover" tabindex="-1" role="dialog">
        <form action="<?= $this->base ?>/candidates/addComment" method="post" id="add-comment-form">
            <input type="hidden" name="candidate_id" value="<?= $candidate['Candidate']['id'] ?>" />
            <input type="hidden" name="election_id" value="<?= $electionID ?>" />
            <div class="modal-header">
                <h6>Add a Comment <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
            </div>

            <div class="modal-body" style="height:180px;">
                <div>
                    <strong style="display:block;">Comment:</strong>
                    <textarea name="comment" style="width:510px;height:140px;resize:none;"cols="40" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="save-comment"><em class="icon-ok icon-white"></em> Submit</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-remove"></em> Cancel</button>
            </div>
        </form>
    </div>

    <div class="modal" style="display:none" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h6>My Profile <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>

        </div>
        <div class="modal-body">
            <div class="row">
                <div class="span2"><img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" /></div>
                <div class="span4">
                    <h5><?=$currentUser['User']['name']?></h5>
                    <h6>About me:</h6>
                    <p>
                        <textarea id="aboutprofile" style="resize:none;width:300px" cols="30" rows="5"><?= $candidate['Candidate']['about_text'] ?></textarea>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="aboutupd" data-dismiss="modal" aria-hidden="true" onclick="editAbout(<?= $candidate['Candidate']['id'];?>)"><em class="icon-ok icon-white"></em>Okay</button>
        </div>
    </div>

    <div class="modal" style="display:none" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h6>Share the Profile <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>

        </div>
        <div class="modal-body">
            <div class="row">
                <div class="span2"><img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" /></div>
                <div class="span4">
                    <h5><?=$currentUser['User']['name']?></h5>
                    <h6>Message:</h6>
                    <p>
                        <textarea id="message" style="resize:none;width:300px" cols="30" rows="5"></textarea>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="aboutupd" data-dismiss="modal" aria-hidden="true" onclick="post(<?= $candidate['Candidate']['id'];?>)"><em class="icon-ok icon-white"></em>Share</button>
        </div>
    </div>
</div>
