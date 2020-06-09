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

    //////  把用token找到username，再用username找到我們的nickname，這段過程寫進去utils.php裡面，去做一個函式，好方便使用 ///////
    // 這裡函式的參數就是要我們把通行證擺進去用的
    function getUserFromUsername($username){
        global $conn;
        $sql = sprintf("select * from users where username = '%s'",
        $username
        );
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

?>