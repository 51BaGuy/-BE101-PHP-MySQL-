<?php
  require_once('conn.php');

  if (empty($_POST['username'])||empty($_POST['nickname'])||empty($_POST['password'])) {
    header('Location: ./register.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $password = $_POST['password'];
  //sprintf可以動態塞入我們的變數
  $sql = sprintf(
    "insert into users(username,nickname,password) values('%s','%s','%s')",
    $username,
    $nickname,
    $password
  );
  $result = $conn->query($sql);
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
  // 會自動跳轉到index.php
  header("Location: index.php");
?>
