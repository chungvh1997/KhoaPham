<script type="text/javascript">
$(document).ready(function() {
initSwitch();    
    $('#parent_id').change(function(event) {
        window.location = "index.php?post=category&action=man&level=<?= $_REQUEST["level"] ?>&parent_id=" + $(this).val();
        return true;        
    });
}); 
function initSwitch() {
        $(".switch-inputx").bootstrapSwitch({ offColor: 'danger', onSwitchChange: function (event, state) {
                $id = $(this).data('id');
                $action = $(this).data('action');
                $post = $(this).data('post');
                if ($(this).is(':checked')==true) {
                status=1;
                } else{
                status=0;
                }                  
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax.php",
                    data: {id: $id, action: $action, post: 'category',status: status},
                    success: function (data) {
                    }
                })
            }
        });
    }  
</script>
<div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption" style="position: relative;">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" >
                                Category <?=$_REQUEST['level']?><small>LIST CATEGORY</small>
                            </h3>
                        </div>
                        <a style="position: absolute;right: 20px;top: 12px;" href="index.php?post=category&action=add&level=<?=$_REQUEST['level']?>" title="New Category"  class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air" >
                        <span>
                            <i class="la la-cart-plus"></i>
                            <span>New Category</span>
                        </span>
                    </a>    
                    </div>
                </div>
    <div class="m-portlet__body">       
        <!--begin: Datatable -->
<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                <?php if ($_REQUEST["level"] != 1) { ?>    
                                    <div class="col-md-4">
                                        <div class="m-form__group m-form__group--inline">
                                            <div class="m-form__label">
                                                <label>
                                                Category
                                                </label>
                                            </div>
                                            <div class="m-form__control">
                                                <div class="dropdown bootstrap-select form-control m-bootstrap-select m-bootstrap-select--solid"><select class="form-control m-bootstrap-select m-bootstrap-select--solid m_selectpicker" name="parent_id" id="parent_id" >
                                                    <option value="0">All</option>
                                                    <?php foreach ($get_level1 as $key => $v1) {?>
                                                    <option value="<?=$v1['ID']?>"><?=$v1['Name']?></option>
                                                    <?php if ($_REQUEST["level"] - 1 > 1) { 
                                                    $d->reset();
                                                    $sql="select * from category where Parent_ID='" . $v1["ID"] . "'  order by Rank asc, ID DESC";   
                                                    $d->query($sql);
                                                    $get_level2=$d->result_array();
                                                    foreach ($get_level2 as $key => $v2) {                                                    
                                                    ?>
                                                    <option value="<?=$v2['ID']?>">---- <?=$v2['Name']?></option>
                                                    <?php }}} ?>
                                                </select>
                                               </div>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                <?php } ?>    
                                   
                                </div>
                            </div>
                        
                        </div>
                    </div>     
        <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded m-datatable--scroll" id="scrolling_vertical" >
        <table class="m-datatable__table" >
        <thead class="m-datatable__head">
        <tr class="m-datatable__row" >

        <th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 550px;">Name</span></th>

        <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Display</span>
        </th>
        <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Actions</span>
        </th>
        </tr>
        </thead>
        <tbody class="m-datatable__body ps ps--active-x ps--active-y catagory" style="max-height: 800px;overflow: scroll;">       
        <?php 
        foreach ($category as $key => $value) { 
         ?>    
        <tr data-row="" class="m-datatable__row" style="left: 0px;border-bottom:1px double #f7f6fa">
        <td class="m-datatable__cell--sorted m-datatable__cell" >
        <span style="width: 550px;">
        <?=$value['Name']?>
        </span>
        </td>
        <td  class="m-datatable__cell" >
        <span style="width: 110px;">
        <span class=""><label><input class="switch-inputx" data-action="display" data-post="category" data-id="<?=$value['ID']?>" <?php if ($value['Display']==1) {
           echo 'checked';
        } ?>  type="checkbox" name=""> <span></span></label></span>
        </span>
        </td>
        <td  class="m-datatable__cell">
        <span style="width: 110px;">
        <a target="b_lank" href="http://<?=$config_url?>/<?=$value['Link']?>" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill " title="View"><i class="la la-eye"></i></a>
        <a href="index.php?post=category&level=<?= $_REQUEST["level"] ?>&action=edit&id=<?=$value['ID']?>&id_list=<?=$value['Parent_ID']?>&parent_id=<?=$value['Set_level']?>" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill " title="Edit"><i class="la la-edit"></i></a>
        <a href="index.php?post=category&level=<?= $_REQUEST["level"] ?>&action=delete&id=<?=$value['ID']?>" class=" delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"  title="Delete"><i class="la la-trash"></i></a>
        </span>
        </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>

        </div>

                <!--end: Datatable -->
            </div>
        </div>             

