<!-- 這裡把我們想要更新的資訊傳上去資料庫 -->
<?php
    require_once("./conn.php");
    $id = $_POST['id'];
    $name = $_POST['name'];
    if(empty($id)||empty($name)){
        die('empty data');
    }
    // 我們要的id在這裡發揮了作用
    $sql ="UPDATE categories SET name = '$name' WHERE id = '$id' ";
    $result = $conn->query($sql);
    if($result){
        header('Location: ./admin_category.php');
    }else{
        die ("failed, " . $conn->error);
    }
?>