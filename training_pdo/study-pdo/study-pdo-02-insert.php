<?php
    require_once("../define.php");
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

    // 04 insert
    $query = "INSERT INTO  " .DB_TABLE. " (name,status,odering  ) VALUES (:name, :status, :odering)";
    $stmt = $db->prepare($query);
    //C1 Palceholder - single variable định danh cho name = :name
    //$stmt -> bindParam(':name',$name);
    //$stmt -> bindParam(':status',$status);
    //$stmt -> bindParam(':odering',$odering);

    //$name    = "Angular";
    //$status  = 1;
    //$odering = 10;

    //$stmt -> execute();

    //c2 Palceholder - thông qua array
    //$data = [":name" => "PHP",":status" => 1 , ":odering" => 12];
    //$stmt -> execute($data);

    //c3 Unamed Palceholder - single variable ko định danh
    $query = "INSERT INTO  " .DB_TABLE. " (name,status,odering ) VALUES (?,?,?)";
    $stmt = $db->prepare($query);
   
    $stmt -> bindParam(1,$name);
    $stmt -> bindParam(2,$status);
    $stmt -> bindParam(3,$odering);

   // $name    = "Angular123";
   //$status  = 2;
   // $odering = 6;

   //  $stmt->execute();
    // c4 Unamed Palceholder - Array
    $data = ["CSS",1,12];
    $stmt -> execute($data);
    // lấy vị trí id cuối cùng vừa thêm vào
    echo $db->lastInsertId();


?>