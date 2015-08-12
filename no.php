<?php
$email=$_REQUEST['email'];
$dest=$_REQUEST['dest'];

require 'config.php';
require 'connect.php';


$ret=mysql_query("DELETE from incoming where destination='{$dest}' and email='{$email}'") or die(mysql_error());

header("Location:/friend.php")


?>