<?php
session_start();
if (!defined('_source'))
    die("Error");
$action = (isset($_REQUEST['action'])) ? addslashes($_REQUEST['action']) : "";

$id = $_REQUEST['id'];
switch ($action) {
    case "man":
        get_posts();
        $template = "contact/posts";
        break;
    case "add":
        $template = "contact/posts_add";
        break;
    case "edit":
      get_post();
        $template = "contact/posts_add";
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
    
        $cat_id = ! empty($datatable['query']['cat_id']['cat_id']) ? (int)$datatable['query']['cat_id']['cat_id'] : 0 ;



        $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';

        $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'ID';

        $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;

        $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $string_s="";
        if ($cat_id!="") {
              $string_s.="  and  Cat_ID=".$cat_id ." ";
        }
        $sql = "select * from contact where ID>0 ".$string_s;

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
        transfer("Không nhận được dữ liệu", "index.php?post=contact&action=man");
    $sql = "select * from contact where ID='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?post=contact&action=man");
    $get_post = $d->fetch_array();

}
function save_post() {
    global $d;

    $file_name = changeTitle($_POST['name']) .'-'. fns_Rand_digit(0, 9, 2);
    if (empty($_POST))
    transfer("Không nhận được dữ liệu", "index.php?post=contact&action=man");
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    //Phần chung  
    $data['Name'] = $_POST['name'];
    $data['Content'] = mysql_escape_string($_POST['content']);
    $data['Keywords'] = mysql_escape_string($_POST['keywords']);
    $data['Description'] = mysql_escape_string($_POST['description']);
    $data['Rank'] = $_POST['rank'];
    $data['Province_ID'] = $_POST['province'];
 //   $data['Display'] = isset($_POST['display']) ? 1 : 0;
    if ($id) { 
        $id = $_POST['id'];
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
            $d->setTable('contact');
            $d->setWhere('ID', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_thumb . $row['Thumb']);
            }
        }
        $data["Parent_ID"] = implode($_POST["parent_id"], ",");
        $data['Date_create'] = time();

        $d->reset();
        $sql_pro="select * from contact where Link='".changeTitle($_POST['name'])."' and ID <> '".$id."' ";
        $d->query($sql_pro);
        $name_pro=$d->result_array();
        $dem = count($name_pro);
        $d->reset();
        $sql_pro="select * from category where Link='".changeTitle($_POST['name'])."' ";
        $d->query($sql_pro);
        $name_pro_l=$d->result_array();
        $dem1 = count($name_pro_l);
        if($dem > 0 || $dem1 > 0 ){ 
            $data['Link'] = changeTitle($_POST['name']).'-'.substr(md5($id),1,6);
        }else{    
            $data['Link'] = changeTitle($_POST['name']);
        }

        $d->setTable('contact');
        $d->setWhere('ID', $id);
        if ($d->update($data)) {
        transfer("Cập nhật dữ liệu thành công", "index.php?post=contact&action=man&curPage=" . $_REQUEST['curPage'] . "");               
        } else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?post=contact&action=man");
    } else {
       
        if ($thumb = upload_image("thumb", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|GIF', _upload_thumb, $file_name)) {
            $data['Thumb'] = $thumb;
        }
        $data["Parent_ID"] = implode($_POST["parent_id"], ",");
        $data['Date_create'] = time();
        $data['Name'] = mysql_escape_string($_POST['name']); 
        $data['Link'] = changeTitle($_POST['name']);

        $d->setTable('contact');
        if ($d->insert($data)) {
            $id = mysql_insert_id();
            $d->reset();
            $sql_pro="select * from contact where Link='".changeTitle($_POST['name'])."' and id <> ".$id." ";
            $d->query($sql_pro);
            $name_pro=$d->result_array();
            $dem = count($name_pro);

            $d->reset();
            $sql_pro="select * from category where Link='".changeTitle($_POST['name'])."'";
            $d->query($sql_pro);
            $name_pro_l=$d->result_array();
            $dem1 = count($name_pro_l);


            if($dem > 0 || $dem1 > 0 ){ 
                $data['Link'] = changeTitle($_POST['name']).'-'.substr(md5($id),1,6);
            }
                $d->setTable('contact');
                $d->setWhere('ID', $id);
                if ($d->update($data)){}
             transfer("Lưu dữ liệu bị lỗi", "index.php?post=contact&action=man");
        } else
            transfer("Lưu dữ liệu bị lỗi", "index.php?post=contact&action=man");
    }
}
function delete_post() {
    global $d;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d->reset();
        $sql = "select * from contact where ID='" . $id . "'";
        $d->query($sql);

        if ($d->query($sql))
            transfer("Xóa dữ liệu thành công", "index.php?post=contact&action=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "index.php?post=contact&action=man");
    }
}

?>