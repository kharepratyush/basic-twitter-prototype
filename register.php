<?php
  require 'h2o/h2o.php';

  $h2o = new h2o('templates/signup.html');
  $data =array(
            'error' => ''
  );
  if(isset($_REQUEST['email']))
  {
    require 'config.php';
    require 'connect.php';
    $email=htmlspecialchars($_REQUEST['email']);
    $password=htmlspecialchars($_REQUEST['password']);
    $repassword=htmlspecialchars($_REQUEST['repassword']);
    if($password!=$repassword)
    {  
      $data['error']='PASSWORD UNMATCHED';
      echo $h2o->render(compact('data'));
      return;
    }
    $password=crypt($password);
    mysql_query("INSERT INTO users(email,password) VALUES('{$email}','{$password}')");
    if(mysql_error($conn))
    {
      $data['error']="Duplicate Entry";
      echo $h2o->render(compact('data'));
      return;
    }
    mysql_query("INSERT INTO connections(email1,email2) VALUES('{$email}','{$email}')");
    setcookie("email",$email,time() + (3600), "/");
    setcookie("crypt",crypt($email),time()+3600,'/');
    header("Location:/home.php");

    return;

  }
  //if(isset($_COOKIE['email']))
  //  header("Location:/");

  echo $h2o->render(compact('data'));

?>
