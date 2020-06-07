<?php
    require_once('./conn.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = " . $id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    <h1>編輯分類</h1>
    <form method="POST" action="./handle_update_category.php ">
        名稱: <input name="name" value="<?php echo $row['name']?>"/>
        <!-- 我們要這個id是為了能選到我們要的那一列 -->
            <input name="id" type="hidden" value="<?php echo $row['id']?>"/>
        <input type="submit" />
    </form>
</body>
</html>