<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
   
    public $category = "category";
    public $contact = "contact";
    public $setting = "setting";
    public $posts = "posts";
    public $slider_cat = "slider_cat";
    public $slider = "slider";
    
    public function getMenuParent()
    {
        $sql = "SELECT * FROM " . $this->category . " where Parent_ID = 0 and Level =1 and Display=1 ORDER BY Rank ASC ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        return $data;
    }
    
    public function addContact($data)
    {
        $is = $this->db->insert($this->contact, $data);
        return $is;
    }
    public function getMetaHome()
    {
        $sql = "SELECT * FROM " . $this->setting . " where id = 1";
        $query = $this->db->query($sql);
        $data = $query->row_object();
        return $data;
    }
    public function getMetaPages($link)
    {
        $sql = "SELECT * FROM " . $this->category . " where Link ='".$link."'";
        $query = $this->db->query($sql);
        $data = $query->row_object();
        return $data;
    }
    public function getListProject($link)
    {
        $sql = "SELECT * FROM " . $this->category . " where Link ='".$link."' ";
        $query = $this->db->query($sql);
        $data = $query->row_object();
       //print_r($data);die;
        $sql = "SELECT * FROM " . $this->category . " WHERE find_in_set('" . $data->ID . "', Parent_ID)>0 ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        return $data;
    }
   
    
    public function checkPostAndCatalog($link)
    {
        //type  1. danh sách, 2. chi tiết, 0.không tồn tại link
        $arr=array();
        $sql = "SELECT * FROM " . $this->category . " where Link ='".$link."'";
        $query = $this->db->query($sql);
        $data = $query->row_object();
      
        if( count($data)>0){
           
            $sql2 = "SELECT * FROM " . $this->posts . " WHERE find_in_set('" . $data->ID . "', Parent_ID)>0 and Display=1 ORDER BY ID DESC LIMIT 0,3 ";
            $query2 = $this->db->query($sql2);
            $data2 = $query2->result_array();
         
           if(count($data2) > 0 ){
                $arr['metas'] = $data;
                $arr['data'] = $data2;
                $arr['type'] = 1;
           }else{
                $arr['data'] = $data;
                $arr['type'] = 2;
           }
        }else{
            $arr=array();
            $sql = "SELECT * FROM " . $this->posts . " where Link ='".$link."' and Display=1";
            $query = $this->db->query($sql);
            $data = $query->row_object();
            if(count($data) > 0 ){
                $arr['data'] = $data;
                $arr['type'] = 2;
               }else{
                $arr['data'] = [];
                $arr['type'] = 0;
               }
        }
        return $arr;
    }

    public function getListNewsviewmore($id,$parent)
    {
        $sql2 = "SELECT * FROM " . $this->posts . " WHERE find_in_set('" . $parent . "', Parent_ID)>0 and Display=1 AND ID !=".$id." ORDER BY ID DESC LIMIT 0,3 ";
        $query2 = $this->db->query($sql2);
        $data2 = $query2->result_array();
       // print_r($data2);die;
       return $data2;
    }
    public function getListPostsAll($parent)
    {
        $sql2 = "SELECT * FROM " . $this->posts . " WHERE find_in_set('" . $parent . "', Parent_ID)>0 and Display=1 ";
        $query2 = $this->db->query($sql2);
        $data2 = $query2->result_array();
      
        return $data2;
    }
    public function listSlider($parent)
    {
        $sql2 = "SELECT * FROM " . $this->slider_cat . " WHERE find_in_set('" . $parent . "', Parent_ID)>0 and Display=1 ORDER BY Rank ASC";
        $query2 = $this->db->query($sql2);
        $data2 = $query2->result_array();
       
        foreach ($data2 as $key => $value) {
            $sql3 = "SELECT * FROM " . $this->slider . " WHERE find_in_set('" . $value['ID'] . "', Slider_ID)>0 and Display=1 ORDER BY Rank ASC";
            $query3 = $this->db->query($sql3);
            $data3 = $query3->result_array();
            $data2[$key]['data'] = $data3;
         
        }
        //print_r($data2);die;
        return $data2;
    }

    public function getListNews($link)
    {
        $sql = "SELECT * FROM " . $this->category . " where Link ='".$link."' ";
        $query = $this->db->query($sql);
        $data = $query->row_object();
       //print_r($data);die;
        $sql = "SELECT * FROM " . $this->posts . " WHERE find_in_set('" . $data->ID . "', Parent_ID)>0 and Display=1 ORDER BY ID DESC LIMIT 0,3 ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        return $data;
    }
    
    public function getListNewsHome($link)
    {
        $sql = "SELECT * FROM " . $this->category . " where Link ='".$link."' ";
        $query = $this->db->query($sql);
        $data = $query->row_object();
       //print_r($data);die;
        $sql = "SELECT * FROM " . $this->category . " WHERE find_in_set('" . $data->ID . "', Parent_ID)>0 and Display=1 ORDER BY ID DESC ";
        $query = $this->db->query($sql);
        $data = $query->result_array();

        foreach ($data as $key => $value) {
            $sql2 = "SELECT * FROM " . $this->posts . " WHERE find_in_set('" . $value['ID'] . "', Parent_ID)>0 and Display=1 ORDER BY ID DESC LIMIT 0,4 ";
            $query2 = $this->db->query($sql2);
            $data2 = $query2->result_array();
            $data[$key]['listPost'] = $data2;
         
        }
      
        return $data;
    }
     public function search($k,$p,$n)
    {
        $string="";
        if ($p!=0) {
            $string.= " and Province_ID =".$p."";
        }
        if ($n!=0) {
            $string.= " and Noun =".$n."";     
        }
          

        $sql = "SELECT * FROM " . $this->posts . " where Name like '%".$k."%'  ".$string;
        $query = $this->db->query($sql);
        $data = $query->result_array();
      // print_r($data);die;
        return $data;
    }
}
