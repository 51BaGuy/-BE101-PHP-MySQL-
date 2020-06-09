<?php
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }

  $user = getUserFromToken($_COOKIE['token']);
  $nickname=$user['nickname'];
  
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
