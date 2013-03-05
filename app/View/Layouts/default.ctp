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
            echo $this->Html->css('datepicker.css');
            echo $this->Html->css('redmond/jquery-ui.min.css');
            echo $this->Html->css('bootstrap-combobox.css');
            echo $this->fetch('css');

            echo $this->Html->script('vendor/jquery-ui.min.js');
            echo $this->Html->script('vendor/modernizr-2.6.1-respond-1.1.0.min.js');
            echo $this->fetch('script');
        ?>
    </head>

    <body>
        <div class="container">
            <div class="modal" style="display:none" id="addElection" tabindex="-1" role="dialog">
                <div class="modal-header">
                    <h6>Add New Election <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
                </div>

                <div class="modal-body" style="height:500px;">
                    <div>
                        <strong style="display:inline-block;width:140px;"><?=ucfirst($CONSTITUENCY)?></strong>
                        <?php echo $this->EvForm->selector('Constituency', 'add', 'span5', 'addEc(ui.item.id)'); ?>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Election:</strong>
                        <input type="text" class="span5" id="addETitle" name="election" />
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Election date:</strong>
                        <input class="datepicker span5" name="date" id="addEDate" size="16" type="text">
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Close date:</strong>
                        <input class="datepicker span5" name="closedate" id="addCDate" size="16" type="text">
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Offices:</strong>
                        <input name="offices" id="addEOffices" class="span5" size="16" type="text">
                        <p style="font-size:12px;color:#999;">use commas to separate, include district #s (example: Senator - District 1, etc.)</p>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Moderator:</strong>
                        <input id="moderators" class="span5" size="16" type="text">
                        <ul id="moderatorsList"></ul>
                        <input type="hidden" name="moderators" id="mods" />
                    </div>
                    <div>
                        <strong style="display:block;">Election description:</strong>
                        <textarea name="description" id="addEDesc" style="width:510px;height:140px;resize:none;"cols="40" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onclick="addElection();"><em class="icon-ok icon-white"></em> Okay</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-remove"></em> Cancel</button>
                </div>
            </div>

            <div class="modal" style="display:none" id="editElection" tabindex="-1" role="dialog">
                <div class="modal-header">
                    <h6>Edit Election <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
                </div>
                    <div class="modal-body" style="height:500px;">
                    <div>
                        <strong style="display:inline-block;width:140px;"><?=ucfirst($CONSTITUENCY)?></strong>
                        <?php echo $this->EvForm->selector('Constituency', 'edit', 'span5'); ?>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Election:</strong>
                        <input type="text" class="span5" id="editETitle" name="election" />
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Election date:</strong>
                         <input class="datepicker span5" name="date" id="editEDate" size="16" type="text">
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Close date:</strong>
                        <input class="datepicker span5" name="closedate" id="editCDate" size="16" type="text">
                    </div>
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">Offices:</strong>
                        <input id="eoffices" class="span5" size="16" type="text">
                        <ul id="eofficesList"></ul>
                        <input type="hidden" name="offices" id="eoffs" />
                    </div>
                    
                    
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">Moderator:</strong>
                        <input id="emoderators" class="span5" size="16" type="text">
                        <ul id="emoderatorsList"></ul>
                        <input type="hidden" name="moderators" id="emods" />
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Block Users:</strong>
                        <input id="eblockusers" class="span5" size="16" type="text">
                        <ul id="eblockuserList"></ul>
                        <input type="hidden" name="blockusers" id="eblock" />
                    </div>
                    <div>
                        <strong style="display:block;">Election description:</strong>
                        <textarea name="description" id="editEDesc" style="width:510px;height:140px;resize:none;"cols="40" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onclick="updateElection();"><em class="icon-ok icon-white"></em> Okay</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-remove"></em> Cancel</button>
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


            <div class="modal" style="display:none; width: 660px;" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <h6>My Profile <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
                </div>
                <div class="modal-body">
                <?php
                    if (isset($allConstituencies)  && !empty($allConstituencies)) :
                        foreach($allConstituencies as $profile) :?>
                            <div class="row">
                                <div class="span1">
                                    <a href="/candidates/view/<?php echo $profile['Candidate']['id']; ?>/<?php echo $profile['Candidate']['election_id']; ?>">
                                        <img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" />
                                    </a>
                                </div>
                                <div class="span2">
                                    <a href="/candidates/view/<?php echo $profile['Candidate']['id']?>/<?php echo $profile['Candidate']['election_id']; ?>">
                                        <h5><?=$currentUser['User']['name']?></h5>
                                    </a>
                                </div>
                                <div class="span4">
                                    <a href="/candidates/view/<?php echo $profile['Candidate']['id']?>/<?php echo $profile['Candidate']['election_id']; ?>">
                                        <h6 style="margin: 10px 0 0     0;"><?php echo $profile['Election']['Constituency']['name']; ?></h6>
                                    </a>
                                    <a href="/candidates/view/<?php echo $profile['Candidate']['id']; ?>/<?php echo $profile['Candidate']['election_id']?>">
                                        <h6 style="margin: 0 0 10px;"><?php echo $profile['Election']['name']; ?></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row"></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="span1">
                                <img src="<?=$currentUser['User']['image']?>" alt="<?=$currentUser['User']['name']?>" class="img-rounded" />
                            </div>
                            <div class="span2"><h5><?=$currentUser['User']['name']?></h5></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><em class="icon-ok icon-white"></em> Okay</button>
                </div>
            </div>
            
            
            
            <div class="modal" style="display:none; width: 660px;" id="contactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <h6>Contact Us <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
                </div>
                <div class="modal-body">
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">Name</strong>
                        <input type="text" class="span5" id="contactName" name="contactName" />
                    </div>
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">Email Address</strong>
                        <input type="text" class="span5" id="contactEmail" name="contactEmail" />
                    </div>
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">University Name</strong>
                        <input type="text" class="span5" id="contactUniversity" name="contactUniversity" />
                    </div>
                    
                    <div>
                        <strong style="display:inline-block;width:140px;">Message</strong>
                        <textarea name="description" id="contactMessage" style="width:410px;height:140px;resize:none;"cols="40" rows="10"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="contactbutton" data-dismiss="modal" aria-hidden="true" onclick="contactEV();"><em class="icon-ok icon-white"></em> Submit</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-x"></em> Cancel</button>
                </div>
            </div>

            <!-- Header container -->
            <div class="row">
                <div class="span2">
                    <a href="<?=Router::url('/', true)?>"><?=$this->Html->image(Router::url('/', true).'img/copy-logo.png')?></a>
                    <a id="contactEV" data-target="#contactForm" data-toggle="modal" href="#">Contact EV</a>
                </div>
                <?php 
                    if ($back) : ?>
                <div class="span1 offset3 menu" id="menu" style="float:left">
                    <a class="btn btn-small btn-primary" id="back" href="<?php echo $this->base; ?>/elections/view/<?php echo $electionID; ?>">Return to Election</a>
                </div> 
                <div class="span6 offset3 menu" id="menu">
                    <div>
                        <a class="btn btn-primary btn-small hidden" id="editE" href="#"><i class="icon-pencil icon-white"></i> Edit Election</a>
                        <a class="btn btn-small btn-primary" id="addE" href="#"> <i class="icon-plus icon-white"></i> Add Election</a>
                        <a class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal" href="#">My Profile</a>
                        <div class="dropdown inline-block">
                        <a class="btn btn-small btn-success hidden" id="run" class="dropdown-toggle" data-toggle="dropdown" href="#">Run for Office</a>
                          <ul class="dropdown-menu" role="menu" id="runUl" aria-labelledby="dLabel">
                          </ul>
                          </div>
                        <a class="btn btn-small btn-danger hidden" id="leave" href="#">Leave Race</a>
                    </div>
                </div>
                <?php 
                    else: ?>
                <div class="span7 offset3 menu" id="menu">
                    <div>
                        <a class="btn btn-primary btn-small hidden" id="editE" href="#"><i class="icon-pencil icon-white"></i> Edit Election</a>
                        <a class="btn btn-small btn-primary" id="addE" href="#"> <i class="icon-plus icon-white"></i> Add Election</a>
                        <a class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal" href="#">My Profile</a>
                        <div class="dropdown inline-block">
                        <a class="btn btn-small btn-success hidden" id="run" class="dropdown-toggle" data-toggle="dropdown" href="#">Run for Office</a>
                          <ul class="dropdown-menu" role="menu" id="runUl" aria-labelledby="dLabel">
                          </ul>
                          </div>
                        <a class="btn btn-small btn-danger hidden" id="leave" href="#">Leave Race</a>
                    </div>
                </div>
                <?php endif ?>    
            </div>
            <hr>
            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="debug"></div>
        <?=$this->Html->script('main.js');?>
        <?=$this->Html->script('vendor/bootstrap.min.js');?>
        <?=$this->Html->script('bootstrap-datepicker.js');?>
        <?=$this->Html->script('bootstrap-combobox.js');?>
        <script>
        var mods=[];
        var emods=[];
        var users=[];
        var eusers=[];
        var eoffs= [];
        var currentElection=0;
        var blockthisuser=0;
        function addElection() {
            $.ajax({
                url: url+'elections/add',
                type: "POST",
                dataType: 'json',
                data: {
                    constituency_id: $('#ConstituencyaddValue').val(),
                    name: $('#addETitle').val(),
                    description: $('#addEDesc').val(),
                    startdate: $('#addEDate').val(),
                    enddate: $('#addCDate').val(),
                    offices: $('#addEOffices').val(),
                    mods: $('#mods').val()
                },
                success: function(data) {
                    result = eval(data);
                    if(result.status=="success") {
                        selectConstituency($('#ConstituencyaddValue').val());
                        selectElection(result.election);
                        $('#ConstituencyaddValue').val('');
                        $('#addETitle').val('');
                        $('#addEDesc').val('');
                        $('#addEDate').val('');
                        $('#addCDate').val('');
                        $('#addEOffices').val(''),
                        $('#mods').val('');
                        mods=[];
                    }
                }
            });
            return false;
        }
        
        function updateElection() {
            $.ajax({
                url: url+'elections/edit/'+currentElection,
                type: "POST",
                dataType: 'json',
                data: {
                    constituency_id: $('#ConstituencyeditValue').val(),
                    name: $('#editETitle').val(),
                    description: $('#editEDesc').val(),
                    startdate: $('#editEDate').val(),
                    enddate: $('#editCDate').val(),
                    offices: $('#editEOffices').val(),
                    mods: $('#emods').val(),
                    blockusers: $('#eblock').val(),
                    office: $('#eoffices').val(),
                    officeid: $('#eoffs').val(),
                },
                success: function(data) {
                    result = eval(data);
                    if(result.status=="success") {
                        selectElection(currentElection);
                        $('#eoffices').val('');
                    }
                }
            });
            return false;
        }
        
        function contactEV() {
            $.ajax({
                url: url+'constituencies/contact/',
                type: "POST",
                dataType: 'json',
                data: {
                    name: $('#contactName').val(),
                    email: $('#contactEmail').val(),
                    university: $('#contactUniversity').val(),
                    message: $('#contactMessage').val(),
                },
                success: function(data) {
                    result = eval(data);
                }
            });
            return false;
        }
        
        function getUsers() {
            $.ajax({
                url: url+'users/json',
                dataType: 'json',
                async: false,
                success: function(data) {
                    options = {
                        source:eval(data),
                        autoFocus: true,
                        select:function(event,item){
                            var mod=[];
                            mod[0] = item.item.id;
                            mod[1] = item.item.value;
                            users.push(mod);
                            $('#blockusers').val('');
                            updateBlockUsers();
                            return false;
                        }
                     };
                    $('#blockusers').autocomplete(options);
                    options = {
                        source:eval(data),
                        autoFocus: true,
                        select:function(event,item){
                            var mod=[];
                            mod[0] = item.item.id;
                            mod[1] = item.item.value;
                            eusers.push(mod);
                            $('#eblockusers').val('');
                            updateEBlockUsers();
                            return false;
                        }
                     };
                     $('#eblockusers').autocomplete(options);
                     return true;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  //  console.log(textStatus, errorThrown);  NOT SUPPORTeD IN IE
                  return true;
                }
            });
        }
        
        function getModerators() {
            $.ajax({
                url: url+'users/json',
                dataType: 'json',
                async: false,
                success: function(data) {
                    options = {
                        source:eval(data),
                        autoFocus: true,
                        select:function(event,item){
                            var mod=[];
                            mod[0] = item.item.id;
                            mod[1] = item.item.value;
                            mods.push(mod);
                            emods.push(mod);
                            $('#moderators').val('');
                            $('#emoderators').val('');
                            updateModerators();
                            updateEModerators();
                            return false;
                        }
                     };
                     $('#moderators').autocomplete(options);
                     $('#emoderators').autocomplete(options);
                     return true;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //console.log(textStatus, errorThrown);   NPT SUPPORTED IN IE9
                    return true;
                }
            });
        }
        
        function getOffices() {
            $.ajax({
                url: url+'offices/json/'+currentElection,
                dataType: 'json',
                async: false,
                success: function(data) {
                    options = {
                        source:eval(data),
                        autoFocus: true,
                        select:function(event,item){
                            var mod=[];
                            off[0] = item.item.id;
                            off[1] = item.item.value;
                            eoffs.push(off);
                            $('#eoffices').val('');
                            updateEOffices();
                            return false;
                        }
                     };
                     return true;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //console.log(textStatus, errorThrown);   NPT SUPPORTED IN IE9
                    return true;
                }
            });
        }
        
        function updateModerators() {
            var modlist = '';
            var ids = [];
            jQuery.each(mods, function(index, mod) {
                modlist+="<li>"+mod[1]+" <a href='#' onclick='removeMod("+index+")'>[x]</a></li>";
                ids.push(mod[0]);

            });
            $('#mods').val(ids.join(","));
            $('#moderatorsList').html(modlist);
        }
        
        function updateEModerators() {
            var modlist = '';
            var ids = [];
            jQuery.each(emods, function(index, mod) {
                modlist+="<li>"+mod[1]+" <a href='#' onclick='removeMod("+index+")'>[x]</a></li>";
                ids.push(mod[0]);

            });
            $('#emods').val(ids.join(","));
            $('#emoderatorsList').html(modlist);
        }
        
        function updateBlockUsers() {
            var userlist = '';
            var ids = [];
            jQuery.each(users, function(index, user) {
                userlist+="<li>"+user[1]+" <a href='#' onclick='removeUser("+index+")'>[x]</a></li>";
                ids.push(user[0]);

            });
            $('#block').val(ids.join(","));
            $('#blockuserList').html(userlist);
        }
        
        function updateEBlockUsers() {
            var userlist = '';
            var ids = [];
            jQuery.each(eusers, function(index, user) {
                userlist+="<li>"+user[1]+" <a href='#' onclick='removeEUser("+index+")'>[x]</a></li>";
                ids.push(user[0]);

            });
            $('#eblock').val(ids.join(","));
            $('#eblockuserList').html(userlist);
        }
        
        function updateEOffices() {
            var officelist = '';
            var ids = [];
            jQuery.each(eoffs, function(index, off) {
                officelist+="<li><a href='#' onclick='editEOffice("+index+")'>"+off[1]+"</a> <a href='#' onclick='removeEOffice("+index+")'>[x]</a></li>";
                ids.push(off[0]);
            
            });
            
            $('#eofficesList').html(officelist);
        }
        
        function removeMod(index) {
            mods.splice(index,1);
            emods.splice(index,1);
            updateEModerators();

        }
        function removeEMod(index) {
            emods.splice(index,1);
            mods.splice(index,1);
            updateEModerators();
        }
        
        function removeEOffice(index) {
            
            $.ajax({
                url: url+'offices/json_delete/'+eoffs[index][0],
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    eoffs.splice(index,1);            
                    updateEOffices(index);  
                }
            });
                        
        }
        
        function editEOffice(index) {
            
            $('#eoffices').val(eoffs[index][1]);
            $('#eoffs').val(eoffs[index][0]);
        }
        
        function removeUser(index) {
            users.splice(index,1);
            updateBlockUsers();
        }
        function removeEUser(index) {
            eusers.splice(index,1);
            updateEBlockUsers();
        }
        
        $(document).ready(function(){
            $('#addE').click(function() {
                mods = []
                var mod=[];
                mod[0] = '<?php echo $currentUser['User']['id']; ?>'
                mod[1] = '<?php echo $currentUser['User']['name']; ?>'
                mods.push(mod);
                updateModerators();
                $('#addElection').modal('show');
            });
            
            $('#editE').click(function() {
                $('#editElection').modal('show');
            });
            $('.datepicker').datepicker();
            $('.combobox').combobox();

            $(".combobox").change(function() {
                if ($(this).val()) {
                    selectConstituency($(this).val());
                }
            });
            getModerators();
            getUsers();
            getOffices();

         <?php if (!empty($callback) && $callback != "/"): ?>
            selectConstituency(<?php echo $constituentID; ?>);
            selectElection(<?php echo $officeID; ?>);
        <?php endif; ?>
        });
        
        </script>
        
    </body>

</html>
