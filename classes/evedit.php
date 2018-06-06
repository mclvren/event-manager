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
$query = $fpdo->from('events')->where('id', $id);
foreach ($query as $key=>$row) :
$name=$row['name'];
$creator=$row['creator'];
$date=$row['date'];
endforeach;
if ($_SESSION["user_id"]!=$creator) {die(); exit();}
    if(!$_POST['name'] == "") {
        $values = array('name'=>$name2);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Название изменено</p>";
    }
    if(!$date2 == "") {
        $values = array('date'=>$date2);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Дата изменена</p>";
    }
    if(!$description == "") {
        $values = array('description'=>$description);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Описание изменено</p>";
    }
    if(!$address == "") {
        $values = array('address'=>$address);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Адрес изменен</p>";
    }
    if(isset($_POST['finished']) && $_POST['finished'] == 'finished')
    {
        $values = array('finished'=>1);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Мероприятие завершено!</p>";
    }
    else
    {
        $values = array('finished'=>0);
        $fpdo->update('events')->set($values)->where("id",$id)->execute();
        echo "<p>Мероприятие не завершено.</p>";
    }

//    else {echo "Название пустое";}
    //File
    define ("MAX_SIZE","128000"); // максимальный размер 2MB
    function getExtension($str)
    {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
    }
    // валидация форматов изобржений
    $valid_formats = array("zip", "rar", "7z", "tar","gz");
    //
    if(!empty($_FILES['evfile1']['name'])){
    $filename=$_FILES['evfile1']['name'];
    //echo $filename;
    $uploaddir = '../uploads/events/'.$id.'/';
    $size=filesize($_FILES['evfile']['tmp_name']);
    // конвертация расширения изображений к нижнему регистру
    $ext = getExtension($filename);
    $ext = strtolower($ext);
    // проверка расширения
    if(in_array($ext,$valid_formats))
    {
    // проверка размера файла
    if ($size < (MAX_SIZE*1024)) {
      if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777, true );
      $filename = "archive.".$ext;
      $file = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['evfile1']['tmp_name'], "$file")) {echo "<p>Архив с файлами успешно загружен.</p><p>(если список не обновился, нажмите ctrl-f5)</p>";
    $values = array('fl'=>1,'fl_type'=>$ext);
    $fpdo->update('events')->set($values)->where("id",$id)->execute();

    }
     else {echo "<p>Произошла ошибка :(</p>";}
   } else {echo "<p>Размер файла превышает 128МБ</p>";}
    } else {echo "<p>Недопустимое расширение файла!</p>";}
  }
    //
}
else {echo "<p>Ошибка сессии. Перезайдите в аккаунт</p>";}
//
$req = ob_get_contents();
if ($req==false) {echo "Ни одно поле не заполнено!";}
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
