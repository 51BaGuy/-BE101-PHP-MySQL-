<!-- 這裡我們吃我們接收到的表單訊息然後把他轉進資料庫裡儲存 -->
<?php
    require_once("./conn.php");

    $name = $_POST['name'];
    if(empty($name)){
        die('empty data');
    }
    $sql ="INSERT INTO categories (name) VALUES ('$name') ";
    $result = $conn->query($sql);
    if($result){
        header('Location: ./admin_category.php');
    }else{
        die ("failed, " . $conn->error);
    }
?>