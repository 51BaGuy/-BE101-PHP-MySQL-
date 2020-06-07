<?php
    require_once("./conn.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog 部落格</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>分類管理</h1>
    <a href="./add_category.php">新增分類</a>
    <a href="./admin.php">管理文章</a>
    <ul>
        <?php
            $sql = "SELECT * FROM categories ORDER BY created_at DESC";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<li>";
                    echo $row['name'];
                    // 當我們發現裡面已經被雙引號和單引號包住時，我們可以用變數去帶入
                    $id =$row['id'];
                    echo "<a href='./update_category.php?id=$id'>編輯</a>";
                    echo "<a href='./delete_category.php?id=$id'>刪除</a>";
                    echo "</li>";
                }
            }
        ?>
    </ul>   
</body>
</html>