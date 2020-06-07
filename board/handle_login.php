<?php
  require_once('conn.php');

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
  // time()表示為現在時間
  $expire = time()+3600 * 24 * 30; // 30 day; 
  if($result->fetch_assoc()){
		setcookie("username", $username,$expire);
		header('Location: ./index.php');
  } else{
    header('Location: ./login.php?errCode=2');
  }

?>
