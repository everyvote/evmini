<div class="candidacies view">
    <h2><?php echo __('Candidate Profile'); ?></h2>

    <div class="row">

        <div class="span3">

            <p><a href="#" class="thumbnail"><img src="<?= $candidate['User']['image'] ?>" class="img-rounded" /></a></p>


            <p class="pagination-centered" id="votes<?= $candidate['Candidate']['id'] ?>">
                <?php //if(!$votes['casted']['Vote']['stances_id']) : ?>
                <a class="btn btn-small btn-success" id="votes<?= $candidate['Candidate']['id'] ?>_1" href="#" onclick="vote(<?= $candidate['Candidate']['id'] ?>,1);">
                    <i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?= $candidate['Candidate']['id'] ?>_1"><?= $votes['positive'] ?></span>
                </a>
                <a class="btn btn-small btn-danger" id="votes<?= $candidate['Candidate']['id'] ?>_3" href="#" onclick="vote(<?= $candidate['Candidate']['id'] ?>,3);">
                    <i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?= $candidate['Candidate']['id'] ?>_3"><?= $votes['negative'] ?></span></a>
                <?php //else : ?>
                <!--
                                <a class="btn btn-small disabled <?= $votes['casted']['Vote']['stances_id'] == 1 ? 'btn-success' : '' ?>" id="votes<?= $candidate['Candidate']['id'] ?>_1" href="#"><i class="icon-thumbs-up"></i><span class="badge badge-inverse" id="votes_c<?= $candidate['Candidate']['id'] ?>_1"><?= $votes['positive'] ?></span></a>
                <a class="btn btn-small disabled <?= $votes['casted']['Vote']['stances_id'] == 3 ? 'btn-danger' : '' ?>" id="votes<?= $candidate['Candidate']['id'] ?>_3" href="#"><i class="icon-thumbs-down"></i><span class="badge badge-inverse" id="votes_c<?= $candidate['Candidate']['id'] ?>_3"><?= $votes['negative'] ?></span></a>
                -->
                <?php //endif; ?>
            </p>
            <p class="pagination-centered">
                <a class="btn btn-small" href="#" onclick="comment(<?= $candidate['Candidate']['id'] ?>);"><i class="icon-comment"></i> Add new comment <span class="badge badge-inverse" id="votes_c<?= $candidate['Candidate']['id'] ?>_2"><?= 0 ?></span></a>
            </p>

        </div>



        <div class="span6">

            <button class="btn pull-right btn-small btn-primary" id="share" data-toggle="modal" data-target="#shareModal"><i class="icon-white icon-bullhorn"></i> Share the profile</button>
            <h3><a href="#"><?= $candidate['User']['name'] ?></a></h3>

            <p><strong>Running for:</strong> <?= $candidate['Office']['name'] ?> <em>(<?= $candidate['Office']['term_end'] ?>)</em></p>


            <p id="aboutme"><?= $candidate['Candidate']['about_text'] ?></p>

            <p><a data-toggle="modal" data-target="#aboutModal" href="#">Edit Profile</a></p>


        </div>

    </div>

    <hr>


    <div class="row">

        <div class="span9">

            <div class="btn-group" data-toggle="buttons-radio">

                <button class="btn btn-small active" onclick="$('.support').fadeIn();$('.oppose').fadeIn();">See all votes <span class="badge"><?= $votes['positive'] + $votes['negative'] ?></span></button>

                <button class="btn btn-success btn-small" onclick="$('.support').fadeIn();$('.oppose').fadeOut();">See all supporters <span class="badge badge-success"><?= $votes['positive'] ?></span></button>

                <button class="btn btn-danger btn-small" onclick="$('.support').fadeOut();$('.oppose').fadeIn();">See all opposers <span class="badge badge-important"><?= $votes['negative'] ?></span></button>

            </div>

        </div>

    </div>

    <hr>
    <?php foreach ($all_votes as $vote) : ?>
        <div class="row <?= ($vote['Vote']['stances_id'] == 1) ? 'support' : 'oppose' ?>">
            <div class="span1">
                <p><a href="#" class="thumbnail"><img src="<?= $vote['User']['image'] ?>" class="img-rounded"></a></p>
            </div>
            <div class="span3 bordered">
                <p><strong><a href="#"><?= $vote['User']['name'] ?></a></strong> <br>
                    <?php if ($vote['Vote']['stances_id'] == 1) : ?>
                        <span class="label label-success">Supporter</span>	
                    <?php else: ?>
                        <span class="label label-important">Opposer</span>	
                    <?php endif; ?>
                    <? /* <strong>Running for:</strong> Senator <em>(03-21-2012)</em></p> */ ?>
            </div>
            <div class="span2">
                <!-- Button to trigger modal -->
                <a href="#" role="button" class="btn btn-small"><i class="icon-comment"></i> View Comments</a>
            </div>
            <div class="span2">
                <p><strong>Date:</strong> <?= date('Y-m-d', strtotime($vote['Vote']['added'])) ?></p>
            </div>
        </div>
    <?php endforeach; ?>

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
    