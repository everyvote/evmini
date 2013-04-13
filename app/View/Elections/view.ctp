    <div class="row">
        <div class="span1">
            <p><a href="#"><img src="img/uni_logo.png" id="clogo" class="img-rounded hidden" /></a></p>
        </div>
        <div class="span9">
            <p>
                <div class="span3" style="float:right; margin:24px 0 0;">
                    <button class="btn pull-right btn-small btn-primary" id="share" data-toggle="modal" data-target="#shareModal"><i class="icon-white icon-bullhorn"></i> <?=__("Választás megosztása") ?></button>
                </div>
                <div>
                        <strong style="display:inline-block;width:140px;"><?=ucfirst($CONSTITUENCY)?></strong>
                        <?php echo $this->EvForm->selector('Constituency', 'edit', 'span5', 'selectConstituency(ui.item.id)'); ?>
                </div>
            </p>
        </div>

        <div class="span9">
            <p>
                <div class="dropdown hidden" id="electionsselect">
                    <strong><?=__("Választás:") ?></strong>  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><?php echo $election['Election']['name']; ?></span> <i class="icon-chevron-down"></i></a>
                    <ul class="dropdown-menu" role="menu" id="electionslist">

                    </ul>
                </div>
            </p>

            <p id="electionDescription">

            </p>
        </div>

        <div class="span9">
            <p id="electionModerator">


            </p>

        </div>

        <div class="span9 hidden" id="sorting">
            <div class="dropdown pull-left">
                <strong><?=__("Mutasd") ?></strong> <a id="filter-list" class="dropdown-toggle" data-toggle="dropdown" href="#"><span>All Offices</span> <i class="icon-chevron-down"></i></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="#" onclick="filterElections(0);">All Offices</a></li>
                    <span id="filterOffices"></span>
                </ul>
            </div>

            <div class="dropdown pull-right">
                <strong><?=__("Rendezd:") ?></strong> <a id="sort-list" class="dropdown-toggle" data-toggle="dropdown" href="#"><span><?=__("Véletlenszerűen") ?></span> <i class="icon-chevron-down"></i></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                	<li id="5"><a href="#" onclick="sortElection(5);"><?=__("Véletlenszerűen") ?></a></li>
                    <li id="1"><a href="#" onclick="sortElection(1);"><?=__("Hozzáadás dátuma") ?></a></li>
                    <li id="2"><a href="#" onclick="sortElection(2);"><?=__("Betűrendben") ?></a></li>
                    <li id="3"><a href="#" onclick="sortElection(3);"><?=__("Legtöbb támogató") ?></a></li>
                    <li id="4"><a href="#" onclick="sortElection(4);"><?=__("Legtöbb kihívó") ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div id="candidates">

    </div>
    <div class="modal" style="display:none" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h6><?=__("Választás megosztása") ?> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></h6>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="span4">
                    <h6><?=__("Üzenet") ?>:</h6>
                    <p>
                        <textarea id="message" style="resize:none;width:300px" cols="30" rows="5"></textarea>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="aboutupd" data-dismiss="modal" aria-hidden="true" onclick="postElection()"><em class="icon-ok icon-white"></em>Share</button>
        </div>
    </div>