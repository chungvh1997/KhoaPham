<?php

if (!defined('_lib'))
    die("Error");
#
#	$id_connect : ket noi database
function create_thumb($file, $width, $height,$folderpic,$folder, $file_name, $zoom_crop = '1') {

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

    $new_width = $width;
    $new_height = $height;

    if ($new_width && !$new_height) {
        $new_height = floor($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor($width * ($new_height / $height));
    }

    $image_url = $folderpic . $file;
    $origin_x = 0;
    $origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
    $array = getimagesize($image_url);
    if ($array) {
        list($image_w, $image_h) = $array;
    } else {
        die("NO IMAGE $image_url");
    }
    $width = $image_w;
    $height = $image_h;

// ACQUIRE THE ORIGINAL IMAGE
    $image_ext = trim(strtolower(end(explode('.', $image_url))));
    switch (strtoupper($image_ext)) {
    	case 'jpg' :
        	$image = imagecreatefromjpeg($image_url);
            $func = 'imagejpeg';
            break;
        case 'jpeg' :
        	$image = imagecreatefromjpeg($image_url);
            $func = 'imagejpeg';
            break;    
        case 'JPG' :
        	$image = imagecreatefromjpeg($image_url);
            $func = 'imagejpeg';
            break;
        case 'JPEG' :
            $image = imagecreatefromjpeg($image_url);
            $func = 'imagejpeg';
            break;
        case 'png' :
            $image = imagecreatefrompng($image_url);
            $func = 'imagepng';
            break;    
        case 'PNG' :
            $image = imagecreatefrompng($image_url);
            $func = 'imagepng';
            break;
        case 'gif' :
            $image = imagecreatefromgif($image_url);
            $func = 'imagegif';
            break;    
        case 'GIF' :
            $image = imagecreatefromgif($image_url);
            $func = 'imagegif';
            break;

        default : die("UNKNOWN IMAGE TYPE: $image_url");
    }

// scale down and add borders
    if ($zoom_crop == 3) {

        $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $new_width = $width * ($new_height / $height);
        } else {
            $new_height = $final_height;
        }
    }

    // create a new true color image
    $canvas = imagecreatetruecolor($new_width, $new_height);
    imagealphablending($canvas, false);

    // Create a new transparent color for image
    $color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);

    // Completely fill the background of the new image with allocated color.
    imagefill($canvas, 0, 0, $color);

    // scale down and add borders
    if ($zoom_crop == 2) {

        $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {

            $origin_x = $new_width / 2;
            $new_width = $width * ($new_height / $height);
            $origin_x = round($origin_x - ($new_width / 2));
        } else {

            $origin_y = $new_height / 2;
            $new_height = $final_height;
            $origin_y = round($origin_y - ($new_height / 2));
        }
    }

    // Restore transparency blending
    imagesavealpha($canvas, true);

    if ($zoom_crop > 0) {

        $src_x = $src_y = 0;
        $src_w = $width;
        $src_h = $height;

        $cmp_x = $width / $new_width;
        $cmp_y = $height / $new_height;

        // calculate x or y coordinate and width or height of source
        if ($cmp_x > $cmp_y) {

            $src_w = round($width / $cmp_x * $cmp_y);
            $src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
        } else if ($cmp_y > $cmp_x) {

            $src_h = round($height / $cmp_y * $cmp_x);
            $src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
        }

        // positional cropping!
        if ($align) {
            if (strpos($align, 't') !== false) {
                $src_y = 0;
            }
            if (strpos($align, 'b') !== false) {
                $src_y = $height - $src_h;
            }
            if (strpos($align, 'l') !== false) {
                $src_x = 0;
            }
            if (strpos($align, 'r') !== false) {
                $src_x = $width - $src_w;
            }
        }

        imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }



    $new_file = $file_name . '_' . $new_width . 'x' . $new_height . '.' . $image_ext;
