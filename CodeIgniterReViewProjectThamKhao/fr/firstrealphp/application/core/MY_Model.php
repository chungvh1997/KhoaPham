<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct(){
        if (!empty($this->table)) {

        }else{
            echo "Can't find table ".$this->table." in database.";die;
        }
        parent::__construct();
    }
    
}