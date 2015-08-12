<?php

	$dbhost = 'localhost:3036';
    $dbuser = 'pratyush';
    $dbpass = 'foo';
    $db='tango';

	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	    die('Could not connect: ' . mysql_error());
	}
	    //echo 'Connected successfully to mysql server<br />';
	mysql_select_db( $db );



$user=$_COOKIE['email'];
$hash=$_COOKIE['crypt'];

if (crypt($user, $hash) == $hash) {
}

else{
	header("Location:logout.php");
}
$data=htmlspecialchars($_REQUEST['update']);

mysql_query("INSERT INTO posts(email,post) VALUES('{$user}','{$data}')")or die(mysql_error());
header("Location:/home.php");


?>