<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header('Location: ./update_comment.php?errCode=1&id=$_POST["id"]');
    die('資料不齊全');
  }
  ////// 使用函式，並且放入$_SESSION['username']把我username這個資料丟給SESSION //////
  $username = $_SESSION['username'];
  $id = $_POST['id'];
  $content = $_POST['content'];

  ////// 每個有sql的地方把她prepared statement //////
  // 這邊把原本的字串拼接變成用問號
  // 加上username讓我們只能讓當前使用者去改
  $sql ="update comments set content = ? where username = ?";
  // 再來對$sql做prepare
  $stmt = $conn->prepare($sql);
  // 這邊是把參數放進去，看你有幾個參數就有幾個s(s=String)
  $stmt->bind_param('ss',$content,$username);
  // 這邊就是去執行
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  // 會自動跳轉到index.php
  header("Location: index.php");
?>
