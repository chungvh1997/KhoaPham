<?php
    include_once "DBConnect.php";

    $a = new DBConnect;
    $sql="SELECT * from products";
  

    $test = $a->loadOneRow($sql);
    
    print_r($test);
?>