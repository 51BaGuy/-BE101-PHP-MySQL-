<?php
    if(empty($_POST['name']) || empty($_POST['age'])){
        echo '資料有缺，請再次填寫<br>';
        exit();
    }

    echo "Hello! " . $_POST['name'] . "<br>";
    echo "Your age is" . $_POST['age'] . "<br>";
    print_r($_POST)

?>