<?php
  session_start();
  require_once('conn.php');

  if (empty($_POST['username'])||empty($_POST['nickname'])||empty($_POST['password'])) {
    header('Location: ./register.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  ///////// 加入password_hash把密碼雜湊 ////////
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  //sprintf可以動態塞入我們的變數
  $sql ="insert into users(username,nickname,password) values(?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss',$username,$nickname,$password);
  $result = $stmt->execute();
    
  // 如果沒有成功執行sql，這樣會報錯
  if (!$result) {
	// 	// 這邊是直接去看find word錯誤指令怎麼打(但是這個作法比較不精準)
	// 	if (strpos($conn->error,'Duplicate entry') !== false) {
	// 		header('Location: ./register.php?errCode=2');
	// }
		$code = $conn->errno;
		if($code===1062){
			header('Location: ./register.php?errCode=2');
		}
    die($conn->error);
  }
  //////// 然後我們可以直接加入$SESSION[‘username’]達成註冊後立刻登入的情況 ///////
  $_SESSION['username'] = $username;
  header("Location: index.php");
?>
