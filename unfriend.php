<?php
$email=$_REQUEST['email'];
$dest=$_REQUEST['dest'];

require 'config.php';
require 'connect.php';


$ret=mysql_query("DELETE FROM connections where email1='{$dest}' and email2='{$email}'") or die(mysql_error());

$ret=mysql_query("DELETE FROM connections where email2='{$dest}' and email1='{$email}'") or die(mysql_error());

header("Location:/friend.php")


?>