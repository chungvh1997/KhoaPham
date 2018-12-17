<?php

    class BaseController{

        function loadView(string $view,array $data=[]){
            include_once "view/layout.view.php";
        }
      
    }
?>