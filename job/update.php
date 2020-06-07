<?php
    require_once('./conn.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM jobs WHERE id = " . $id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job board 職缺報報</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Job board 職缺報報管理後台-編輯職缺</h1>
        <a class="job_link" href="./admin.php">回到管理頁</a>
        <form method="POST" action="./handle_update.php">
            <div>職缺名稱:<input name="title" value="<?php echo $row['title']?>"/></div>
            <div>職缺描述:<textarea name="description" rows="10"><?php echo $row['description']?></textarea></div>
            <div>職缺待遇:<input name="salary" value="<?php echo $row['salary']?>"/></div>
            <div>職缺連結:<input name="link" value="<?php echo $row['link']?>"/></div>
            <!-- 這邊為了能夠指定到我們要的選項 -->
            <div><input type="hidden" name="id" value="<?php echo $row['id']?>"/></div>
            <input type="submit" value="送出"/>
        </form>

    </div>

</body>

</html>