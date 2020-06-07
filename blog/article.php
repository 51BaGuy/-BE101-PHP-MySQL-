<?php
    require_once("./conn.php");
    // 一樣我們用id去做溝通
    $id = $_GET['id']; 
    // 用left join的語法去讓兩者可以一次合併在一起讓我享用
    $sql = "SELECT A.title,A.content,C.name FROM articles as A LEFT JOIN categories as C ON A.category_id = C.id WHERE A.id = " . $id ;
    // echo $sql;(做個簡單測試)
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // 把我們要的東西取出來
    $title = $row['title'];
    $content = $row['content'];
    $name = $row['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="nav">
        <h1>Blog</h1>
        <a class="active" href="./index.php">首頁</a>
        <a  href="./about.php">關於我</a>
    </nav>
    <div class="container">
        <div class="single-particle">
            <h1><?php echo $title ?></h1>
            <h2><?php echo $name ?></h2>
            <p><?php echo $content ?></p>            
        </div>
    </div>

</body>
</html>