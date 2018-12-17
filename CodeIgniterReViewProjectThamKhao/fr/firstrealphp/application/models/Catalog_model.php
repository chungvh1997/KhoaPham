<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Catalog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public $smy_productgroups = "smy_contentgroup";
    public $smy_product = "smy_content";
    public function getDetailCatalog($link)
    {
        $sql = "SELECT * FROM " . $this->smy_productgroups . " where link = '".$link."' ";
        $query = $this->db->query($sql);
        $data = $query->row_object();
        return $data;
    }
    
    public function getCatalog_Child($id_Parent){
       
        $sql = "SELECT co.*, cogr.name as groupname, cogr.link as grouplink  FROM " . $this->smy_product . " 
        AS co LEFT OUTER JOIN 
        ".$this->smy_productgroups." 
        AS cogr ON co.groups = cogr.id
        where groups= '".$id_Parent."'  
        ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        return $data;
    }
    

  
}
