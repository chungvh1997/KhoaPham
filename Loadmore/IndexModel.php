<?php
include_once 'DBConnect.php';
class IndexModel extends DBConnect {
    function loadProductIndex(){
        $sql = 'SELECT * from products ORDER BY id DESC LIMIT 3';
       return $this->loadMoreRow($sql);

    }
    function loadMoreAjax($id){
        $sql = "SELECT COUNT(*) as num_rows FROM products WHERE id < ".$id." ORDER BY id DESC";
      return  $check =$this->loadOneRow($sql);
        
    }
    function getRecords($id,$showLimit){
        $sql = "SELECT * FROM products WHERE id < ".$id." ORDER BY id DESC LIMIT $showLimit";
      return  $check =$this->loadMoreRow($sql);
        
    }
  
    
}

?>