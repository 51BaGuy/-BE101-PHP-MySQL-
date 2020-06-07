<?php
    require_once("./conn.php")
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
        <div class="articles">
            <!-- 這裡我們也是把之前的模板拿出來做 -->
            <?php
                $sql = "SELECT * FROM articles ORDER BY created_at DESC";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='article'>";
                        $id =$row['id'];
                        $title = $row['title'];
                        echo "<h1><a href='./article.php?id=$id'>$title</a></h1>";
                        echo "</div>";
                    }
                }
            ?>

            
                <h1><a href='./article.php'>標題</a></h1>
             
        
        </div>   
    </div>

</body>
</html>