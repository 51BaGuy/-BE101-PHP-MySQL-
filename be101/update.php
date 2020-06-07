<?php
  require_once('conn.php');

  if (empty($_POST['id'])||empty($_POST['username'])) {
    die('請輸入 id與username');
  }

  $id = $_POST['id'];
  $username = $_POST['username'];

  $sql = sprintf(
    // 這邊username是字串，要用單引號包住;這邊id是數字，不用單引號包住
    "update users set username = '%s' where id=%d",
    $username,
    $id
  );
  echo $sql . '<br>';
  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");
?>