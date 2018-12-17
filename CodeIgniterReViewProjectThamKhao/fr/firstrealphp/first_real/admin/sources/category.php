<?php
session_start();
if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";
$id = $_REQUEST['id'];
switch ($action) {
    case "man":
        get_categorys();
        $template = "category/categorys";
        break;
    case "add":
         get_level1() ;   
         $template = "category/category_add";
         break;
    case "edit":
         get_category();
         $template = "category/category_add";
         break;
    case "save":
        save_category();
        break;
    case "delete":
        delete_category();
        break;
    }
    #===================================================    
function get_categorys() {
    global $d,$category,$get_level1;
    $d->reset();
    $sql = "select * from category where Level=1";
    $d->query($sql);  
    $get_level1=$d->result_array();    
    #----------------------------------------------------------------------------------------
    $sql = "select * from category where Level ='" . $_REQUEST["level"] . "'";
    if ($_REQUEST["parent_id"] != '') {
        $sql.=" and Parent_ID='" . $_REQUEST["parent_id"] . "' ";
    }
    $sql.=" order by Rank,ID desc";
    $d->query($sql);
    $category = $d->result_array();
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "index.php?post=category&action=man";
    $maxR = 500;
    $maxP = 500;
    $paging = paging($category, $url, $curPage, $maxR, $maxP);
    $category = $paging['source'];
    
}
function get_category() {
    global $d,$get_category;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php?post=category&action=man");
    $sql = "select * from category where ID='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?post=category&action=man");
    $get_category = $d->fetch_array();
}
function get_level1() {
    global $d,$get_level;
    $d->reset();
    $sql = "select * from category where Level=1";
    $d->query($sql);  
    $get_level=$d->result_array();
}
function save_category() {
    global $d;
    $file_name = changeTitle($_POST['name']) .'-'. fns_Rand_digit(0, 9, 3);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "index.php?post=category&action=man&level=" . $_REQUEST['level'] . "");
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $data['Parent_ID'] = $_POST['parent_id'];
    //Phần dữ liệu chung
    $data['Name'] = $_POST['name'];
    $data['Keywords'] = $_POST['keywords'];
    $data['Description'] = $_POST['description'];
    $data['Level'] = $_REQUEST['level'];
    $data['Rank'] = $_POST['rank'];    
    if ($id) {
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
            $d->setTable('category');
            $d->setWhere('ID', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_thumb . $row['Thumb']);
            }
        }
        if (!empty($_POST["parent_id"])) {
            $data['Set_level'] = implode($_POST["parent_id"], ',');
        }
        $count = count($_POST["parent_id"]);
        $data['Parent_ID'] = ($_POST["parent_id"][$count - 1]);
        $data['Display'] = isset($_POST['display']) ? 1 : 0;
        $data['Date_create'] = time();

        $d->reset();
        $sql_pro="select * from posts where Link='".changeTitle($_POST['name'])."' ";
        $d->query($sql_pro);
        $name_pro=$d->result_array();
        $dem = count($name_pro);

        $d->reset();
        $sql_pro="select * from category where Link='".changeTitle($_POST['name'])."' and ID <> '".$id."'";
        $d->query($sql_pro);
        $name_pro_l=$d->result_array();
        $dem1 = count($name_pro_l);


        $data['Name'] = mysql_escape_string($_POST['name']);
        if($dem > 0 || $dem1 > 0 || $dem > 4){ 
            $data['Link'] = changeTitle($_POST['name']).'-'.substr(md5($id),2,6);
        }else{    
            $data['Link'] = changeTitle($_POST['name']);
        }
        $d->setTable('category');
        $d->setWhere('ID', $id);
        if ($d->update($data))
            transfer("Cập nhật dữ liệu thành công", "index.php?post=category&action=man&level=" . $_REQUEST['level'] . "&curPage=" . $_REQUEST['curPage'] . "");
            
        else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?post=category&action=man&level=" . $_REQUEST['level'] . "");
    }else {

        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
        }
        if (!empty($_POST["parent_id"])) {
            $data['set_level'] = implode($_POST["parent_id"], ',');
        }
        $count = count($_POST["parent_id"]);
        $data['Parent_ID'] = ($_POST["parent_id"][$count - 1]);
        $data['Rank'] = $_POST['rank'];
        $data['Display'] = isset($_POST['display']) ? 1 : 0;
        $data['Date_create'] = time();
        $data['Name'] = mysql_escape_string($_POST['name']); 
        $data['Link'] = changeTitle($_POST['name']);
        
        $d->setTable('category');
        if ($d->insert($data)){
            $idnew = mysql_insert_id();
            $d->reset();
            $sql_pro="select * from posts where Link='".changeTitle($_POST['name'])."' ";
            $d->query($sql_pro);
            $name_pro=$d->result_array();
            $dem = count($name_pro);
            $d->reset();
            $sql_pro="select * from category where Link='".changeTitle($_POST['name'])."' and ID <> ".$idnew." ";
            $d->query($sql_pro);
            $name_pro_l=$d->result_array();
            $dem1 = count($name_pro_l);
            if($dem > 0 || $dem1 > 0 ){ 
                $data['Link'] = changeTitle($_POST['name']).'-'.substr(md5($id),2,6);
            }
                $d->setTable('category');
                $d->setWhere('ID', $idnew);
                if ($d->update($data)){
                   
                }
            transfer("Thêm dữ liệu thành công", "index.php?post=category&action=man&level=" . $_REQUEST['level'] ."");    
        }
        else
            transfer("Lưu dữ liệu bị lỗi", "index.php?post=category&action=man&level=" . $_REQUEST['level'] ."");
    }
}
function delete_category() {
    global $d;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d->reset();
        $sql = "select * from category where ID='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_thumb . $row['Thumb']);
            }
            $sql = "delete from category where ID='" . $id . "'";
          //  $d->query($sql);
        }
        if ($d->query($sql))

        transfer("Xóa thành công", "index.php?post=category&action=man&level=" . $_REQUEST['level'] .  "");
        else
            transfer("Xóa dữ liệu bị lỗi", "index.php?post=category&action=man&level=" . $_REQUEST['level'] .  "");
    } else
        transfer("Không nhận được dữ liệu", "index.php?post=category&action=man&level=" . $_REQUEST['level'] . "");
}

?>

