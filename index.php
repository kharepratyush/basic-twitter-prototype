<?php
require 'h2o/h2o.php';

$h2o = new h2o('templates/index.html');

$data =array(
        'error' => ''
);
if(isset($_REQUEST['email']))
{
require 'config.php';
require 'connect.php';
$email=htmlspecialchars($_REQUEST['email']);
$password=htmlspecialchars($_REQUEST['password']);

$ret=mysql_query("SELECT password from users where email='{$email}'");

if(mysql_error($conn))
{
  $data['error']=mysql_error($conn);
  echo $h2o->render(compact('data'));
  return;
}
$crypt=crypt($email);
while($row = mysql_fetch_assoc($ret))
{
    if(crypt($password,$row['password'])==$row['password'])
    {

    }
    else
    {
    	$data['error']="Password Error";
		echo $h2o->render(compact('data'));
		return;
    }
    setcookie("email",$email,time() + (3600), "/");
    setcookie("crypt",$crypt,time() + (3600), "/");
    header("Location:/home.php"); 
    return;  
}
$data['error']="Not Found : Please Register";
echo $h2o->render(compact('data'));
return;
}
//if(isset($_COOKIE['email']))
//  header("Location:/");

echo $h2o->render(compact('data'));

?>