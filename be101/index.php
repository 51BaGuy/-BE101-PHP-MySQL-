<?php
     // 1.下query
    // 2.判斷有沒有得到結果，沒有顯示錯誤，有的話就把他拿出來
    require_once('conn.php');
    // 這個表示按照id順序
    $result = $conn->query("select * from users order by id asc");
    if (!$result){
        die($conn->error);
    }
    // 這裡表示我們如果有取到$result->fetch_assoc()，這個迴圈就會繼續下去
    while($row = $result->fetch_assoc()){
        echo "id:" . $row['id'] ; 
        // 這邊 $row['id']是字串，然後用.去連接前面跟後面看仔細點
        echo "<a href='delete.php?id=". $row['id'] ." '>刪除</a>" ;
        echo  '<br>';
        echo "username:" . $row['username'] . '<br>';
    }
    
?>

<h2>新增 user</h2>
<form method="POST" action="add.php">
    username:<input name="username" />
    <input type="submit" />
</form>

<h2>編輯 user</h2>
<form method="POST" action="update.php">
    id:<input name="id" />
    username:<input name="username" />
    <input type="submit" />
</form>