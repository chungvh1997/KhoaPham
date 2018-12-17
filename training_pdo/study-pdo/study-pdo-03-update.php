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

    //03 update
    $query = "UPDATE `" .DB_TABLE ."` SET  `status` = :status, `odering` = :ord WHERE `id` = :id ";
    $stmt = $db->prepare($query);
    $stmt ->bindParam(':status',$status);
    $stmt ->bindParam(':id',$id);
    $stmt ->bindParam(':ord',$ord);

   // $status = 3;
   // $id = 1; 
   // $ord = 69;
   // $stmt ->execute();

    $data   =[  ':status'=>11,
                ':ord'=>96,
                ':id'=>2
             ];
    $stmt ->execute($data);


    
?>