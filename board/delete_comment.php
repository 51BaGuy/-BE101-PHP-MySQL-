<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
	// 沒有取到id直接跳回首頁
  if (empty($_GET['id'])) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }

  $id=$_GET['id'];

  ////// 每個有sql的地方把她prepared statement //////
  // 這邊把原本的字串拼接變成用問號
  $sql ="update comments set is_deleted=1 where id = ?";
  // 再來對$sql做prepare
  $stmt = $conn->prepare($sql);
  // 這邊是把參數放進去，看你有幾個參數就有幾個s(s=String)
  $stmt->bind_param('i',$id);
  // 這邊就是去執行
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  // 會自動跳轉到index.php
  header("Location: index.php");
?>