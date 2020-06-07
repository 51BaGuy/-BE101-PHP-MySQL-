<!-- 做個簡單的接收從管理頁面傳給我的id，然後把對應的資料刪掉 -->
<?php
    require_once('./conn.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM articles WHERE id = " . $id;
    $result = $conn->query($sql);
    if($result){
        header('Location: ./admin.php');
    }else{
        die("failed." . $conn->error);
    }
?>