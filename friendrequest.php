<?php
$email=$_REQUEST['email'];
$dest=$_REQUEST['dest'];

require 'config.php';
require 'connect.php';




$ret=mysql_query("INSERT INTO incoming(email,destination) values('{$email}','{$dest}')") or die(mysql_error());

header("Location:/friend.php")


?>