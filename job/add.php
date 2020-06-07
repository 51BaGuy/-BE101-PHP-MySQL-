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
        <h1>Job board 職缺報報管理後台-新增職缺</h1>
        <a class="job_link" href="./admin.php">回到管理頁</a>
        <form method="POST" action="./handle_add.php">
            <div>職缺名稱:<input name="title"/></div>
            <div>職缺描述:<textarea name="description" rows="10"></textarea></div>
            <div>職缺待遇:<input name="salary"/></div>
            <div>職缺連結:<input name="link"/></div>
            <input type="submit" value="送出"/>
        </form>

    </div>

</body>

</html> 