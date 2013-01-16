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
                    <div class="dropdown" id="addEcDrop">
                        <strong style="display:inline-block;width:140px;">Constituency:</strong> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Select a constituency</span> <i class="icon-chevron-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($constituencies as $constituency): ?>
                                <?php if($constituency['id']) : ?>
                                  <li id="addEc_<?=h($constituency['id']);?>"><a href="#" onclick="addEc(<?=h($constituency['id']);?>)"><?=h($constituency['name']);?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <input type="hidden" name="addEc" id="addEc" />
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
                        <p style="text-align:right;font-size:12px;color:#999;">use commas to separate</p>
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
                    <button class="btn btn-primary" disabled="disabled" data-dismiss="modal" aria-hidden="true" onclick="addElection();"><em class="icon-ok icon-white"></em> Okay</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><em class="icon-remove"></em> Cancel</button>
                </div>
            </div>

            <div class="modal" style="display:none" id="editElection" tabindex="-1" role="dialog">
                <div class="modal-header">
                    <h6>Edit Election <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
                </div>
                    <div class="modal-body" style="height:500px;">
                    <div class="dropdown" id="editEcDrop">
                        <strong style="display:inline-block;width:140px;">Constituency:</strong> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Select a constituency</span> <i class="icon-chevron-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($constituencies as $constituency): ?>
                                <?php if($constituency['id']) : ?>
                                    <li id="editEc_<?=h($constituency['id']);?>"><a href="#" onclick="editEc(<?=h($constituency['id']);?>)"><?=h($constituency['name']);?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <input type="hidden" name="editEc" id="editEc" />
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
                        <input name="offices" id="editEOffices" class="span5" size="16" type="text">
                        <p style="text-align:right;font-size:12px;color:#999;">use commas to separate</p>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Moderator:</strong>
                        <input id="emoderators" class="span5" size="16" type="text">
                        <ul id="emoderatorsList"></ul>
                        <input type="hidden" name="moderators" id="emods" />
                    </div>
                    <div>
                        <strong style="display:inline-block;width:140px;">Block Users:</strong>
                        <input id="eblockuser" class="span5" size="16" type="text">
                        <ul id="eblockuserList"></ul>
                        <input type="hidden" name="blockusers" id="eblockusrs" />
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

            <!-- Header container -->
            <div class="row">
                <div class="span2">
                    <a href="<?=Router::url('/', true)?>"><?=$this->Html->image(Router::url('/', true).'img/copy-logo.png')?></a>
                    <?php if($back) : ?>
                        <a class="btn btn-small btn-primary" id="back" href="<?php echo $this->base; ?>/elections/view/<?php echo $electionID; ?>">Return to Election</a>
                    <?php endif; ?>
                </div>
                <div class="span4 offset3 menu" id="menu">
                    <div>
                        <a class="btn btn-primary btn-small hidden" id="editE" href="#"><i class="icon-pencil icon-white"></i> Edit Election</a>
                        <a class="btn btn-small btn-primary" id="addE" href="#"> <i class="icon-plus icon-white"></i> Add Election</a>
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
        <?=$this->Html->script('bootstrap-datepicker.js');?>
        <?=$this->Html->script('bootstrap-combobox.js');?>
        <script>
        var mods=[];
        var emods=[];
        var currentElection=0;
        function addElection() {
            $.ajax({
                url: 'elections/add',
                type: "POST",
                dataType: 'json',
                data: {
                    constituency_id: $('#addEc').val(),
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
                        selectConstituency($('#addEc').val());
                        selectElection(result.election);
                        $('#addEc').val('');
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
                url: 'elections/edit/'+currentElection,
                type: "POST",
                dataType: 'json',
                data: {
                    constituency_id: $('#editEc').val(),
                    name: $('#editETitle').val(),
                    description: $('#editEDesc').val(),
                    startdate: $('#editEDate').val(),
                                        enddate: $('#editCDate').val(),
                                        offices: $('#editEOffices').val(),
                    mods: $('#emods').val()
                },
                success: function(data) {
                    result = eval(data);
                    if(result.status=="success") {
                        alert("Election updated successfully!");
                    }
                }
            });
            return false;
        }
        
        function getUsers() {
            $.ajax({
                url: 'users/json',
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
                            $('#blockusers').val('');
                            updateModerators();
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
                            emods.push(mod);
                            $('#eblockusers').val('');
                            updateEModerators();
                            return false;
                        }
                     };
                     $('#eblockusers').autocomplete(options);
                     return true;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  //  console.log(textStatus, errorThrown);  NOT SUPPORTeD IN IE
                  alert(errorThrown);
                    return true;
                }
            });
        }
        
        
        
        
        
        function updateElection() {
            $.ajax({
                url: 'elections/edit/'+currentElection,
                type: "POST",
                dataType: 'json',
                data: {
                    constituency_id: $('#editEc').val(),
                    name: $('#editETitle').val(),
                    description: $('#editEDesc').val(),
                    startdate: $('#editEDate').val(),
                                        enddate: $('#editCDate').val(),
                                        offices: $('#editEOffices').val(),
                    mods: $('#emods').val()
                },
                success: function(data) {
                    result = eval(data);
                    if(result.status=="success") {
                        alert("Election updated successfully!");
                    }
                }
            });
            return false;
        }
        function getModerators() {
            $.ajax({
                url: 'users/json',
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
                            $('#moderators').val('');
                            updateModerators();
                            return false;
                        }
                     };
                     $('#moderators').autocomplete(options);
                    options = {
                        source:eval(data),
                        autoFocus: true,
                        select:function(event,item){
                            var mod=[];
                            mod[0] = item.item.id;
                            mod[1] = item.item.value;
                            emods.push(mod);
                            $('#emoderators').val('');
                            updateEModerators();
                            return false;
                        }
                     };
                     $('#emoderators').autocomplete(options);
                     return true;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //console.log(textStatus, errorThrown);   NPT SUPPORTED IN IE9
                    alert(ErrorThrown);
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
                modlist+="<li>"+mod[1]+" <a href='#' onclick='removeEMod("+index+")'>[x]</a></li>";
                ids.push(mod[0]);

            });
            $('#emods').val(ids.join(","));
            $('#emoderatorsList').html(modlist);
        }
        function removeMod(index) {
            mods.splice(index,1);
            updateModerators();
        }
        function removeEMod(index) {
            emods.splice(index,1);
            updateEModerators();
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

         <?php if (!empty($callback) && $callback != "/"): ?>
            selectConstituency(<?php echo $constituentID; ?>);
            selectElection(<?php echo $officeID; ?>);
        <?php endif; ?>
        });

        </script>
    </body>

</html>