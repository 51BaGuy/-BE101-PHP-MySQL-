<?php
  require_once('conn.php');

  if (empty($_POST['content'])) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_COOKIE['username'];
  $user_sql = sprintf(" SELECT nickname FROM users WHERE username = '%s'"
  ,$username);
  $user_result=$conn->query($user_sql);
  $row = $user_result->fetch_assoc();
  $nickname=$row['nickname'];
  
  $content = $_POST['content'];
  //sprintf可以動態塞入我們的變數
  $sql = sprintf(
    "insert into comments(nickname,content) values('%s','%s')",
    $nickname,
    $content
  );
  $result = $conn->query($sql);
  // 如果沒有成功執行sql，這樣會報錯
  if (!$result) {
    die($conn->error);
  }
  // 會自動跳轉到index.php
  header("Location: index.php");
?>
