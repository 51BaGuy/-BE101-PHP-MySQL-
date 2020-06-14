<?php
    require_once('conn.php');
    $page = 1;
    // 如果有取到頁面
    if(!empty($_GET['page'])){
      $page = intval($_GET['page']);
    }
    // 每頁取幾筆資料
    $items_per_page = 10;
    // 本頁是從第幾筆資料開始取
    $offset = ($page-1)*$items_per_page;
    $stmt = $conn->prepare(
      'select ' .
        'C.id as id , C.content as content , C.created_at as created_at, '.
        'U.nickname as nickname , U.username as username '.
      'from comments as C '.
      'left join users as U on C.username = U.username '.
      'where C.is_deleted IS NULL '.
      'order by C.id desc '.
      'limit ? offset ? '
    );
    // 把變數合併進去
    $stmt->bind_param('ii',$items_per_page,$offset);
    $result=$stmt->execute();
    if(!$result){
      die('Error:'. $conn->error);
    }
    $result = $stmt->get_result();
    
    // 我們把comments變數做成一個陣列
    $comments = array();
    
    while($row=$result->fetch_assoc()){
        // 把取出的結果放進去陣列裡面，看一下index.php確認我們需要甚麼資料就塞進去
        array_push($comments,array(
            "id"=>$row['id'],
            "username"=>$row['username'],
            "nickname"=>$row['nickname'],
            "content"=>$row['content'],
            "created_at"=>$row['created_at']
        ));
    }   
        // 排出json格式
        $json = array(
            "comments"=>$comments
        );
        // 最後把她轉成json格式
        $response = json_encode($json);
        // 讓瀏覽器知道我們要印出來的是JSON格式，然後我們印出來的是utf-8形式
        header('Content-type:application/json;charset=utf-8');
        echo $response;

    
?>