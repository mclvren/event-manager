<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
require_once "pdo.php";
//Init
//$creator=$_SESSION["user_id"];
$req = false; // изначально переменная для "ответа" - false
  // Приведём полученную информацию в удобочитаемый вид
  ob_start();
//Post
     if (!empty($_COOKIE['sid'])) {
    $id = $_POST['evid'];
//Name check
$query = $fpdo->from('events')->where('id', $id);
foreach ($query as $key=>$row) :
$creator=$row['creator'];
endforeach;
if ($_SESSION["user_id"]!=$creator) {die(); exit();}
    if(!$_POST['evid'] == "") {
      $fpdo->deleteFrom('events')->where('id', $id)->execute();
      echo "<p>Мероприятие удалено!</p>";
    }
  }
else {echo "<p>Ошибка сессии. Перезайдите в аккаунт</p>";}
//
$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
?>
