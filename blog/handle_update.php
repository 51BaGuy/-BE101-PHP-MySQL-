<!-- 這裡把我們想要更新的資訊傳上去資料庫 -->
<?php
    require_once("./conn.php");
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    if(empty($id)||empty($category_id)||empty($title)||empty($content)){
        die('empty data');
    }
    // 我們要的id在這裡發揮了作用
    $sql ="UPDATE articles SET title = '$title' , content = '$content' , category_id = '$category_id' WHERE id = " .$id;
    $result = $conn->query($sql);
    if($result){
        header('Location: ./admin.php');
    }else{
        die ("failed, " . $conn->error);
    }
?>