// SHOW THE NEW THUMB IMAGE
    if ($func == 'imagejpeg')
        $func($canvas, $folder . $new_file, 90);
    else
        $func($canvas, $folder . $new_file, floor($quality * 0.09));

    return $new_file;
}
function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}
function thumb_image($file, $width, $height, $folder) {

    if (!file_exists($folder . $file))
        return false; // không tìm thấy file

    if ($cursize = getimagesize($folder . $file)) {
        $newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
        $info = pathinfo($file);

        $dst = imagecreatetruecolor($newsize[0], $newsize[1]);

        $types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
            'gif' => array('imagecreatefromgif', 'imagegif'),
            'png' => array('imagecreatefrompng', 'imagepng'));
        $func = $types[$info['extension']][0];
        $src = $func($folder . $file);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newsize[0], $newsize[1], $cursize[0], $cursize[1]);
        $func = $types[$info['extension']][1];
        $new_file = str_replace('.' . $info['extension'], '_thumb.' . $info['extension'], $file);

        return $func($dst, $folder . $new_file) ? $new_file : false;
    }
}

function day($s) {
    $arr = array("Mon" => "Thứ 2", "Tue" => "Thứ 3", "Wed" => "Thứ 4", "Thu" => "Thứ 5", "Fri" => "Thứ 6", "Sat" => "Thứ 7", "Sun" => "Chủ nhật");
    foreach ($arr as $k => $v) {
        if ($s == $k) {
            $kq = $v;
        }
    }
    return $kq;
}

function getday($day) {
    $day = date('d/M/y',$day);
    $laym = explode('/',$day);
    return $laym['0'];
}
function getmonth($day) {
    $day = date('d/M/y',$day);
    $laym = explode('/',$day);
    return $laym['1'];
}

function is_empty($s, $mes) {
    if ($s == '') {
        echo $mes;
    } else {
        echo $s;
    }
}

function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        } else if ($qs['vi']) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return false;
}

function isAjaxRequest() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        return true;
    return false;
}

function magic_quote($str, $id_connect = false) {
    if (is_array($str)) {
        foreach ($str as $key => $val) {
            $str[$key] = escape_str($val);
        }

        return $str;
    }

    if (is_numeric($str)) {
        return $str;
    }

    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }

    if (function_exists('mysql_real_escape_string') AND is_resource($id_connect)) {
        return mysql_real_escape_string($str, $id_connect);
    } elseif (function_exists('mysql_escape_string')) {
        return mysql_escape_string($str);
    } else {
        return addslashes($str);
    }
}

#
#	$id_connect : ket noi database
#

function escape_str($str, $id_connect = false) {
    if (is_array($str)) {
        foreach ($str as $key => $val) {
            $str[$key] = escape_str($val);
        }

        return $str;
    }

    if (is_numeric($str)) {
        return $str;
    }

    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }

    if (function_exists('mysql_real_escape_string') AND is_resource($id_connect)) {
        return "'" . mysql_real_escape_string($str, $id_connect) . "'";
    } elseif (function_exists('mysql_escape_string')) {
        return "'" . mysql_escape_string($str) . "'";
    } else {
        return "'" . addslashes($str) . "'";
    }
}

function make_date($time, $dot = '.', $lang = 'vi', $f = false) {

    $str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y", $time) : date("m{$dot}d{$dot}Y", $time);
    if ($f) {
        $thu['vi'] = array('Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy');
        $thu['en'] = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $str = $thu[$lang][date('w', $time)] . ', ' . $str;
    }
    return $str;
}

function alert($s) {
    echo '<script language="javascript"> alert("' . $s . '") </script>';
}

function upload_image($file, $extension, $folder, $newname = '') {
    if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {

        $ext = end(explode('.', $_FILES[$file]['name']));
        $name = basename($_FILES[$file]['name'], '.' . $ext);

        if (strpos($extension, $ext) === false) {
            alert('Chỉ hỗ trợ upload file dạng ' . $extension);
            return false; // không hỗ trợ
        }

        if ($newname == '' && file_exists($folder . $_FILES[$file]['name']))
            for ($i = 0; $i < 100; $i++) {
                if (!file_exists($folder . $name . $i . '.' . $ext)) {
                    $_FILES[$file]['name'] = $name . $i . '.' . $ext;
                    break;
                }
            } else {
            $_FILES[$file]['name'] = $newname . '.' . $ext;
        }

        if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
            if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                return false;
            }
        }
        return $_FILES[$file]['name'];
    }
    return false;
}



