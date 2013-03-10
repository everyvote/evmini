var election=0;
var constituency=0;
var filter_id = 0;
var sorting_id = 0;
function selectConstituency(id) {
   // $('#constituencyselect a span').html($('#c'+id+" a").html());
   // $('#clogo').hide().removeClass('hidden');

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
    constituency=id;
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
                $(this).html(nl2br(text2link(data.description))).fadeIn('slow');
                runUl = "";
                filterUi = "";
                $.each(data.offices, function(i, office) {
                    runUl += "<li><a href='#' onclick='run("+data.offices[i].Office.id+",\""+data.offices[i].Office.name+"\")'>"+data.offices[i].Office.name+"</li>";
                    filterUi += "<li id='o-"+data.offices[i].Office.id+"'><a href='#' onclick='filterElections("+data.offices[i].Office.id+");'>"+data.offices[i].Office.name+"</li>";
                });
                $('#runUl').html(runUl);
                $('#filterOffices').html(filterUi);
                blockthisuser = data.blockthisuser;
                if(data.moderate) {
                    editEc(data.constituency_id);
                    $('#editETitle').val(data.name);
                    $('#editEDesc').val(data.description);
                    $('#editEDate').val(data.startdate);
                    $('#editCDate').val(data.enddate);
                    currentElection = id;
                    if($('#editE').hasClass('hidden')) {
                        $('#Constituencyedit input').val( data.constituency_name ).text();
                        $('#ConstituencyeditValue').val( data.constituency_id );
                        $('#editE').hide().removeClass('hidden').fadeIn('slow');
                    }
                    if($('#addE').hasClass('hidden')) {
                        $('#addE').hide().removeClass('hidden').fadeIn('slow');
                    }
                    emods = [];
                    $.each(data.mods,function(index,item){
                        var mod=[]
                        mod[0]=item.User.id;
                        mod[1]=item.User.name;
                        emods.push(mod);
                        mods.push(mod);
                        updateEModerators();
                    });
                    
                    eusers = [];
                    $.each(data.blockusers,function(index,item){
                        if (item) {
                        var mod=[]
                        mod[0]=item.User.id;
                        mod[1]=item.User.name;
                        eusers.push(mod);
                        users.push(mod);
                        updateEBlockUsers();
                        }
                    });
                    
                    eoffs = [];
                    $.each(data.offices, function(index, item){
                        if (item) {
                            var off=[] 
                                off[0]=item.Office.id;
                                off[1]=item.Office.name;
                                eoffs.push(off);
                                updateEOffices();
                        }
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
                
                // Load set of candidates randomly.
                loadCandidates(id,0,5);
                // Reset the sort/filter list
                $('#sort-list span').html('Random');
                $('#filter-list span').html('All Offices');
                filter_id = 0;
                sorting_id = 0;
                
                election = id;
            });
            $('#electionModerator').fadeOut('fast', function() {
                _mods = "";
                $.each(data.mods,function(index,item){
                    if (item) {
                        _mods += item.User.name + "<br/>";
                    }
                });
                if (_mods != "") {
                    $(this).html("<strong>Moderator(s):</strong><br/>" + _mods).fadeIn('slow');
                }
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
        data: {
            description: $('#aboutrun').val()
            },
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
    if (blockthisuser == 1) {
        alert('You are not able to vote for this candidate.');
    } else {
        
        $.ajax({
            url:url+'votes/cast/'+candidate+'/'+id,
                success: function(data) {
                    data = eval( '(' + data + ')' );
                    $('#votes_c'+candidate+'_1').html(data.Votes.positive);
                    $('#votes_c'+candidate+'_2').html(data.Votes.neutral);
                    $('#votes_c'+candidate+'_3').html(data.Votes.negative);
                }
            });
    }
}
function post(candidate,electionID) {
    $.ajax({
        url:url+'candidates/post/'+candidate+'/'+electionID,
        type: "POST",
        data: {
            message: $('#message').val()
            },
        success: function(data) {
            $('#share').html('Profile shared!').removeAttr('onclick').addClass('disabled');
        }
    });
}

function postElection() {
    $.ajax({
        url:url+'elections/post/'+election,
        type: "POST",
        data: {
            message: $('#message').val()
            },
        success: function(data) {
            $('#share').html('Election shared!').removeAttr('onclick').addClass('disabled');
        }
    });
}

function addEc(id) {
   // $('#ConstituencyaddValue').val(id);
    $('#addEcDrop a span').html($('#editEc_'+id+' a').html());
    $('div.modal-footer button.btn-primary').removeAttr('disabled');
}
function editEc(id) {
    $('#ConstituencyeditValue').val(id);
    $('#editEcDrop a span').html($('#editEc_'+id+' a').html());
}

function editAbout(id) {

    $.ajax({
        url:url+'candidates/editAbout/'+id,
        type: "POST",
        data: {
            description: $('#aboutprofile').val()
            },
        success: function(data) {
            $("#aboutme").html($('#aboutprofile').val());
        }
    });
}

function sortElection(id) {
    sorting_id = id;
    $('#sort-list span').html($('#sorting div.pull-right ul li[id='+id+'] a').html());
 //   $('#filter-list span').html('All Offices');
    loadCandidates(election,filter_id,id);
}

function filterElections(id) {
    filter_id = id;
    $('#filter-list span').html($('#sorting div.pull-left ul li[id=o-'+id+'] a').html());
//    $('#sort-list span').html('Random');
    loadCandidates(election, id, sorting_id);
}

function removeComment(id) {
    $.ajax({
        url:url+'comments/delete/'+id,
        type: "POST",
        data: {
            },
        success: function(data) {
            window.location.reload();
        }
    });
}

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function text2link(inputText) {
    //URLs starting with http://, https://, or ftp://
    var replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with www. (without // before it, or it'd re-link the ones done above)
    var replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    var replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links
    var replacePattern3 = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim;
    var replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    return replacedText
}