<?php
    include_once "BaseController.php";
    include_once "model/IndexModel.php";
    class IndexController extends BaseController{
        function getHome(){
            $model = new IndexModel;
            $p= $model->loadProductIndex();
            // print_r($p); die;
            return $this->loadView('index',$p);
        }
        
    }
?>