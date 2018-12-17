<?php
session_start();
if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";

$id = $_REQUEST['id'];
switch ($action) {
    case "man":
        get_posts();
        $template = "dashboard/posts";
        break;

    }
#====================================
function get_posts() {
    global $d,$total_contact, $total_post;
    $d->query("select * from contact ");
    $total_contact=$d->result_array();    
    $d->query("select * from posts ");
    $total_post=$d->result_array();      
}

?>