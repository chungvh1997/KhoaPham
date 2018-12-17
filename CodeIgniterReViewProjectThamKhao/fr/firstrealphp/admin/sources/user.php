<?php

if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";
switch ($action) {
    case "login":
        if (!empty($_POST))
            login(); 
        $template = "user/login";
        break;
    case "edit":
        get_user(); 
        $template = "user/edit"; 
        break;
    case "logout":
        logout();
        break;
    case "save":
        save_user();
        break;
    default:
        $template = "index";
}
////////////////// lấy thông tin user
function get_user() {
    global $d, $get_post;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php");

    $sql = "select * from users where ID='" . $id . "' and Role=1";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php");
    $get_post = $d->fetch_array();
}
function save_user() {

    global $d, $login_name;
    if (!empty($_POST)) {     
        $sql = "select * from users where Username!='" . $_SESSION['login']['Username'] . "' and Username='" . $_POST['username'] . "' and Role=1";
        $d->query($sql);
        if ($d->num_rows() > 0)
            transfer("Tên đăng nhập này đã có", "index.php?post=user&action=edit&id=1");

        $sql = "select * from users where Username='" . $_SESSION['login']['Username'] . "'";
        $d->query($sql);
        if ($d->num_rows() == 1) {
            $row = $d->fetch_array();
            if ($row['Password'] != md5($_POST['oldpassword']))
                transfer("Mật khẩu không chính xác", "index.php?post=user&action=edit&id=1");
        }else {
            die('Hệ thống bị lỗi. <br>Cám ơn.');
        }

        $data['Username'] = $_POST['username'];
        if ($_POST['new_pass'] != "")
            $data['Password'] = md5($_POST['new_pass']);
        $d->reset();
        $d->setTable('users');
        $d->setWhere('Username', $_SESSION['login']['Username']);
        if ($d->update($data)) {
            session_unset();
            transfer("Dữ liệu đã được lưu.", "index.php");
        }
    }

}

function login() {
    
    global $d, $login_name;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from users where Username='" . $username . "'";
    $d->query($sql);
    if ($d->num_rows() == 1) {
        $row = $d->fetch_array();
        if (($row['Password'] == md5($password))) {
            if($row['Display']==1){
                $_SESSION[$login_name] = true;
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['login']['Username'] = $username;
                $_SESSION['login']['Role'] = $row['Role'];
                $_SESSION['login']['ID'] = $row['ID'];
                unset($_SESSION['errorlog']);
                transfer("Đăng nhập thành công", "index.php");
            }else{
                $_SESSION['errorlog'] = '<span style="color:#fd0020"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Tài khoản bị khóa vui lòng liên hệ quản trị viên.</span>';
                transfer("Tên đăng nhập đã bị khóa", "index.php?post=user&action=login");
            }    
        }else{
            $_SESSION['errorlog'] = '<span style="color:#fd0020"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Thông tin tài khoản không chính xác.</span>';
            transfer("Tên đăng nhập hoặc mật khẩu không chính xác", "index.php?post=user&action=login");
        }
    } else {
        $_SESSION['errorlog'] = '<span style="color:#fd0020"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Thông tin tài khoản không chính xác.</span>';
        transfer("Tên đăng nhập hoặc mật khẩu không chính xác", "index.php?com=post&action=login");
    }
    
}
function logout() {
    global $login_name;
    $_SESSION[$login_name] = false;
    transfer("Đăng xuất thành công", "index.php?post=user&action=login");
}

?>