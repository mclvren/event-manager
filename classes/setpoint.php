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
    $id = $_POST['id'];
    $eid = $_POST['eventid'];
    $point = $_POST['p'];
//Name check
$query = $fpdo->from('events')->where('id', $eid);
foreach ($query as $key=>$row) :
$creator=$row['creator'];
endforeach;
if ($_SESSION["user_id"]!=$creator) {die(); exit();}
    if(!$point == "") {
        $values = array('point'=>$point);
        $fpdo->update('members')->set($values)->where(array('id'=>$id,'evid'=>$eid))->execute();
        echo "<p>Место установлено (для просмотра изменения заного выберите мероприятие)</p>";
    } else {echo "<p>Место не заполнено</p>";}
    //
}
else {echo "<p>Ошибка сессии. Перезайдите в аккаунт</p>";}
//
$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
