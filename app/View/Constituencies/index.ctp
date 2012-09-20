<h1>Welcome to EveryVote!</h1>
<?php echo $this->Form->input('constituency',array('label' =>'Find Organization:')); ?>

<h3>Elections</h3>
<div id="elections-index">
    Please search for your organization above...
</div>
<script type="text/javascript">
$(function(){
	$('#constituency').autocomplete({
		minLength: 2,
		source: baseUrl + '/constituencies/search.json',
		select: function( event, ui ) {
		    if (ui.item) {
    		    $.getJSON(baseUrl + '/elections/find.json?constituency_id=' + ui.item.value, function(data){
    		        $("#elections-index").html(ui.item.id);
    		    });
		    } else {
		        $("#elections-index").html("Organization not found");
		    }
		}
	});
});
</script>