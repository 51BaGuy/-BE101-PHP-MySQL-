


<?php
    ////// 把seeion裡面的內容清除掉，他就讀取不到，但是你去瀏覽器看session id還在，不過因為他沒有內容了，相當於登出了，所以你有沒有session id不重要//////
    session_start();
    session_destroy();
    header('Location: ./index.php');
?>