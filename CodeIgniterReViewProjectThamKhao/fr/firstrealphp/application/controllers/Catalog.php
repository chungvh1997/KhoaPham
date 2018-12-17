<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->folder = 'catalog';
        $this->load->model('Catalog_model');
    }
    
    public function index()
    {
        $this->file="listcatalog";
        $url1 = strtolower($this->uri->segment(1));
        $url2 = strtolower($this->uri->segment(2));
        $d = $this->Catalog_model->getDetailCatalog($url2);
      
        $pagi = $this->input->get();
        $index = (isset($pagi['p'])) ? $pagi['p'] : 1;
       
       if($d){
            if($d->parent == 0){
                
                $data['catalog'] =  $this->Catalog_model->getCatalog_Child($d->id);
                $data = $this->dataPagition($data['catalog'],'DESC','id',$index,4,count($data['catalog']));
                $data['metas'] = $d;
            }   
            //print_r($data);die;
            $this->load->view('default',$data );
       }else{
        redirect('/home');
       }
       
    }

    
}
