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
	$username = $_SESSION['username'];

  ////// 每個有sql的地方把她prepared statement //////
	// 這邊把原本的字串拼接變成用問號
	//加上username讓我們只能給當前使用者去刪除!!
  $sql ="update comments set is_deleted=1 where id = ? and username = ?";
  // 再來對$sql做prepare
  $stmt = $conn->prepare($sql);
  // 這邊是把參數放進去，看你有幾個參數就有幾個s(s=String)
  $stmt->bind_param('is',$id,$username);
  // 這邊就是去執行
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  // 會自動跳轉到index.php
  header("Location: index.php");
?>