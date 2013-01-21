<?php foreach($elections as $election) : ?>
	<li id="e<?=h($election['Election']['id']);?>"><a href="#" onclick="selectElection(<?=h($election['Election']['id']);?>)"><?=h($election['Election']['name']);?></a></li>
<?php endforeach; ?>