<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

  if (empty($_POST['username'])||empty($_POST['password'])) {
    header('Location: ./login.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];
	
	///// 判斷機制變成只判斷username，因為password hash後無法直接這樣判斷了//////
  $sql = sprintf(
    "SELECT * FROM users WHERE username ='%s'",
    $username
  );
  $result = $conn->query($sql);
  //   這裡結果會吃不到，表示你的sql語法寫錯，不是代表找不到你的結果
  if (!$result) {
    die($conn->error);
	}

	/////先檢查有沒有查到user，沒有查到結束，如果有查到就把使用者拉出來，然後加入password_verify把我們輸入的的密碼跟資料庫hash過的密碼去比對看是不是一樣的//////
	if($result->num_rows===0){
		header('Location: ./login.php?errCode=2');
		exit();
	}
	
	$row = $result->fetch_assoc();
	if (password_verify($password , $row['password'])){
		 /*
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */
		$_SESSION['username'] = $username;
    header("Location: index.php");
	}

?>
