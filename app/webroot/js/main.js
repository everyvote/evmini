var election=0;
var url = "http://evmini.jobcloud.bg/";
function selectConstituency(id) {
	$('#constituencyselect a span').html($('#c'+id+" a").html());
	$('#clogo').hide().removeClass('hidden');
	$.ajax({
  		url:url+'elections/listByConstituency/'+id,
  		success: function(data) {
			$('#electionsselect').hide().removeClass('hidden').fadeIn('slow');
			$('#electionslist').html(data);
  		}
	});
	$.ajax({
		url:url+'constituencies/loadLogo/'+id,
		success: function(filename) {
			$('#clogo').attr('src','img/'+filename).fadeIn('slow');
		}
	});
}
function selectElection(id) {
		$('#electionsselect a span').html($('#e'+id+" a").html());
		$.ajax({
	  		url:url+'elections/load/'+id,
	  		success: function(data) {
	  			data = eval( '(' + data + ')' );
				
				if(data.run) {
					$('#leave').hide().attr('onclick','leaveRace('+data.run+')').removeClass('hidden').fadeIn('slow');
					$('#run').hide();
				}
				else {
					$('#run').hide().removeClass('hidden').fadeIn('slow');
					$('#leave').hide();
				}
				$('#electionDescription').fadeOut('fast', function() {
					$(this).html(data.description).fadeIn('slow');
					runUl = "";
					filterUi = "";
					$.each(data.offices, function(i, office) {
						runUl += "<li><a href='#' onclick='run("+data.offices[i].Office.id+",\""+data.offices[i].Office.name+"\")'>"+data.offices[i].Office.name+"</li>";
						filterUi += "<li><a href='#'>"+data.offices[i].Office.name+"</li>";
					});
					$('#runUl').html(runUl);
					$('#filterOffices').html(filterUi);
					if(data.moderate) {
						editEc(data.constituency_id);
						$('#editETitle').val(data.name);
						$('#editEDesc').val(data.description);
						$('#editEDate').val(data.startdate);
						currentElection = id;
						if($('#editE').hasClass('hidden')) {
							$('#editE').hide().removeClass('hidden').fadeIn('slow');
						}
						if($('#addE').hasClass('hidden')) {
							$('#addE').hide().removeClass('hidden').fadeIn('slow');
						}
						$.each(data.mods,function(index,item){
							var mod=[]
							mod[0]=item.User.id;
							mod[1]=item.User.name;
							emods.push(mod);
							updateEModerators();
						});
					}
					else {
						$('#editE').fadeOut('fast',function() {
							$('#editE').addClass('hidden');
						});
						$('#addE').fadeOut('fast',function() {
							$('#addE').addClass('hidden');
						});
					}
					if($('#sorting').hasClass('hidden')) {
						$('#sorting').hide().removeClass('hidden').fadeIn('slow');
					}
					loadCandidates(id,0,0);
					election = id;
				});
	  		}
		});
}
function loadCandidates(election,filter,sorting) {
	$.ajax({
		url:url+'candidates/listByElection/'+election+'/'+filter+'/'+sorting,
		success: function(data) {
			$('#candidates').fadeOut('slow',function() {
				$(this).html(data).fadeIn('slow');
			});
		}
	});
}
function run(id,title) {
	$('#aboutrun').val('');
	$('#runForOffice').modal('show');
	$('#runFor').html(title);
	$('#runbutton').attr('onclick','runFor('+id+')');
}
function runFor(id) {
	$.ajax({
		url:url+'candidates/run/'+id,
		type: "POST",
		data: {description: $('#aboutrun').val()},
		success: function(data) {
			selectElection(election);
		}
	});
}
function leaveRace(id) {
	if(confirm("Are you sure that you want to leave this race?")) {
		$.ajax({
			url:url+'candidates/leave/'+id,
			success: function(data) {
				$('#leave').hide();
				$('#run').removeClass('hidden').show();
				selectElection(election);
			}
		});
	}
}
function vote(candidate,id) {
	if(confirm("Are you sure with your vote for this candidate?")) {
	$.ajax({
		url:url+'votes/cast/'+candidate+'/'+id,
		success: function(data) {
			$('#votes'+candidate+" .btn").attr('onclick','').addClass('disabled');
	  		if(id==1) {
	  			$('#votes'+candidate+"_3").removeClass('btn-danger');
	  			$('#votes'+candidate+"_3 .icon-white").removeClass('icon-white');
	  		}
	  		else if(id==3) {
	  			$('#votes'+candidate+'_1').removeClass('btn-success');
	  			$('#votes'+candidate+"_1 .icon-white").removeClass('icon-white');
	  		}
	  		data = eval( '(' + data + ')' );
	  		$('#votes_c'+candidate+'_1').html(data.Votes.positive);
	  		$('#votes_c'+candidate+'_2').html(data.Votes.neutral);
	  		$('#votes_c'+candidate+'_3').html(data.Votes.negative);
		}
	});
	}
}
function post(candidate) {
	$.ajax({
		url:url+'candidates/post/'+candidate,
		success: function(data) {
			$('#share').html('Profile shared!').removeAttr('onclick').addClass('disabled');
		}
	});
}

function addEc(id) {
	$('#addEc').val(id);
	$('#addEcDrop a span').html($('#editEc_'+id+' a').html());
}
function editEc(id) {
	$('#editEc').val(id);
	$('#editEcDrop a span').html($('#editEc_'+id+' a').html());
}