function setWidthHeight($width, $height, $maxWidth, $maxHeight) {
    $ret = array($width, $height);
    $ratio = $width / $height;
    if ($width > $maxWidth || $height > $maxHeight) {
        $ret[0] = $maxWidth;
        $ret[1] = $ret[0] / $ratio;
        if ($ret[1] > $maxHeight) {
            $ret[1] = $maxHeight;
            $ret[0] = $ret[1] * $ratio;
        }
    }
    return $ret;
}

function transfer($msg, $page = "index.php") {
    $showtext = $msg;
    $page_transfer = $page;
    include("./templates/transfer_tpl.php");
    exit();
}


function redirect($url = '') {
    echo '<script language="javascript">window.location = "' . $url . '" </script>';
    exit();
}

function back($n = 1) {
    echo '<script language="javascript">window.history.go("' . -intval($n) . '") </script>';
    exit();
}

function video_image($url) {
    $image_url = parse_url($url);
    if ($image_url['host'] == 'www.youtube.com' ||
            $image_url['host'] == 'youtube.com') {
        $array = explode("&", $image_url['query']);
        return "http://img.youtube.com/vi/" . substr($array[0], 2) . "/0.jpg";
    } else if ($image_url['host'] == 'www.youtu.be' ||
            $image_url['host'] == 'youtu.be') {
        $array = explode("/", $image_url['path']);
        return "http://img.youtube.com/vi/" . $array[1] . "/0.jpg";
    } else if ($image_url['host'] == 'www.vimeo.com' ||
            $image_url['host'] == 'vimeo.com') {
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" .
                        substr($image_url['path'], 1) . ".php"));
        return $hash[0]["thumbnail_medium"];
    }
}

function chuanhoa($s) {
    $s = str_replace("'", '&#039;', $s);
    $s = str_replace('"', '&quot;', $s);
    $s = str_replace('<', '&lt;', $s);
    $s = str_replace('>', '&gt;', $s);
    return $s;
}

function dump($arr, $exit = 1) {
    echo "<pre>";
    var_dump($arr);
    echo "<pre>";
    if ($exit)
        exit();
}

function paging($r, $url = '', $curPg = 1, $mxR = 5, $mxP = 5, $class_paging = '') {
    if ($curPg < 1)
        $curPg = 1;
    if ($mxR < 1)
        $mxR = 5;
    if ($mxP < 1)
        $mxP = 5;
    $totalRows = count($r);
    if ($totalRows == 0)
        return array('source' => NULL, 'paging' => NULL);
    $totalPages = ceil($totalRows / $mxR);
    if ($curPg > $totalPages)
        $curPg = $totalPages;

    $_SESSION['maxRow'] = $mxR;
    $_SESSION['curPage'] = $curPg;

    $r2 = array();
    $paging = "";

    //-------------tao array------------------
    $start = ($curPg - 1) * $mxR;
    $end = ($start + $mxR) < $totalRows ? ($start + $mxR) : $totalRows;
    #echo $start;
    #echo $end;

    $j = 0;
    for ($i = $start; $i < $end; $i++)
        $r2[$j++] = $r[$i];

    //-------------tao chuoi------------------
    $curRow = ($curPg - 1) * $mxR + 1;
    if ($totalRows > $mxR) {
        $start = 1;
        $end = 1;
        $paging1 = "";
        for ($i = 1; $i <= $totalPages; $i++) {
            if (($i > ((int) (($curPg - 1) / $mxP)) * $mxP) && ($i <= ((int) (($curPg - 1) / $mxP + 1)) * $mxP)) {
                if ($start == 1)
                    $start = $i;
                if ($i == $curPg) {
                    $paging1.=" <span>" . $i . "</span> "; //dang xem
                } else {
                    $paging1 .= " <a href='" . $url . "&curPage=" . $i . "'  class=\"{$class_paging}\">" . $i . "</a> ";
                }
                $end = $i;
            }
        }//tinh paging
        //$paging.= "Go to page :&nbsp;&nbsp;" ;
        #if($curPg>$mxP)
        #{
        $paging .=" <a href='" . $url . "' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
        #$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
        $paging .=" <a href='" . $url . "&curPage=" . ($curPg - 1) . "' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
        #}
        $paging.=$paging1;
        #if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
        #{
        #$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
        $paging .=" <a href='" . $url . "&curPage=" . ($curPg + 1) . "' class=\"{$class_paging}\" >&#8250;</a> "; //ke

        $paging .=" <a href='" . $url . "&curPage=" . ($totalPages) . "' class=\"{$class_paging}\" >... " . $totalPages . "</a> "; //ve cuoi
        #}
    }
    $r3['curPage'] = $curPg;
    $r3['source'] = $r2;
    $r3['paging'] = $paging;
    #echo '<pre>';var_dump($r3);echo '</pre>';
    return $r3;
}

