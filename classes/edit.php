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
$req = false; // изначально переменная для "ответа" - false
  // Приведём полученную информацию в удобочитаемый вид
  ob_start();
//Post
     if (!empty($_COOKIE['sid'])) {
    $username2 = $_POST['username'];
    $username2 = htmlspecialchars($username2);//превращаем весь html код в
    $username2 = trim($username2);//удаляем пробелы
    $username2 = stripslashes($username2);//удаляем обратный слэш
    $password1 = $_POST['password1'];
    $password1 = htmlspecialchars($password1);
    $password1 = trim($password1);
    $password1 = stripslashes($password1);
    $password2 = $_POST['password2'];
    $password2 = htmlspecialchars($password2);
    $password2 = trim($password2);
    $password2 = stripslashes($password2);
    $email2 = $_POST['email'];
    $email2 = htmlspecialchars($email2);
    $email2 = trim($email2);
    $email2 = stripslashes($email2);
//Password
    if(!$_POST['password1'] == "" && !$_POST['password2'] == "") {
    function passwordHash($password1, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password1 . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }
    $hashes = passwordHash($password1, $salt);
    if ($password==$hashes['hash']) {
      if ($password1!=$password2) {
        $hashes = passwordHash($password2, $salt);
        $password2 = $hashes['hash'];
        $values = array('password'=>$password2);
        $fpdo->update('users')->set($values)->where("id",$_SESSION["user_id"])->execute();
        echo "<p>Пароль изменен</p>";
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
      }
    }
  }
//Username
      if(!$_POST['username'] == "") {
      if ($username2!=$username) {
        $values = array('username'=>$username2);
        $fpdo->update('users')->set($values)->where("id",$_SESSION["user_id"])->execute();
        echo "<p>Имя пользователя изменено</p>";
      }
    }
//Email
    if(!$_POST['email'] == "") {
    if ($email2!=$email) {
      $values = array('email'=>$email2);
      $fpdo->update('users')->set($values)->where("id",$_SESSION["user_id"])->execute();
      echo "<p>Email изменен</p>";
    }
  }
//File
define ("MAX_SIZE","2000"); // максимальный размер 2MB
function getExtension($str)
{
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
// валидация форматов изобржений
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
//
if(!empty($_FILES['img']['name'])){
$filename=$_FILES['img']['name'];
//echo $filename;
$uploaddir = '../uploads/users/'.$_SESSION["user_id"].'/';
$size=filesize($_FILES['img']['tmp_name']);
// конвертация расширения изображений к нижнему регистру
$ext = getExtension($filename);
$ext = strtolower($ext);
// проверка расширения
if(in_array($ext,$valid_formats))
{
// проверка размера файла
if ($size < (MAX_SIZE*1024)) {
  if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777, true );
  $filename = "profile.".$ext;
  $file = $uploaddir . basename($filename);
if (move_uploaded_file($_FILES['img']['tmp_name'], "$file")) {echo "<p>Изображение профиля успешно загружено.</p><p>(если изображение не обновилось, нажмите ctrl-f5)</p>";
$values = array('img'=>1,'img_type'=>$ext);
$fpdo->update('users')->set($values)->where("id",$_SESSION["user_id"])->execute();

}
 else {echo "<p>Произошла ошибка :(</p>";}
} else {echo "<p>Размер файла превышает 2МБ</p>";}
} else {echo "<p>Недопустимое расширение файла!</p>";}
}
//
$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
}
