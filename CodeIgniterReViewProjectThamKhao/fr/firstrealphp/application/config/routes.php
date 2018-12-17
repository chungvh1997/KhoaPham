<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['addcontact'] = 'home/addcontact';
$route['addcontact2'] = 'home/addcontact2';
$route['search'] = 'home/search';
$route['du-an/(:any)'] = 'catalog/index/$1';


//the end customer
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['^(.*)$'] = $route['default_controller'];
