<?php
    require_once('conn.php');
    ////// 我們可以產生隨機token變數的通行證 ////////
    function generateToken(){
        $s = '';
        for($i=1;$i<16;$i++){
            // 把我們隨機產生45到60的亂數轉成字串
            $s .= chr(rand(65,90));
        }
        return $s;
    }

    ///// utils.php修改我們函式，用出一個可以去資料庫取出我們users table數據的函式//////
    function getUserFromUsername($username){
        global $conn;
        $sql = sprintf("select * from users where username = '%s'",
        $username
        );
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    ////////要用html_specialcharts去utils.php寫成function////////
    function escape($str){
        return htmlspecialchars($str, ENT_QUOTES);
    }

?>