<?php

session_start();

if (!empty($_SESSION['user']))
{
  header('Location:main.php');
  exit;
}

//gwk & emmasRas & fhoeyh
  if (isset($_GET['username']) && isset($_GET['password'])){

        $username = $_GET['username'];
        $password = $_GET['password'];
  }else {

      header('Location:login.html');
      exit;
  }



$users = [];

if (file_exists("users.txt"))
{
  $string = file_get_contents("users.txt");
  $users  = json_decode($string, true);

}



$loggedIn =  false;


foreach ($users as $x){
    if ($x["username"] == $username && $x["password"] == $password){
        $loggedIn = true;

        $_SESSION['user'] = $_GET['username'];
        header('Location:main.php');
        exit;

    }
}
if ($loggedIn){
    echo "Welcome ", $username;
    header('Location:main.php');
    exit;

} else {
    header('Location:login.html');
    exit;
}



session_write_close();
?>
