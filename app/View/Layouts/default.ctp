<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $this->fetch('title'); ?></title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>

        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('bootstrap.css');
            echo $this->Html->css('evmini.css');

            echo $this->Html->script('jquery-1.8.0.min.js');
            echo $this->Html->script('jquery-ui-1.8.23.custom.min.js');
            echo $this->Html->script('bootstrap.min.js');
        ?>
    </head>

    <body>
        <div class="container" style="width:760px">

        <!-- Header -->
        <div class="row">

            <div id="ev_logo" class="span4">
            <!-- Logo goes here. Is defined in CSS -->
            </div>

            <div class="span3" style="padding-top:60px">
                <div class="btn-group" style="margin:3em">
                    <button class="btn">Edit Election</button>
                    <button class="btn">Add Election</button>
                    <button class="btn">My Profile</button>
                    <button class="btn">Run for Office</button>
                </div>
            </div>

        </div>

            <div id="popups" style="z-index: 1000;"></div>

        <!-- Scope change row -->
        <div class="row">
            <div class="span10">
                <table>
                    <tr>
                        <th>Organization</th>
                        <th>Election</th>
                    </tr>
                    <tr>
                        <td>
                            <select>
                                <option>Northern Illinois University</option>
                                <option>Illinois State University</option>
                            </select>
                        </td>
                        <td>
                            <select style="width:100%">
                                <option>Student Association: September xxth</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        <?php echo $this->fetch('content'); ?>


        </div>
    </body>

</html>
