<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
require_once "pdo.php";
//Init
$creator=$_SESSION["user_id"];
$req = false; // изначально переменная для "ответа" - false
  // Приведём полученную информацию в удобочитаемый вид
  ob_start();
//Post
     if (!empty($_COOKIE['sid'])) {
    $name2 = $_POST['name'];
    $name2 = htmlspecialchars($name2);//превращаем весь html код в
    $name2 = trim($name2);//удаляем пробелы
    $name2 = stripslashes($name2);//удаляем обратный слэш
    $date2 = $_POST['date'];
    $date2 = htmlspecialchars($date2);
    $date2 = trim($date2);
    $date2 = stripslashes($date2);
    $description = $_POST['description'];
    $address = $_POST['address'];
//Name check
$query = $fpdo->from('events')->where('name', $name2);
foreach ($query as $key=>$row) :
$name=$row['name'];
$date=$row['date'];
endforeach;
    if(!$_POST['name'] == "" && $name=="") {
        if ($date=="") {
        $values = array('name'=>$name2,'date'=>$date2, 'description'=>$description, 'creator'=>$creator, 'address'=>$address, 'fl'=>0,'finished'=>0);
        $fpdo->insertInto('events')->values($values)->execute();
        echo "Мероприятие успешно добавлено";
      } else {echo "Мероприятие с датой ".$date2." и именем ".$name2." уже уществует";}
    }
    else {echo "Название пустое или уже добавлено";}
}
else {echo "Ошибка сессии. Перезайдите в аккаунт";}
//
$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
