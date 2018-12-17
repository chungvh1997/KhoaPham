<?php
session_start();
@define('_source', '../sources/');
@define('_lib', '../lib/');
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
$action=$_POST["action"];
switch($action){
	case 'load_level':
		load_level();
		break;
	case 'load_category':
		load_category();
		break;
	case 'display':
		display();
		break;
	case 'load_level_sp':
		load_level_sp();
		break;	
	case 'delete':
		delete();
		break;						
}
function delete()
{
    global $d;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $d->reset();
        $sql = "select * from ".$table." where ID='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_thumb . $row['Thumb']);
            }
            $sql = "delete from ".$table." where ID='" . $id . "'";

              if ($d->query($sql)) {
              echo "1";
              }
        }

    }
}

function display()
{	global $d;
	$id=$_POST['id'];
	$table=$_POST['post'];
	$status=$_POST['status'];	
	$a=$d->query("UPDATE ".$table." SET Display=".$status." WHERE ID=".$id."");
   echo $a;
}
function load_level(){
	global $d;
	$Set_level=explode(",",$_POST["Set_level"]);
	$level=$_POST["level"]+1;
	$level_get=$_POST["level_get"];
	if($level<$level_get){
		$id=$_POST["id"];
		$d->reset();
		$sql="select * from category where Level='".$level."' and Parent_ID='".$id."' order by Rank ASC, ID DESC";
		$d->query($sql);
		$rs=$d->result_array();
		if($d->num_rows()>0){	
		$str='<div class="form-group m-form__group"><label for="exampleSelect1">Category '.$level.'</label><select class="form-control m-input m-input--air level'.$level.'" name="parent_id[]" data-level="'.$level.'" id="level1" onchange="load_level($(this))">';
		foreach ($rs as $key => $v) {
			$str.='<option value="'.$v["ID"].'" '; 
			if($v["ID"]==$Set_level[$level-1]) $str.="selected"; 
			$str.='> '.$v["Name"].'</option>';
		}
		$str.='</select><br /><div id="level'.($level+1).'" ></div>
		<script type="text/javascript">
		$(document).ready(function(){
			load_level($(".level'.$level.'"));
		})
		</script>';
		echo $str;
		}
	}
}
function load_category(){
	global $d;

		$id=$_POST["id"];
		$d->reset();
		$sql="select * from category where Level='2' and Parent_ID='".$id."' order by Rank ASC, ID DESC";
		$d->query($sql);
		$rs=$d->result_array();
		if($d->num_rows()>0){	
		$str='<div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__label">
                                                            <label>
                                                               Category:
                                                            </label>
                                                        </div>

                                                        <div class="m-form__control">
                                                <select class="form-control m-bootstrap-select m_selectpicker" id="category"><option value="0">ALL</option>';
		foreach ($rs as $key => $v) {
			$str.='<option value="'.$v["ID"].'">'.$v["Name"].'</option>  ';

		}
		$str.='</select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
     <script type="text/javascript">
     
  var BootstrapSelect={init:function(){$(".m_selectpicker").selectpicker()}};
  jQuery(document).ready(function(){BootstrapSelect.init()});
ajaxload();
</script> 


                                                    ';
		echo $str;
		}
	
}
function load_level_sp(){
	global $d;
	$id_parent=explode(",",$_POST["parent_id"]);
	$max_level=$_POST["max_level"];
	$level=$_POST["level"]+1;
	if($level<=$max_level){
		$id=$_POST["id"];
		$id_sp=$_POST["id_sp"];
		$d->reset();
		$sql="select * from category where Level='".$level."' and Parent_ID='".$id."' order by Rank, ID DESC";
		$d->query($sql);
		$rs=$d->result_array();
		if($d->num_rows()>0){
		$str='<div class="form-group m-form__group"><label for="exampleSelect1">Category '.$level.'</label><select class="form-control m-input m-input--air level'.$level.'" name="parent_id[]" data-level="'.$level.'" id="level1" onchange="load_level($(this))">';
		
		foreach($rs as $v){
			$str.='<option value="'.$v["ID"].'" '; if($v["ID"]==$id_parent[$level-1]) $str.="selected"; $str.='> '.$v["Name"].'</option>';
		}
		$str.='</select><br /><div id="level'.($level+1).'" ></div>
		<script type="text/javascript">
		$(document).ready(function(){
			load_level($(".level'.$level.'"));
		})
		</script>';
		echo $str;
		}
	}
}
?>