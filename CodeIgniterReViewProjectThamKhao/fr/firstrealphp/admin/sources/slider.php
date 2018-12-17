<?php
session_start();
if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";

$id = $_REQUEST['id'];
switch ($action) {
    case "man":
        get_posts();
        $template = "slider/posts";
        break;
    case "add":
        $template = "slider/posts_add";
        break;
    case "edit":
      get_post();
        $template = "slider/posts_add";
        break;
    case "save":
        save_post();
        break;
    case "data_lists":
        data_lists();
        break;        
    case "delete":
        delete_post();
        break;
    case "media":
        $template = "slider/media";
        break;
    case "data_slider":
       data_slider();
        break;
    case "add_media":
        $template = "slider/media_add";
        break;
    case "edit_media":
        get_media();
        $template = "slider/media_add";
        break;
    case "save_media":
        save_media();
        break;                
    }
#====================================
function get_posts() {
    global $d,$menu_cat;
    $d->query("select * from category where Level=1 order by Rank asc, ID DESC");
    $menu_cat=$d->result_array();    
}
    function data_lists(){
    global $d;
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);
    
        $menu = ! empty($datatable['query']['category']['menu']) ? (int)$datatable['query']['category']['menu'] : 0 ;

        $category = ! empty($datatable['query']['category']['category']) ? (int)$datatable['query']['category']['category'] : 0 ;

        $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';

        $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'ID';

        $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;

        $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $string_s="";
        if ($menu!="") {
              $string_s.="  and  find_in_set('" . $menu . "', Parent_ID)>0 ";
        }

        if ($category!="") {
              $string_s.=" and  find_in_set('" . $category . "', Parent_ID)>0 ";
        }      

        $sql = "select * from slider_cat where ID>0 ".$string_s;

        $d->query($sql);
        $items = $d->result_array();
         $total = count($items);

        $data =  $items;

        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])

            ? $datatable['query']['generalSearch'] : '';

        if ( ! empty($filter)) {

            $data = array_filter($data, function ($a) use ($filter) {

                return (boolean)preg_grep("/$filter/i", (array)$a);

            });

            unset($datatable['query']['generalSearch']);

        }

        $meta    = [];

        $pages = 1;

        //sort

        usort($data, function ($a, $b) use ($sort, $field) {

            if ( ! isset($a[$field]) || ! isset($b[$field])) {

                return false;

            }

            if ($sort === 'asc') {

                return $a[$field] > $b[$field] ? true : false;

            }

            return $a[$field] < $b[$field] ? true : false;

        });

        // $perpage 0; get all data

        if ($perpage > 0) {

            $pages  = ceil(count($data) / $perpage); // calculate total pages

            $pages1  = ceil($total / $perpage); // calculate total pages

            $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0

            $page   = min($page, $pages1); // get last page when $_REQUEST['page'] > $totalPages

            $offset = ($page - 1) * $perpage;

            if ($offset < 0) {

                $offset = 0;

            }

            $data = array_slice($data, $offset, $perpage, true);

        }

        $meta = [

            'page'    => $page,

            'pages'   => $pages,

            'perpage' => $perpage,

            'total'   => $total,

        ];

        // if selected all records enabled, provide all the ids

        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {

            $meta['rowIds'] = array_map(function ($row) {

                return $row->RecordID;

            }, $alldata);

        }

        header('Content-Type: application/json');

        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        $result = [

            'meta' => $meta + [

                    'sort'  => $sort,

                    'field' => $field,

                ],

            'data' => $data,

        ];

        echo json_encode($result, JSON_PRETTY_PRINT);die();

    }
function data_slider(){
    global $d;
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);
    
        // $menu = ! empty($datatable['query']['category']['menu']) ? (int)$datatable['query']['category']['menu'] : 0 ;

        // $category = ! empty($datatable['query']['category']['category']) ? (int)$datatable['query']['category']['category'] : 0 ;

        $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';

        $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'ID';

        $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;

        $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $string_s="";
        // if ($menu!="") {
        //       $string_s.="  and  find_in_set('" . $menu . "', Parent_ID)>0 ";
        // }

        // if ($category!="") {
        //       $string_s.=" and  find_in_set('" . $category . "', Parent_ID)>0 ";
        // }      

        $sql = "select * from slider where ID>0 and Slider_ID=".$_GET['slider_id'];

        $d->query($sql);
        $items = $d->result_array();
         $total = count($items);

        $data =  $items;

        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])

            ? $datatable['query']['generalSearch'] : '';

        if ( ! empty($filter)) {

            $data = array_filter($data, function ($a) use ($filter) {

                return (boolean)preg_grep("/$filter/i", (array)$a);

            });

            unset($datatable['query']['generalSearch']);

        }

        $meta    = [];

        $pages = 1;

        //sort

        usort($data, function ($a, $b) use ($sort, $field) {

            if ( ! isset($a[$field]) || ! isset($b[$field])) {

                return false;

            }

            if ($sort === 'asc') {

                return $a[$field] > $b[$field] ? true : false;

            }

            return $a[$field] < $b[$field] ? true : false;

        });

        // $perpage 0; get all data

        if ($perpage > 0) {

            $pages  = ceil(count($data) / $perpage); // calculate total pages

            $pages1  = ceil($total / $perpage); // calculate total pages

            $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0

            $page   = min($page, $pages1); // get last page when $_REQUEST['page'] > $totalPages

            $offset = ($page - 1) * $perpage;

            if ($offset < 0) {

                $offset = 0;

            }

            $data = array_slice($data, $offset, $perpage, true);

        }

        $meta = [

            'page'    => $page,

            'pages'   => $pages,

            'perpage' => $perpage,

            'total'   => $total,

        ];

        // if selected all records enabled, provide all the ids

        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {

            $meta['rowIds'] = array_map(function ($row) {

                return $row->RecordID;

            }, $alldata);

        }

        header('Content-Type: application/json');

        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        $result = [

            'meta' => $meta + [

                    'sort'  => $sort,

                    'field' => $field,

                ],

            'data' => $data,

        ];

        echo json_encode($result, JSON_PRETTY_PRINT);die();

    }    
