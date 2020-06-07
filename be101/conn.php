<?php
  $server_name = 'localhost';
  $username = 'huli';
  $password = 'huli';
  $db_name = 'huli';

  $conn = new mysqli($server_name, $username, $password, $db_name);
  //有錯誤，就會有錯誤訊息丟出來給connect_error，這時候判斷表示true，他就會執行die
  if ($conn->connect_error) {
    die('資料庫連線錯誤:' . $conn->connect_error);
  }

  $conn->query("SET NAMES 'UTF8'"); // => 編碼
  $conn->query("SET time_zone = '+08:00'"); // => 台灣時區
?>