function paging_home($r, $url = '', $curPg = 1, $mxR = 5, $mxP = 5, $class_paging = '') {
    if ($curPg < 1)
        $curPg = 1;
    if ($mxR < 1)
        $mxR = 5;
    if ($mxP < 1)
        $mxP = 5;
    $totalRows = count($r);
    if ($totalRows == 0)
        return array('source' => NULL, 'paging' => NULL);
    $totalPages = ceil($totalRows / $mxR);




    if ($curPg > $totalPages)
        $curPg = $totalPages;

    $_SESSION['maxRow'] = $mxR;
    $_SESSION['curPage'] = $curPg;

    $r2 = array();
    $paging = "";

    //-------------tao array------------------
    $start = ($curPg - 1) * $mxR;
    $end = ($start + $mxR) < $totalRows ? ($start + $mxR) : $totalRows;
    #echo $start;
    #echo $end;

    $j = 0;
    for ($i = $start; $i < $end; $i++)
        $r2[$j++] = $r[$i];

    //-------------tao chuoi------------------
    $curRow = ($curPg - 1) * $mxR + 1;
    if ($totalRows > $mxR) {

        $from = $curPg - $mxP;
        $to = $curPg + $mxP;
        if ($from <= 0) {
            $from = 1;
            $to = $mxP * 2;
        }
        if ($to > $totalPages) {
            $to = $totalPages;
        }
        for ($j = $from; $j <= $to; $j++) {
            if ($j == $curPg)
                $links = $links . "<a class=\"paginate_active\">{$j}</a>";
            else {
                $qt = $url . "&amp;p={$j}";
                $links = $links . "<a class=\"paginate_button\" href = '{$qt}'>{$j}</a>";
            }
        } //for
        //$paging.= "Go to page :&nbsp;&nbsp;" ;
        if ($curPg > $mxP) {
            $paging .=" <a style='cursor:pointer' href='" . $url . "' class=\"first paginate_button\" >&laquo;</a> "; //ve dau				
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($curPg - 1) . "' class=\"previous paginate_button\" >&#8249;</a> "; //ve truoc
        } else {
            $paging .=" <a style='cursor:pointer' href='" . $url . "' class=\"first paginate_button paginate_button_disabled\" >&laquo;</a> "; //ve dau				
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($curPg - 1) . "' class=\"previous paginate_button paginate_button_disabled\" >&#8249;</a> "; //ve truoc
        }
        $paging.=$links;
        if (((int) (($curPg - 1) / $mxP + 1) * $mxP) < $totalPages) {
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($curPg + 1) . "' class=\"next paginate_button\" >&#8250;</a> "; //ke				
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($totalPages) . "' class=\"last paginate_button\" >&raquo;</a> "; //ve cuoi
        } else {
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($curPg + 1) . "' class=\"next paginate_button paginate_button_disabled\" >&#8250;</a> "; //ke				
            $paging .=" <a style='cursor:pointer' href='" . $url . "&amp;p=" . ($totalPages) . "' class=\"last paginate_button paginate_button_disabled\" > ... " . $totalPages . "</a> "; //ve cuoi
        }
    }
    $r3['curPage'] = $curPg;
    $r3['source'] = $r2;
    $r3['paging'] = $paging;
    $r3['totalRows'] = $totalRows;
    #echo '<pre>';var_dump($r3);echo '</pre>';
    return $r3;
}

function stripUnicode($str) {
    if (!$str)
        return false;
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ',
        'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}

// Doi tu co dau => khong dau
function delete_file($file) {
    return @unlink($file);
}
function changeTitle($str) {
    $str = stripUnicode($str);
    $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
    $str = trim($str);
    $str = preg_replace('/[^a-zA-Z0-9\ ]/', '', $str);
    $str = str_replace("  ", " ", $str);
    $str = str_replace(" ", "-", $str);
    return $str;
}


function getCurrentPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    $pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}

?>