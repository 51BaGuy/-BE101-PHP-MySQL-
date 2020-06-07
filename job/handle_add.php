<?php
    // 把我們要的連線檔抓進來
    require_once('./conn.php');
    $title=$_POST['title'];
    $desc=$_POST['description'];
    $salary=$_POST['salary'];
    $link=$_POST['link'];

    // 做個簡單的輸出確認(這裡的變數本身就是字串)
    // echo $title . $desc . $salary . $link;
    // 如果資料有缺就停止繼續往下跑
    if(empty($title)||empty($desc)||empty($salary)||empty($link)){
        die('請檢查資料');
    }

    $sql = "INSERT INTO jobs (title,description,salary,link) VALUES ('$title','$desc','$salary','$link') ";
    // 有執行成功，就會有結果
    $result = $conn->query($sql);
    if($result){
        header('Location: ./admin.php');
    }else{
        echo 'failed, ' . $conn->error;
    }

?>