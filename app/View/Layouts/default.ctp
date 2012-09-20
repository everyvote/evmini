<!DOCTYPE html>
<html lang="en">

    <head>
        <?php echo $this->Html->charset(); ?>
    	<title>
    		<?php echo $title_for_layout; ?>
    	</title>
        <script type="text/javascript">
            var baseUrl = '<?php echo $this->base; ?>';
        </script>
        <?php 
            echo $this->Html->meta('icon');
            
			echo $this->Html->css('bootstrap.css');
			echo $this->Html->css('evmini.css');
			echo $this->Html->css('blitzer/jquery-ui-1.8.23.custom.css');
	        echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js'); 
	        echo $this->Html->script('bootstrap.min.js'); 
	        echo $this->Html->script('jquery-ui-1.8.23.custom.min.js'); 
	        
	        echo $this->fetch('meta');
    		echo $this->fetch('css');
    		echo $this->fetch('script');
        ?>
    </head>
    
    <body>
    <div class="container" style="width:760px">
        <!-- Header -->
        <div id="header" class="row-fluid">
            <div class="span12">
                <div class="span5">
                    <img src="img/ev-logo.png" />
                </div>
                <div class="span7" id="topnav">
                    <div class="btn-group" style="margin:3em">
                        <button class="btn">Edit Election</button>
                        <button class="btn">Add Election</button>
                        <button class="btn">My Profile</button>
                        <button class="btn">Run for Office</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="row-fluid">
            <div class="span12">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        
        <div id="footer" class="row-fluid">
        
        </div>
    </div>
    </body>
</html>
