<?php
function get_main_list() {
        global $d;
        $d->reset();
        $sql = "select * from slider_cat order by Rank, ID desc";
        $d->query($sql);
        $rs_menu = $d->result_array();
        $str.='<div class="form-group m-form__group"><label for="exampleSelect1">Category 1</label><select class="form-control m-input m-input--air level" name="slider_id[]" data-level="1" id="level1" onchange="load_level($(this))">';
        $str.="<option value='0'>Select Slider</option>";
       
        foreach ($rs_menu as $v) {
            $str.='<option value="' . $v["ID"] . '" ';
            if ($v["ID"] == $_REQUEST['slider_id'])
                $str.='selected';
            $str.='>' . $v["Name"] . '</option>';
        }
        $str.='</select></div>';
        
        return $str;
    }
?>               
<div class="m-content">
<form name="frm" method="post" action="index.php?post=slider&action=save_media" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
<div class="row">
    <div class="col-md-6">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                         Add Slider
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
                <div class="m-portlet__body">
                   

                    <div class="form-group m-form__group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control m-input" name="name" id="name" value="<?=$get_post['Name']?>" placeholder="Enter name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="name">Link</label>
                        <input type="text" class="form-control m-input" name="link" id="link" value="<?=$get_post['Link']?>" placeholder="Enter Link">
                    </div>                 
                    <div class="form-group m-form__group">
                        <label for="logo">Picture</label>
                        <div style="width: 100%;"><img style="width: 100px;" src="<?=_upload_thumb.$get_post['Thumb']?>"></div><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumb" name="thumb">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        <span class="m-form__help"><?=_picture_post?></span>
                        </div>
                    </div> 
                    <div class="form-group m-form__group">
                        <label for="name">Rank</label>
                        <input style="width: 50px;" type="text" class="form-control m-input" name="rank" id="rank" value="<?=$get_post['Rank']?>" placeholder="">
                    </div>                   
                </div>
        </div>
        <!--end::Portlet-->

    </div>
    <div class="col-md-6">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                         Description
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
                <div class="m-portlet__body">

                    <div class="form-group m-form__group">
                        <label for="description">Description</label>
                        <textarea class="form-control m-input m-input--solid" name="description" id="description" placeholder="Enter description" rows="10"><?=$get_post['Description']?></textarea>
                    </div>                                      
                </div>
            <!--end::Form-->            
        </div>
        <!--end::Portlet-->


    </div>
</div>             
<div class="row">
    <div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
    
            

                
<div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                        <input type="hidden" name="slider_id" value="<?=$_REQUEST['slider_id']?>">
                            <input type="hidden" name="id" value="<?=$get_post['ID']?>">
                            <!--  <input type="hidden" name="display" value="<?=$get_post['Display']?>"> -->
                            <div class="col-11">
                                <button type="button" onclick="js_submit()" class="btn btn-success">Submit</button>
                                <button type="button" onclick="javascript:window.location = 'index.php?post=slider&action=media&slider_id=<?=$_REQUEST['slider_id']?>'" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div><br><br>
                    </div>
                </div>

            <!--end::Form-->            
        </div>
        <!--end::Portlet-->

    </div>

</div> 

</form>
 </div>
 <script type="text/javascript">
     function js_submit() {
        frm.submit();
     }
    $(document).ready(function () {
        load_level($(".level"));
    })
    function load_level($obj) {
        $level = $obj.data("level");
        $id = $obj.val();
        if ($id != 0) {
            $.ajax({type: "POST",
                url: "ajax/ajax.php",
                data: {max_level:<?= $level ?>, level: $level, id: $id, action: "load_level_sp", parent_id: "<?= $_REQUEST["parent_id"] ?>", id_sp: "<?= ($_REQUEST["id"] != '') ? $_REQUEST["id"] : '0' ?>"},
                success: function (data) {

                    $("#level" + ($level + 1)).html(data);
                }
            })
        }
    }
</script> 





