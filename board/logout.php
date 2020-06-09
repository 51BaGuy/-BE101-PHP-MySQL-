
<!-- 這邊我們要做的事很單純，就是解除cookie就好，所以其他資料隨便應付一下，但重點是要把時間往前推，這樣cookie就會直接失效 -->
<!-- <?php
    setcookie("username","",time()-3600);
    header('Location: ./index.php');
?> -->
/////////////////////////////////////////////////////////////

<!-- 我們這裡因為改成token的cookie，所以logout要改成移除token
-->

<?php
    require_once('conn.php');
    // 刪除 token
    $token = $_COOKIE['token'];
    $sql = sprintf(
        "DELETE from tokens WHERE token ='%s",
        $token
    );
    $conn->query($sql);
    setcookie("token","",time()-3600);
    header('Location: ./index.php');
?>