<!-- 這裡就是看到兩個table的好處，可以做table的連結，給下面做選項的時候可以用 -->
<?php
    require_once('./conn.php');
    $sql = "SELECT * FROM categories ORDER BY created_at DESC";
    $result = $conn->query($sql);
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
    <h1>新增文章</h1>
    <form method="POST" action="./handle_add.php ">
        <div>標題: <input name="title"/></div>
        <div>內容: <textarea name="content"></textarea></div>
        <div>
            <!-- 做個選單 -->
            <!-- 這裡的category_id是吃到我們下面option value裡面給的id可以對應到分類 -->
            分類: <select name="category_id">
                <?php
                    while($row=$result->fetch_assoc()){
                        $id = $row['id'];
                        $name = $row['name'];
                        echo "<option value='$id'>$name</option>";
                    }
                ?>
            </select>
        </div>
        <input type="submit" />
    </form>
</body>
</html>