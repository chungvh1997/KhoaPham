<?php
    require_once('../define.php');

    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

    try{
        $db = new PDO($dsn,DB_USER, DB_PASS, $options);
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }

    $query = "SELECT * FROM ".DB_TABLE;
    foreach($db->query($query) as $value){
        echo $value['name']."<br>";
    }
?>