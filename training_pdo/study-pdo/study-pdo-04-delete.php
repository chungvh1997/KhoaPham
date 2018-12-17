<?php
    require_once('../define.php');

    $options = [
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

    $query = "DELETE FROM `".DB_TABLE. "`WHERE `id` = :id";
    $stmt = $db->prepare($query);
    $stmt ->bindParam(':id',$id);
    $id = 5;
    $stmt ->execute();

?>