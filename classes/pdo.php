<?php
require_once "connect/db.php";
require_once "FluentPDO/FluentPDO.php";
$host = $dhost_1;
  $database = $db_name_1;
  $user = $db_user_1;
  $pass = $db_pass_1;

  $dsn = "mysql:host=$host;dbname=$database;";
  $options = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $pdo = new PDO($dsn, $user, $pass, $options);
  $pdo->exec("set names utf8");
  $fpdo = new FluentPDO($pdo);
