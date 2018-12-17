<?php

if (!defined('_lib'))
    die("Error");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$config_url = $_SERVER["SERVER_NAME"].'/first_real';
$config['database']['servername'] = 'localhost';
$config['database']['username'] = 'root';
$config['database']['password'] = '';
$config['database']['database'] = 'first_real';
$config['database']['refix'] = '';
$alt = $config_url;
$level = 2;
?>