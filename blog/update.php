<!-- 這裡就是看到兩個table的好處，可以做table的連結，給下面做選項的時候可以用 -->
<?php
    require_once('./conn.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM articles WHERE id = " . $id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // 他會由新到舊去顯示所有內容
    $sql_category = "SELECT * FROM categories ORDER BY created_at DESC";
    $result_category = $conn->query($sql_category);
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
    <h1>編輯文章</h1>
    <form method="POST" action="handle_update.php ">
        <div>標題: <input name="title" value="<?php echo $row['title']?>"/></div>
        <!-- textarea沒有value -->
        <div>內容: <textarea name="content"><?php echo $row['content']?></textarea></div>
        <div>
            分類: <select name="category_id">
                <?php
                    while($row_category=$result_category->fetch_assoc()){
                        $id = $row_category['id'];
                        $name = $row_category['name'];
                        // 這邊做迴圈判斷，把有match selected出來
                        $is_checkd = $row['category_id']=== $id ? "selected" : ""; 
                        echo "<option value='$id' $is_checkd>$name</option>";
                    }
                ?>
            </select>
        </div>
        <!-- 我們要這個id是為了能選到我們要的那一列 -->
        <input type="hidden" name='id' value = "<?php echo $row['id']?>">
        <input type="submit" />
    </form>
</body>
</html>