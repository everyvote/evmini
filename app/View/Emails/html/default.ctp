<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<p><b><?=__("Name:") ?> </b><?php echo $name;?></p>
<p><b><?=__("University:") ?> </b><?php echo $university;?></p>
<p><b><?=__("Email:") ?> </b><?php echo $email;?></p>
<p><b><?=__("Üzenet") ?>" </b><?php echo $msg;?></p>
<?php
 echo $content;
?>