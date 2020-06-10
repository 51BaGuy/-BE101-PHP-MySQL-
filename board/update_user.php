<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['nickname'])) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }
  
  $username =$_SESSION['username'];
  $nickname =$_POST['nickname'];

  ////// 每個有sql的地方把她prepared statement //////
  // 這邊把原本的字串拼接變成用問號
  $sql ="update users set nickname = ? where username = ?";
  // 再來對$sql做prepare
  $stmt = $conn->prepare($sql);
  // 這邊是把參數放進去，看你有幾個參數就有幾個s(s=String)
  $stmt->bind_param('ss',$nickname,$username);
  // 這邊就是去執行
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  // 會自動跳轉到index.php
  header("Location: index.php");
?>
