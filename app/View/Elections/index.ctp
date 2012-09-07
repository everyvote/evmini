<h2>Elections</h2>
<pre>
	<?php print_r($elections); ?>
</pre>

<?php if (!empty($currentUser)) { ?>
	<h2>Current Facebook User</h2>
	<pre>
		<?php print_r($currentUser); ?>
	</pre>
<? } ?>