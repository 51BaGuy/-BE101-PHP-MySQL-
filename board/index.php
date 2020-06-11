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
    // 記得把index.php把comments的$result移下去，不然下面會吃不到我們的$result
    // 這邊用字串拼接的方式去串起來，記得要空格!!!!!
    $stmt = $conn->prepare(
      'select ' .
        'C.id as id , C.content as content , C.created_at as created_at, '.
        'U.nickname as nickname , U.username as username '.
      'from comments as C '.
      'left join users as U on C.username = U.username '.
      'order by C.id desc'
    );
    $result=$stmt->execute();
    if(!$result){
      die('Error:'. $conn->error);
    }
    $result = $stmt->get_result();

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
            <!-- 在來設計一個update_user.php，去做編輯暱稱的功能 -->
            <span class="board__btn update-nickname">編輯暱稱</span>
            <!-- 在index.php直接放一個表單，去做一個新的暱稱，可以用之前的class -->
            <form class="hide board__nickname-form board__new-comment-form" method="POST" action="update_user.php">
              <div class="board__nickname">
                <span>新的暱稱：</span>
                <input type="text" name="nickname" />
              </div>
              <input class="board__submit-btn" type="submit" />
            </form>
            <!-- 再去裡面把nickname撈出來，可以放一個確認的訊息，讓暱稱跑出來 -->
            <h3>你好！<?php echo $user['nickname'] ?></h3>
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
                <span class="card__author">
                  <?php echo escape($row['nickname'])?>
                  <!-- 做一個帳號顯示來做個區別 -->
                  (@<?php echo escape($row['username'])?>)
                </span>
                <span class="card__time">
                  <?php echo escape($row['created_at'])?>
                </span>
                <!-- 我們那一留言欄的username要跟我們當前的username一致才可以修改 -->
                <?php if ($row['username']===$username){ ?> 
                <a href="update_comment.php?id=<?php echo $row['id'] ?>">編輯</a>
                <?php } ?>  
              </div>
              <p class="card__content">
              <?php echo escape($row['content'])?>
              </p>
          </div>
        </div>
        <?php } ?>
      </section>
  </main>
  <script>
    var btn = document.querySelector('.update-nickname')
    btn.addEventListener('click', function() {
      var form = document.querySelector('.board__nickname-form')
      form.classList.toggle('hide')
    })
  </script>
</body>
</html> 