<!DOCTYPE html>
<html lang="en">

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $this->fetch('title'); ?></title>
        <script type="text/javascript">
            var url = '<?php echo $this->base; ?>/';
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('bootstrap.min.css');
            echo $this->Html->css('main.css');
			/*
			 * We don't need jQuery UI yet
			 */
            //echo $this->Html->script('jquery-ui-1.8.23.custom.min.js');
            echo $this->Html->script('vendor/modernizr-2.6.1-respond-1.1.0.min.js');
        ?>
    </head>

    <body>
        <div class="container">
        	
			<div class="modal" style="display:none" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			  	<h6>My Profile <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
			    
			  </div>
			  <div class="modal-body">
			  	<div class="row">
			  		<div class="span1"><img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" /></div>
			  		<div class="span5"><h5><?=$currentUser['User']['name']?></h5></div>
			  	</div>
			  </div>
			  <div class="modal-footer">
			    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><em class="icon-ok icon-white"></em> Okay</button>
			  </div>
			</div>
			
			<div class="modal" style="display:none" id="runForOffice" tabindex="-1" role="dialog" aria-labelledby="runForOfficeLabel" aria-hidden="true">
			  <div class="modal-header">
			  	<h6>Run for <span id="runFor"></span> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
			    
			  </div>
			  <div class="modal-body">
			  	<div class="row">
			  		<div class="span2"><img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" /></div>
			  		<div class="span4">
			  			<h5><?=$currentUser['User']['name']?></h5>
			  			<h6>About me:</h6>
			  			<p>
			  				<textarea id="aboutrun" style="resize:none;width:300px" cols="30" rows="5"></textarea>
			  			</p>
			  		</div>
			  	</div>
			  </div>
			  <div class="modal-footer">
			    <button class="btn btn-danger" id="runbutton" data-dismiss="modal" aria-hidden="true"><em class="icon-ok icon-white"></em> Run</button>
			    <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-x"></em> Cancel</button>
			  </div>
			</div>
			
            <!-- Header container -->
			<div class="row">
			  	   	<div class="span2">
						<a href="<?=Router::url('/', true)?>"><?=$this->Html->image(Router::url('/', true).'img/copy-logo.png')?></a>
	                </div>         
					<div class="span4 offset3 menu" id="menu">
						<div>
							<a class="btn btn-primary btn-small hidden" id="editE" href="#"><i class="icon-pencil icon-white"></i> Edit Election</a>
							<a class="btn btn-small btn-primary hidden" id="addE" href="#"> <i class="icon-plus icon-white"></i> Add Election</a>
						</div> 
						<div class="pt5">
							<a class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal" href="#">My Profile</a>
							<div class="dropdown inline-block">
							<a class="btn btn-small btn-success hidden" id="run" class="dropdown-toggle" data-toggle="dropdown" href="#">Run for Office</a>
							  <ul class="dropdown-menu" role="menu" id="runUl" aria-labelledby="dLabel">				  						                            
							  </ul>
							  </div>
							<a class="btn btn-small btn-danger hidden" id="leave" href="#">Leave Race</a>
						</div>
                    </div>
			 </div>
			 <hr>
			 

        <?php echo $this->fetch('content'); ?>

        </div>
        <div id="debug"></div>
        <?=$this->Html->script('main.js');?>
        <?=$this->Html->script('vendor/bootstrap.min.js');?>
    </body>

</html>
