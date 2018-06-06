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
    $id = $_POST['mevid'];
    $uid=$_SESSION['user_id'];
//Name check
$query = $fpdo->from('members')->where(array('usrid'=>$uid,'evid'=>$id));
foreach ($query as $key=>$row) :
$mid=$row['id'];
$evid=$row['evid'];
endforeach;
if ($id==$evid) {
  $fpdo->deleteFrom('members')->where('id', $mid)->execute();
  echo "<p>Вы удалены из участников!</p>";
}
else {
  echo "<p>Вы не участвовали!</p>";
}
    //
}
else {echo "<p>Ошибка сессии. Перезайдите в аккаунт</p>";}
//
$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
