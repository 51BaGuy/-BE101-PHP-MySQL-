<?php
    // 系統本身就會內設這些使用者參數，資料庫則是我自創
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'mentor';
    // 我們可以利用她回傳回來的$conn去連線進去資料庫
    $conn = new mysqli($servername,$username,$password,$dbname);
    // 這裡的箭頭就像是我們物件在取裡面的屬性的點，只是這邊點被用掉了
    if($conn->connect_error){
        die("connection field: " . $conn->connect_error);
    }
    $conn->query("SET NAMES 'UTF8'"); // => 編碼
    $conn->query("SET time_zone = '+08:00'"); // => 台灣時區
?>