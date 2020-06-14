<?php
    session_start();
    require_once('conn.php');
    require_once('utils.php');
    /////// 從cookie讀取PHPSESSID，並且讀取session id裡面username的內容，然後放到_SESSION裡面去給$username讀取///////
     /*
    1. 從 cookie 裡面讀取 PHPSESSID(token)
    2. 從檔案裡面讀取 session id 的內容
    3. 放到 $_SESSION
    */
    ///// 去修改index.php讓我們可以取得users table裡面的資料//////
    $username = Null;
    $user = Null ;
    if(!empty($_SESSION['username'])){
      $username = $_SESSION['username'];
      $user = getUserFromUsername($username);
    }
		// 這邊要取出我們丟的id去找相對應的評論
		//加上username讓我們只能顯示當前使用者的留言
    $id = $_GET['id'];
    $stmt = $conn->prepare(
      'select * from comments where id = ? and username = ?'
    );
    $stmt->bind_param('is',$id,$username);
    $result=$stmt->execute();
    if(!$result){
      die('Error:'. $conn->error);
    }
		$result = $stmt->get_result();
		// 把我要的結果拿出來
		$row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
  </header>
  <main class="board">
			<h1 class="board__title">編輯留言</h1>
      <?php
        if(!empty($_GET['errCode'])){
          $code = $_GET['errCode'];
          $msg = 'error';
          // 我們這裡要用字串，他是取字串
          if($code==='1'){
            $msg = '資料不齊全';
          } 
          echo "<h2 class='error'>錯誤:" . $msg ."</h2>";
        }
      ?>
      <form class="board__new-comment-form" action="handle_update_comment.php" method="POST">
				<textarea name="content" rows="5"><?php echo $row['content']?></textarea>
				<input type="hidden" name="id" value = "<?php echo $row['id']?>"/>
				<input class="board__submit-btn" type="submit" />
			</form>
      
  </main>
  
</body>
</html> 