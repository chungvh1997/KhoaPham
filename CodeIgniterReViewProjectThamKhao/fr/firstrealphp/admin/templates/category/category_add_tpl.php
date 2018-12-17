<?php
function get_main_list() {
        global $d;
        $d->reset();
        $sql = "select * from category where level=1 order by Rank, ID desc";
        $d->query($sql);
        $rs_menu = $d->result_array();
        $str.='<div class="form-group m-form__group"><label for="exampleSelect1">Category 1</label><select class="form-control m-input m-input--air level" name="parent_id[]" data-level="1" id="level1" onchange="load_level($(this))">';
        $str.="<option value='0'>Select Category 1</option>";
        foreach ($rs_menu as $v) {
            $str.='<option value="' . $v["ID"] . '" ';
            if ($v["ID"] == $_REQUEST['parent_id'])
                $str.='selected';
            $str.='>' . $v["Name"] . '</option>';
        }
        $str.='</select></div>';
        $str.='<div id="level2"></div>';
        return $str;
    }
?>               
<div class="m-content">
<form name="frm" method="post" action="index.php?post=category&action=save&level=<?=$_REQUEST['level']?>" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
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
                         Add Category
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
                <div class="m-portlet__body">
                    <?php if ($_REQUEST["level"] != 1) { ?><?= get_main_list() ?></br><?php } ?>

                    <div class="form-group m-form__group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control m-input" name="name" id="name" value="<?=$get_category['Name']?>" placeholder="Enter name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="logo">Picture</label>
                        <div style="width: 100%;"><img style="width: 100px;" src="<?=_upload_thumb.$get_category['Thumb']?>"></div><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumb" name="thumb">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        <span class="m-form__help"><?=_picture_category?></span>
                        </div>
                    </div> 
                    <div class="form-group m-form__group">
                        <label for="name">Rank</label>
                        <input style="width: 50px;" type="text" class="form-control m-input" name="rank" id="rank" value="<?=$get_post['Rank']?>" placeholder="Rank">
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
                          Seo
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label for="keywords">Keywords</label>
                        <textarea class="form-control m-input m-input--solid" name="keywords" id="keywords" rows="6" placeholder="Enter Keyword"><?=$get_category['Keywords']?></textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="description">Description</label>
                        <textarea class="form-control m-input m-input--solid" name="description" id="description" placeholder="Enter description" rows="6"><?=$get_category['Description']?></textarea>
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
             <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Content
                        </h3>
                    </div>
                </div>
            </div>
            

                <div class="m-portlet__body">

                    <div class="form-group m-form__group">
                    <textarea class="form-control m-input m-input--solid editor" name="content" id="content_1" rows="3"><?=$get_setting['Content']?></textarea>
                    </div>
                </div> 
<div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <input type="hidden" name="id" value="<?=$get_category['ID']?>">
                           <!--   <input type="hidden" name="display" value="<?=$get_category['Display']?>"> -->
                            <div class="col-11">
                                <button type="button" onclick="js_submit()" class="btn btn-success">Submit</button>
                                <button type="button" onclick="javascript:window.location = 'index.php?post=category&level=<?= $_REQUEST["level"] ?>&action=man'" class="btn btn-secondary">Cancel</button>
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
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: {level: $level, id: $id, action: "load_level", Set_level: "<?= $_REQUEST["parent_id"] ?>", level_get: "<?= $_REQUEST["level"] ?>"},
                success: function (data) {
                    $("#level" + ($level + 1)).html(data);
                }
            })
        }
    }
</script>