<?php
    require_once("./conn.php");
    $sql = "SELECT * FROM comments ORDER BY created_at desc"; 
    $result = $conn->query($sql);
    if(!$result){
      die('Error:'. $conn->error);
    }
    $username = Null;
    if(!empty($_COOKIE['username'])){
      $username = $_COOKIE['username'];
    }

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
      <div>
        <!-- 這邊我們可以去做判斷看有沒有吃到cookie，顯示相對應頁面 -->
        <!-- 記住中括號這裡要空格，不然會出錯 -->
        <?php if(!$username){?>
            <a class="board__btn" href="register.php">註冊</a>
            <a class="board__btn" href="login.php">登入</a>
        <?php } else { ?>
            <a class="board__btn" href="logout.php">登出</a>
        <?php } ?> 
      </div>
      <h1 class="board__title">Comments</h1>
      <!-- 不是空的會跑出結果 -->
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
      
      <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
        <textarea name="content" rows="5"></textarea>
        <?php if($username){ ?>
          <input class="board__submit-btn" type="submit" />
        <?php } else { ?>
          <h3>請登入發布留言</h3>  
        <?php } ?>
      </form>
      <div class="board__hr"></div>
      <section>
        <!-- 這邊就是使用迴圈的方法，記得最後面php那邊要空格 -->
        <?php while($row=$result->fetch_assoc()){?>
        <div class="card">
          <div class="card__avatar">
          </div>
          <div class="card__body">
              <div class="card__info">
                <span class="card__author"><?php echo $row['nickname']?></span>
                <span class="card__time"><?php echo $row['created_at']?></span>
              </div>
              <p class="card__content">
              <?php echo $row['content']?>
              </p>
          </div>
        </div>
        <?php } ?>
      </section>
  </main>
</body>
</html> 