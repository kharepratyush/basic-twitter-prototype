<?php

require 'h2o/h2o.php';

$h2o = new h2o('templates/friends.html');

$user=$_COOKIE['email'];
$hash=$_COOKIE['crypt'];

if (crypt($user, $hash) == $hash) {
}

else{
	header("Location:logout.php");
}

$data =array(
        'error' => '',
        'email' =>  $user
);

#$data['email']=$user
require 'config.php';
require 'connect.php';

$ret=mysql_query("SELECT email from incoming where destination='{$user}'");

if(mysql_error($conn))
{
  $data['error']=mysql_error($conn);
  echo $h2o->render(compact('data'));
  return;
}

while($row = mysql_fetch_assoc($ret)){
     $json[] = $row;
}


$ret=mysql_query("SELECT DISTINCT email2 as email from connections where email1='{$user}' and email2<>'{$user}'");
while($row = mysql_fetch_assoc($ret)){
     $json1[] = $row;
}

$ret=mysql_query("SELECT email FROM users WHERE email NOT IN ( SELECT email2 FROM connections WHERE email1='{$user}') and email<>'{$user}'")or die(mysql_error());

while($row = mysql_fetch_assoc($ret)){
     $json2[] = $row;
}
echo $h2o->render(compact('data','json','json1','json2'));

?>