<?php
require_once APPPATH."controllers/Controller.php";
class Pages extends Controller {

        public function view($page = 'home')
        {
            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
            {
                   
                    show_404();
            }
            $this->load->model('News_model');
            $data['news'] =$this->News_model->getLoaitinOj();
            $data['title'] = ucfirst($page);
            $data['class'] = $this->uri->segment('1'); //trả về class
            $data['function']=  $this->uri->segment('2'); //trả về function
            $data['id']  = $this->uri->segment('3'); //trả về ID
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer', $data);
           
          
        }
        function form(){
                $data['title'] = "home";
                 $this->load->view('news/create',$data);
        }
        
       
}