<?php
require 'h2o/h2o.php';

$h2o = new h2o('templates/home.html');



$user=$_COOKIE['email'];
$data =array(
        'error' => '',
        'email' =>  $user
);


$hash=$_COOKIE['crypt'];

if (crypt($user, $hash) == $hash) {
}

else{
	header("Location:logout.php");
}


#$data['email']=$user
require 'config.php';
require 'connect.php';

$ret=mysql_query("SELECT DISTINCT p.email as email,p.post as post from posts p,connections c where c.email1='{$user}' and p.email=c.email2 order by p.time DESC limit 0,20");

if(mysql_error($conn))
{
  $data['error']=mysql_error($conn);
  echo $h2o->render(compact('data'));
  return;
}

while($row = mysql_fetch_assoc($ret)){
     $json[] = $row;
}


//if(isset($_COOKIE['email']))
//  header("Location:/");

echo $h2o->render(compact('data','json'));

?>
