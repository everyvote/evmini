
			 <div class="row">
				<div class="span1">
					<p><a href="#"><img src="img/uni_logo.png" id="clogo" class="img-rounded hidden" /></a></p>
				</div>
				<div class="span8">
					<p>
						<div class="dropdown" id="constituencyselect">
						  <strong>Constituency:</strong> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Select a constituency</span> <i class="icon-chevron-down"></i></a>
						  <ul class="dropdown-menu" role="menu">
							<?php foreach ($constituencies as $constituency): ?>
								<?php if($constituency['id']) : ?>
								<li id="c<?=h($constituency['id']);?>"><a href="#" onclick="selectConstituency(<?=h($constituency['id']);?>)"><?=h($constituency['name']);?></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						  						  						  						  						                            
						  </ul>
						</div>
					</p>
					<p>
						<div class="dropdown hidden" id="electionsselect">
						<strong>Election:</strong>  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Select an election</span> <i class="icon-chevron-down"></i></a>
						  <ul class="dropdown-menu" role="menu" id="electionslist">
						  						  						  						  						                            
						  </ul>
						 </div>
					</p>
					<p id="electionDescription">
						
					</p>
                </div>
                <div class="span9 hidden" id="sorting">
                	<div class="dropdown pull-left">
					  <strong>Showing:</strong> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>All Offices</span> <i class="icon-chevron-down"></i></a>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="#">All Offices</a></li>
						<span id="filterOffices"></span>	  						  						                            
					  </ul>
					</div>
                	
					<div class="dropdown pull-right">
					  <strong>Sort by:</strong> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Date Added</span> <i class="icon-chevron-down"></i></a>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="#">Date Added</a></li>
						<li><a href="#">Alphabetical</a></li>
						<li><a href="#">Most support votes</a></li>
						<li><a href="#">Most opposite votes</a></li>			  						                            
					  </ul>
					</div>					
				</div>
			</div>			  
			<hr>
			<div id="candidates">
				
			</div>