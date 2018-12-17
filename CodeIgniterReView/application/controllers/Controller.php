<?php
class Controller extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('News_model');
            $this->load->helper('url_helper');
    }

    public function getNews()
    {
            $data['news'] = $this->News_model->ect();
    }



       
}