<!DOCTYPE html>
<html lang="en">

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $this->fetch('title'); ?></title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
        
        <?php
            echo $this->Html->meta('icon');
            
            echo $this->Html->css('bootstrap.css');
            echo $this->Html->css('evmini');
            
            echo $this->Html->script('bootstrap.min.js');
        ?>
    </head>

    <body>
        <div class="container" style="width:760px">
            
        <!-- Header -->
        <div class="row">
            
            <div class="span4">
            <img src="img/ev-logo.png" />
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
        <?php //echo $this->element('sql_dump'); ?>
    </body>

</html>
