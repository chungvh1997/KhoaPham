<?php
if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";
switch ($action) {
    case "edit":
        get_setting();
        $template = "setting/edit";
        break;
    case "save":
       save_setting();
        break;

    default:
        $template = "index";
}
function get_setting() {
    global $d, $get_setting;

    $sql = "select * from setting limit 0,1";
    $d->query($sql);
    $get_setting = $d->fetch_array();
}
function save_setting() {
    global $d;
    $file_name_logo = fns_Rand_digit(0, 9, 8);
    $file_name_favicon = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "index.php?post=setting&action=edit");
    $data['Title'] = mysql_escape_string($_POST['title']);
    $data['Keywords'] = mysql_escape_string($_POST['keywords']);
    $data['Description'] = mysql_escape_string($_POST['description']);
    $data['Name'] = mysql_escape_string($_POST['name']);
    $data['Email'] = mysql_escape_string($_POST['email']);
    $data['Hotline'] = mysql_escape_string($_POST['hotline']);
    $data['Address'] = mysql_escape_string($_POST['address']);
    $data['Content'] =  mysql_escape_string($_POST['content']);
    $data['Content2'] =  mysql_escape_string($_POST['content2']);
    $data['Content3'] =  mysql_escape_string($_POST['content3']);    
    $data['Location'] = mysql_escape_string($_POST['location']);
    $data['Extension'] = mysql_escape_string($_POST['extension']);
    if ($logo = upload_image("logo", 'jpg|png|gif|PNG|GIF|JPEG|JPG|jpeg|ico', _upload_thumb, $file_name_logo)) {
        $data['Logo'] = $logo;
        $d->setTable('setting');
        $d->setWhere('ID', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_thumb . $row['logo']);
        }
    }
    if ($favicon = upload_image("favicon", 'png|PNG|ico', _upload_thumb, $file_name_favicon)) {
        $data['Favicon'] = $favicon;
        $d->setTable('setting');
        $d->setWhere('ID', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_thumb . $row['Favicon']);
        }
    }
    $d->reset();
    $d->setTable('setting');
    if ($d->update($data))
        transfer("Cập nhật dữ liệu thành công", "index.php?post=setting&action=edit");
    else
        transfer("Cập nhật dữ liệu bị lỗi", "index.php?post=setting&action=edit");
}

?>