<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        
        $this->load->model('Home_model');
        $this->load->model('Product_model');
    }
    
    public function index()
    {
        $controller = strtolower($this->uri->segment(1));
        
            switch ($controller) {
                case 'home':
                    $this->folder = 'home';
                    $this->file = 'default';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaHome();
                    $data['listSlider'] = $this->Home_model->listSlider(51); 
                    $data['listnews'] =  $this->Home_model->getListNewsHome('tin-tuc');     
                    break;
                    
                case '':
                    $this->folder = 'home';
                    $this->file = 'default';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaHome();
                    $data['listSlider'] = $this->Home_model->listSlider(51);  
                    $data['listnews'] =  $this->Home_model->getListNewsHome('tin-tuc');  
                    break;
                case 'gioi-thieu':
                    $this->folder = 'pages';
                    $this->file = 'gioithieu';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaPages('gioi-thieu');
                    $data['listSlider'] = $this->Home_model->listSlider($data['metas']->ID); 
                       
                    break;
                case 'lien-he':
                    $this->folder = 'pages';
                    $this->file = 'lienhe';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaPages('lien-he');
                    $data['contact'] = $this->Home_model->getMetaHome();
                    break;
                case 'tien-ich':
                    $this->folder = 'pages';
                    $this->file = 'tienich';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaPages('tien-ich');
                    $data['listSlider'] = $this->Home_model->listSlider($data['metas']->ID);
                    break;
                case 'du-an':
                    $this->folder = 'catalog';
                    $this->file = 'default';
                    $view = 1;
                    $data['metas'] = $this->Home_model->getMetaPages('du-an');
                    $data['listproject'] =  $this->Home_model->getListProject('du-an');
                    $data['listnews'] =  $this->Home_model->getListNews('tin-tuc');
                    $data['cataloglink'] = array('Tin tức','tin-tuc');
                    //print_r($data['listnews']);die;
                    break;
                 break;
                default:
                  
                    $res =  $this->Home_model->checkPostAndCatalog($controller);
                    //print_r($res);die;
                    switch ($res['type']) {
                        case 0:
                            $view =  0;
                            break;
                        case 1:
                          
                            $view =  1;
                            $this->folder = 'catalog';
                            $this->file = 'listcatalog';
                            $data['metas'] =$res['metas'];

                            $pagi = $this->input->get();
                            $index = (isset($pagi['p'])) ? $pagi['p'] : 1;
                            $dataPost=  $this->Home_model->getListPostsAll($res['metas']->ID);
                            $data['listdata'] = $this->dataPagition($dataPost,'DESC','id',$index,8,count($dataPost));

                           
                            //print_r($res);die;
                            break;
                        case 2:
                            $view =  1;
                            $this->folder = 'catalog';
                            $this->file = 'detail';
                            $data['metas'] = $res['data'];
                           
                            $data['listnews'] =  $this->Home_model->getListNewsviewmore($res['data']->ID, $res['data']->Parent_ID);
                            $data['cataloglink'] = array($res['data']->Name,$res['data']->Link);
                            break;
                    }
                    break;
                  
            }
            if($view==1){
             //print_r($data['listSlider']);die;
                $data['footer'] = $this->Home_model->getMetaHome();   
                $this->load->view('default',$data);
            }else{
                redirect('/');
            }
            
        
    }

    public function getListContent()
    {
        $data= $this->Home_model->getListContent();
        return $data;
    }
    public function addcontact()
    {
        # code...
        $data = $this->input->post();
        //print_r(Time());die;
        $arr = array(
            'Email' => $data['email'],
            'Full_Name' => $data['name'],
            'Address' => '',
            'Content' => $data['content'],
            'Cat_ID' => $data['canho'],
            'Phone'=> $data['phone'],
            'Date_create'=>Time(),
        );
        $res= $this->Home_model->addContact( $arr );
        if ($res == true) {
            echo json_encode(array('status' => true, 'message' => 'Bạn đã gửi thành công', 'data' => []));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Bạn gửi thất bại', 'data' => []));
        }
    }
    public function addcontact2()
    {
        # code...
        $data = $this->input->post();
        //print_r(Time());die;
        $arr = array(
            'Email' => $data['email'],
            'Full_Name' => $data['name'],
            'Address' => '',
            'Content' => $data['content'],
            'Cat_ID' => '',
            'Phone'=> '',
            'Date_create'=>Time(),
        );
        $res= $this->Home_model->addContact( $arr );
        if ($res == true) {
            echo json_encode(array('status' => true, 'message' => 'Bạn đã gửi thành công', 'data' => []));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Bạn gửi thất bại', 'data' => []));
        }
    }
    public function search()
    {
            $this->folder = 'catalog';
                            $this->file = 'search';
                             $data['metas'] = $this->Home_model->getMetaHome();
                            $pagi = $this->input->get();
                           //print_r($pagi['key']);die;
                           $data['listdata'] =  $this->Home_model->search($pagi['key'],$pagi['province'],$pagi['noun']);
                          //print_r($data);die;
         $this->load->view('default',$data);
    }
}
