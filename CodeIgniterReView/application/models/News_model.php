<?php
class News_model extends CI_Model {

       function __construct(){
        parent::__construct();
        $this->load->database();
       }
       public function theLoaiRowOj()
       {
           $sql = "SELECT * FROM theloai ";
           $query = $this->db->query($sql);
           $data = $query->row_object();
           return $data;
         
       }
       function getLoaitin(){
           
            $sql = "SELECT * FROM loaitin ";
            $query = $this->db->query($sql);
            $data = $query->result_array();
            return $data;
       }
       function getLoaitinOj(){
        $sql = "SELECT * FROM loaitin ";
        $query = $this->db->query($sql);
        $data = $query->result_object();
        return $data;
   }
       
}