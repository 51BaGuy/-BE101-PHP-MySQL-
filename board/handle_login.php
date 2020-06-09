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
  
//   我們要如何判斷使用者有沒有登入成功，就是看資料庫有沒有辦法取得這筆資料
  $sql = sprintf(
    "SELECT * FROM users WHERE username ='%s' and password ='%s'",
    $username,
    $password
  );
  $result = $conn->query($sql);
  //   這裡結果會吃不到，表示你的sql語法寫錯，不是代表找不到你的結果
  if (!$result) {
    die($conn->error);
	}
	
	////// 把token亂數跟名稱username存入tokens table裡面，並且把token亂數取出放到cookie裡面做為我們的通行證//////
  // time()表示為現在時間
  $expire = time()+3600 * 24 * 30; // 30 day; 
  if($result->num_rows){
		/*
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */
		// 我們把上面的$_POST['username']存入
		$_SESSION['username'] = $username;
		header('Location: ./index.php');
  } else{
    header('Location: ./login.php?errCode=2');
  }

?>
