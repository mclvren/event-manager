<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}

session_start();
require_once "pdo.php";
//Init
$query = $fpdo->from('users')->where('id', $_SESSION["user_id"]);
foreach ($query as $key=>$row) :
$username=$row['username'];
$email=$row['email'];
$name=$row['name'];
$surname=$row['surname'];
$salt=$row['salt'];
$password=$row['password'];
endforeach;
//Post

      $values = array('iscreator'=>'1');
      $fpdo->update('users')->set($values)->where("id",$_SESSION["user_id"])->execute();
      echo "Теперь вы можете добавлять мероприятия!";
