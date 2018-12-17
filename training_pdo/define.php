<?php

    define ('DB_HOST' , 'localhost');
    define ('DB_USER' , 'root');
    define ('DB_PASS' , '');
    define ('DB_NAME' , 'training_pdo');
    define ('DB_TABLE' , 'item');

?>
<?php
    // 01 khởi tạo kết nối pdo vs mysql
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",    //hỗ trợ csdl có tiếng việt
        PDO::ATTR_ERRMODE =>   PDO::ERRMODE_EXCEPTION // hiển thị lỗi , cảnh báo
    ];

    $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
   

    try{
        $db  = new PDO($dsn, DB_USER, DB_PASS,$options);
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    };
?>  