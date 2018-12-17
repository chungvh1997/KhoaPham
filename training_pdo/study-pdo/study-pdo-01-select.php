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
    // 02 SELECT fetch 
    $query = "SELECT * FROM ".DB_TABLE;
    // sử dụng prepare để query
    $stmt = $db->prepare($query);
    // thực thi câu truy vấn
    if($stmt->execute()){
        // c1
        //khai báo kiểu mảng
        // $stmt ->setFetchMode(PDO::FETCH_ASSOC);
        // lấy danh sách kết quả
        // $result = $stmt->fetchAll();
        // duyệt kết quả
        // foreach($result as $item){
         //   echo $item['id']. '-' .$item['name'].'<br>';
        //}
        // c2
        while($row = $stmt ->fetchAll(PDO::FETCH_COLUMN)){
          //  echo "<pre>";
          //  print_r($row);
          //  echo "</pre>";
        }
        
    }

    // 03 SELECT fetch có điều kiện 
    $query = "SELECT * FROM ".DB_TABLE.' WHERE id =?';
   // ĐK LỚN HƠN 2    $query = "SELECT * FROM ".DB_TABLE.' WHERE id > ?';
   // ĐK LỚN HƠN 2 và status phải = 1   $query = "SELECT * FROM ".DB_TABLE.' WHERE id >= ? AND status = ?';
    $id     = 2;
    $status = 1;
    $stmt =$db->prepare($query);
    if($stmt->execute(array($id))){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          //  echo "<pre>";
          //  print_r($row);
          //  echo "</pre>";
        };
    };

?>