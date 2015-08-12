<?php
$email=$_REQUEST['email'];
$dest=$_REQUEST['dest'];

require 'config.php';
require 'connect.php';


$ret=mysql_query("DELETE from incoming where destination='{$dest}' and email='{$email}'") or die(mysql_error());

$ret=mysql_query("INSERT INTO connections(email1,email2) values('{$dest}','{$email}')") or die(mysql_error());

$ret=mysql_query("INSERT INTO connections(email1,email2) values('{$email}','{$dest}')") or die(mysql_error());

header("Location:/friend.php")


?>