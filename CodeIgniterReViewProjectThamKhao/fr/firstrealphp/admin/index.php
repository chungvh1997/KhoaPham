<?php
session_start();
@define('_template', './templates/');
@define('_source', './sources/');
@define('_lib', './lib/');
error_reporting(0);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
$post = (isset($_REQUEST['post'])) ? addslashes($_REQUEST['post']) : "";
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";
$d = new database($config['database']);
switch ($post) {
    case 'salespolicy':
        $source = "salespolicy";
        break;
    case 'setting':
        $source = "setting";
        break;
    case 'category':
        $source = "category";
        break;
    case 'contact':
        $source = "contact";
        break;
	case 'posts':
        $source = "posts";
        break;
    case 'user':
        $source = "user";
        break;
    case 'slider':
        $source = "slider";
        break;
    default:
        $source = "dashboard";
        break;
}
if ((!isset($_SESSION[$login_name]) || $_SESSION[$login_name] == false) && $action != "login") {
    redirect("index.php?post=user&action=login");
}
if ($source != "")
    include _source . $source . ".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/DTD/strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta charset="utf-8">
    <title>Admin</title>
    <meta content="Latest updates and statistic charts" name="description">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"><!--begin::Web font -->
    <link rel="shortcut icon" href="public/images/favicon.ico" />
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

        <script>
          WebFont.load({
            google: {"families":["Roboto:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>  <!-- Poppins -->
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="public/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css">
    <link href="public/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css">
    <link href="public/assets/demo/default/base/datatables.bundle.css" rel="stylesheet" type="text/css">
    <link href="public/assets/format.css" rel="stylesheet" type="text/css"> 
    <script src="public/assets/jquery.min.js" type="text/javascript"></script> 
    <link rel="stylesheet" href="public/assets/bootstrap-clockpicker.css">
    <script type="text/javascript" src="ckfinder/ckfinder.js" charset="utf-8"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js" charset="utf-8"></script>

        <script type="text/javascript">

        $(document).ready(function(){

            $(".editor").each(function(){
            $id=$(this).attr("id");


            var editor = CKEDITOR.replace(''+$id, {
            contentsCss: [ 'public/assets/bootstrap-3.2.0/css/bootstrap.min.css' ],

            uiColor: '#EAEAEA',
            language: 'vi',
            skin: 'moono',
            width: '100%',
            resize_enabled: false,
            removePlugins: 'resize',
            removePlugins : 'elementspath',
            qtRows: 20, // Count of rows
            qtColumns: 20, // Count of columns
            qtBorder: '1', // Border of inserted table
            qtWidth: '90%', // Width of inserted table
            qtStyle: { 'border-collapse' : 'collapse' },
            height: 300,
            filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
            filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
            filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
            on: {
            instanceReady: loadBootstrap,
            mode: loadBootstrap
            }
            });
            })
            function loadBootstrap(event) {
            if (event.name == 'mode' && event.editor.mode == 'source')
            return; // Skip loading jQuery and Bootstrap when switching to source mode.

            var jQueryScriptTag = document.createElement('script');
            var bootstrapScriptTag = document.createElement('script');

            jQueryScriptTag.src = 'public/assets/jquery.min.js';
            bootstrapScriptTag.src = 'public/assets/bootstrap-3.2.0/js/bootstrap.min.js';

            var editorHead = event.editor.document.$.head;

            editorHead.appendChild(jQueryScriptTag);
            jQueryScriptTag.onload = function() {
            editorHead.appendChild(bootstrapScriptTag);
            };
            }
            })

            </script>
<script language="javascript" src="public/media/scripts/my_script.js"></script>            
</head><!-- end::Head -->
<style type="text/css">
    .add_class{
        margin-top:10px;background:#15214b;color:#fff;border: 1px double #15214b;cursor: pointer;padding:5px 10px;border-radius:5px;display: none;
    }
</style>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <?php if (isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)) { ?> 
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <?php include _template . "header_tpl.php" ?>

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body" >

        <?php include _template . "asider-left_tpl.php" ?>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content" >
        <?php include _template . $template . "_tpl.php" ?>
        </div>
        </div>
        </div>
        <?php include _template . "footer_tpl.php" ?>
    </div>
    <?php } else { ?>
    <?php include _template . $template . "_tpl.php" ?>
    <?php }  ?>
    <div class="m-scroll-top" id="m_scroll_top">
        <i class="la la-arrow-up"></i>
    </div><!-- end::Scroll Top --><!-- begin::Quick Nav -->
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="public/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="public/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="public/assets/main.js" type="text/javascript"></script> 
<script src="public/assets/bootstrap-clockpicker.js"></script>
<script src="public/assets/moment.js"></script>
     <script type="text/javascript">
     
  var BootstrapSelect={init:function(){$(".m_selectpicker").selectpicker()}};
  jQuery(document).ready(function(){BootstrapSelect.init()});

</script> 
</body>
</html>
