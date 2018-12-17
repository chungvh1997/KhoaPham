<?php
    class DBConnect{

        private $conn = null;
        private $stmt = null;
        function __construct($dbname="mysql_khoapham",$user="root",$password='')
        {
            try { 
                $this->conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password); 
                $this->conn->exec("set names utf8");     
                //echo "tc";
            } 
            catch (PDOException $e) { 
                print "Error!: " . $e->getMessage() . "<br/>";   
                die(); 
            } 
        }
        
        function excuteQuery($sql,$data=[]){
            $this->stmt = $this->conn->prepare($sql);
            return $this->stmt->execute($data);
        }
        function loadOneRow($sql,$data=[]){
           $check=$this->excuteQuery($sql,$data);
            if($check){
                return $this->stmt->fetch(PDO::FETCH_OBJ);
              
            }
            return false;
        }
        function loadMoreRow($sql,$data=[]){
            $check=$this->excuteQuery($sql,$data);
            if($check){
                return $this->stmt->fetchAll(PDO::FETCH_OBJ);
              
            }
            return false;
        }

    }
?>