function get_post() {
    global $d,$get_post;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php?post=slider&action=man");
    $sql = "select * from slider_cat where ID='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?post=slider&action=man");
    $get_post = $d->fetch_array();

}
function save_post() {
    global $d;

    $file_name = changeTitle($_POST['name']) .'-'. fns_Rand_digit(0, 9, 2);
    if (empty($_POST))
    transfer("Không nhận được dữ liệu", "index.php?post=slider&action=man");
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    //Phần chung  
    $data['Name'] = mysql_escape_string($_POST['name']);
    $data['Name2'] = mysql_escape_string($_POST['name2']);   
    $data['Description'] = mysql_escape_string($_POST['description']);
    $data['Rank'] = $_POST['rank'];
    $data['Link'] = $_POST['link'];
   // $data['Display'] = isset($_POST['display']) ? 1 : 0;
    if ($id) { 
        $id = $_POST['id'];
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
            $d->setTable('slider_cat');
            $d->setWhere('ID', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_thumb . $row['Thumb']);
            }
        }
        $data["Parent_ID"] = implode($_POST["parent_id"], ",");
        $data['Date_create'] = time();

        $d->setTable('slider_cat');
        $d->setWhere('ID', $id);
        if ($d->update($data)) {
        transfer("Cập nhật dữ liệu thành công", "index.php?post=slider&action=man&curPage=" . $_REQUEST['curPage'] . "");               
        } else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?post=slider&action=man");
    } else {
       
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
        }
        $data["Parent_ID"] = implode($_POST["parent_id"], ",");
        $data['Date_create'] = time();
        $data['Name'] = mysql_escape_string($_POST['name']); 
        $data['Name2'] = mysql_escape_string($_POST['name2']); 
        $data['Link'] = $_POST['link'];

        $d->setTable('slider_cat');
        if ($d->insert($data)) {
            $id = mysql_insert_id();
                $d->setTable('slider_cat');
                $d->setWhere('ID', $id);
                if ($d->update($data)){}
             transfer("Lưu dữ liệu bị lỗi", "index.php?post=slider&action=man");
        } else
            transfer("Lưu dữ liệu bị lỗi", "index.php?post=slider&action=man");
    }
}
function delete_post() {
    global $d;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d->reset();
        $sql = "select * from slider_cat where ID='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_thumb . $row['Thumb']);
            }
            $sql = "delete from slider_cat where ID='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            transfer("Xóa dữ liệu thành công", "index.php?post=slider&action=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "index.php?post=slider&action=man");
    }
}





function get_media() {
    global $d,$get_post;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php?post=slider&action=media&slider_id=".$_REQUEST['slider_id']);
    $sql = "select * from slider where ID='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?post=slider&action=media&slider_id=".$_REQUEST['slider_id']);
    $get_post = $d->fetch_array();

}
function save_media() {
    global $d;

    $file_name = fns_Rand_digit(0, 9, 2);
    if (empty($_POST))
    transfer("Không nhận được dữ liệu", "index.php?post=slider&action=media");
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    //Phần chung  
    $data['Name'] = mysql_escape_string($_POST['name']);   
    $data['Description'] = mysql_escape_string($_POST['description']);
    $data['Rank'] = $_POST['rank'];
    $data['Link'] = $_POST['link'];
  //  $data['Display'] = isset($_POST['display']) ? 1 : 0;
    if ($id) { 
        $id = $_POST['id'];
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
            $d->setTable('slider');
            $d->setWhere('ID', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_thumb . $row['Thumb']);
            }
        }
        $data["Slider_ID"] = $_POST["slider_id"];
        $data['Date_create'] = time();

        $d->setTable('slider');
        $d->setWhere('ID', $id);
        if ($d->update($data)) {
        transfer("Cập nhật dữ liệu thành công", "index.php?post=slider&action=media&slider_id=".$_POST['slider_id']);               
        } else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?post=slider&action=media&slider_id=".$_POST['slider_id']);
    } else {
       
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
        }
        $data["Slider_ID"] = $_POST["slider_id"];
        $data['Date_create'] = time();
        $data['Name'] = mysql_escape_string($_POST['name']); 
        $data['Link'] = $_POST['link'];

        $d->setTable('slider');
        if ($d->insert($data)) {
            $id = mysql_insert_id();
                $d->setTable('slider');
                $d->setWhere('ID', $id);
                if ($d->update($data))
             transfer("Lưu dữ liệu thành công", "index.php?post=slider&action=media&slider_id=".$_POST['slider_id']);
        } else
            transfer("Lưu dữ liệu bị lỗi", "index.php?post=slider&action=media&slider_id=".$_POST['slider_id']);
    }
}

?>