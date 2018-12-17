<?php
include_once "controller/IndexController.php";
$a = new IndexController;
return $a->getHome();
