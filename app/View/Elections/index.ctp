<?php if (!empty($currentUser)) { ?>
	<h2>Current Facebook User</h2>
	<pre>
		<?php print_r($currentUser); ?>
	</pre>
<? } ?>

        <div class="row well election-info">
            <img src="http://www.niu.edu/masterto/themes/gradient_brown/images/NIU_logo.gif"/> The elections happen. Vote on 'em.
        </div>


        <!-- Candidate frame. should be a class helper eventually -->
        <div class="row well candidate-frame">

            <div class="span3" style="text-align:center;">

                <img src="https://graph.facebook.com/georgewbush/picture?type=large"/ class="img-polaroid">
                
                <div class="row">
                    
                    <div class="span3">
                        
                        <div class="btn-group">
                            <button class="btn" style="width:66px"><i class="icon-thumbs-up"></i></button>
                            <button class="btn" style="width:66px">o</button>
                            <button class="btn" style="width:66px"><i class="icon-thumbs-down"></i></button>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>

            <div class="span6">
                
                
                <span class="candidate-name">George Bush</span><br/>
                Running for <strong>President</strong> of NIU Student Association(2012-2013)
                <p/> <br/> Hundreds of thousands of American servicemen and women are deployed across the world in the war on terror. By bringing hope to the oppressed, and delivering justice to the violent, they are making America more secure.
                
            
            </div>
        
        </div>
