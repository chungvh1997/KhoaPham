<?php
    require_once('../define.php');

    $options = 
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
    $db = new PDO($dsn,DB_USER,DB_PASS,$options);

    try{
        $db = new PDO($dsn,DB_USER,DB_PASS,$options);
       // echo "thanh cong";
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }

    // fetchALL lấy tất cả phần tử , fetch chỉ lấy từng  phần tử 1
    $query = "SELECT  `name`,`odering`,`status` FROM ".DB_TABLE;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
        echo "<pre>";
        print_r($result);
        echo "</pre>";

?>