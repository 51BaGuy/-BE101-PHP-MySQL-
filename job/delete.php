<?php
    require_once('./conn.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM jobs WHERE id = " . $id ;
    $result = $conn -> query ($sql);
    if($result){
        header('Location: ./admin.php');
    }else{
        echo "failed: " . $conn->error;
    }
?>