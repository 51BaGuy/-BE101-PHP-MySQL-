
<!-- 這邊我們要做的事很單純，就是解除cookie就好，所以其他資料隨便應付一下，但重點是要把時間往前推，這樣cookie就會直接失效 -->
<?php
    setcookie("username","",time()-3600);
    header('Location: ./index.php');
?>