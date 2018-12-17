<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public $smy_product = "smy_product";
    public function getDetailProduct($link)
    {
        $sql = "SELECT * FROM " . $this->smy_product . " where link = '".$link."' ";
        $query = $this->db->query($sql);
        $data = $query->row_object();
        return $data;
    }
}
