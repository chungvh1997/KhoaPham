<script type="text/javascript">
$(document).ready(function() {
initSwitch();   
});


	    function load_level($obj) {
        $id = $obj.val();
        if ($id != 0) {
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: { id: $id, action: "load_category"},
                success: function (data) {
                    $(".category").html(data);
                }
            })
        }
    }
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
function delete1(id) {
	                $.ajax({
                    type: "POST",
                    url: "ajax/ajax.php",
                    data: {id: id,action: "delete",table: "posts"},
                    success: function (data) {
                    if (data==1) { 
                    	$("#m_datatable").mDatatable().reload();
                    } 
                 
                    }
                })
}
</script>
 <div class="m-content">
<div class="row">    
<div class="col-xl-9">             
<div class="m-portlet m-portlet--mobile " style="width: 100%;margin: 0 auto;">
<div class="m-portlet__head">
                    <div class="m-portlet__head-caption" style="position: relative;">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                               CONTACT<small>LIST CONTACT</small>
                            </h3>
                        </div>
    
                    </div>
                </div>
    <div class="m-portlet__body">
<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-4">
                            <div class="m-form__group m-form__group--inline">
                                <div class="m-form__label">
                                    <label class="m-label m-label--single">Project:</label>
                                </div>
                                <div class="m-form__control">
                                    <div class="dropdown bootstrap-select form-control m-bootstrap-select">
                                    <select class="form-control m-bootstrap-select m_selectpicker" name="cat_id" id="cat_id" tabindex="-98" onchange="load_level($(this))">
                                    <option value="0">ALL</option> 
                                    <option value="1">Căn hộ</option>   
                                    <option value="2">Shophouse</option>   
                                    <option value="3">Nhà phố</option>   
                                    <option value="4">Biệt thự</option>   
                                    <option value="5">Dinh thự</option>   
                                    </select>
                                   </div>
                                </div>
                            </div>
                            <div class="d-md-none m--margin-bottom-10"></div>
                        </div>



                   
                    </div> 
                </div>
              <div class="col-xl-4 order-1 order-xl-2 m--align-right" style="">

                </div> 
            </div>
        </div>    
        <!--begin: Datatable -->
        <div class="m_datatable m-datatable m-datatable--default " id="m_datatable" style="">
    </div>
    </div>
</div>
</div>
<div class="col-xl-3">
   <div class="m-widget1" style="background: #fff">
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Contact</h3>
                <span class="m-widget1__desc">Total contact</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand"><?=count($total_contact)?></span>
            </div>
        </div>
    </div>
    <div class="m-widget1__item">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Posts</h3>
                <span class="m-widget1__desc">Total post</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-danger"><?=count($total_post)?></span>
            </div>
        </div>
    </div>
</div> 
</div>
</div>                    
</div>
<script type="text/javascript">
     
  var BootstrapSelect={init:function(){$(".m_selectpicker").selectpicker()}};
  jQuery(document).ready(function(){BootstrapSelect.init()});

</script>       
<script >
$(document).ready(function() {
ajaxload();    
});
    function ajaxload() {
              $('#cat_id').change(function(event) {
                  options = {
                          cat_id: $("#cat_id").val(), //'default/dropdown'                       
                      }
                      $("#m_datatable").mDatatable().search(
                          options , "cat_id"                        
                     );
              });
             
        $("#m_datatable").mDatatable({
            data: {
                type: "remote",
                source: {read: {url:"index.php?post=contact&action=data_lists"}},
                pageSize: 20,
                saveState: {cookie: false, webstorage: false},
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            rows: {
                afterTemplate: function (row, data, index) {
                initSwitch(); 

                
                }
            },            
            layout: {theme: "default", class: "", scroll: !1, height: 'auto', footer: !1},
            sortable: !0,
            filterable: !1,
            pagination: !0,
         
            columns: [
  
                {
                    field: "Fullname", title: "Full name", width: 200,
                    template: function (t) {
                        console.log(t)
                        return '<span style="width:200px;">' + t.Full_Name + "</span>"
                    }
                },            
                {
                    field: "Email", title: "Email", width: 200,
                    template: function (t) {
                     return `<span style="width:200px;">` + t.Email + `</span>`
                    }
                },
                {
                    field: "Phone", title: "Phone", width: 200,
                    template: function (t) {
                    	
                     return `<span style="width:200px;">` + t.Phone + `</span>`
                    }
                },               
                {
                    field: "Project", title: "Project", width: 200,
                    template: function (t) {
                       if (t.Cat_ID==1) {
                        canho="Căn hộ";
                       } else if(t.Cat_ID==2){
                            canho="Shophouse";
                       } else if(t.Cat_ID==3){
                            canho="Nhà phố";
                       } else if(t.Cat_ID==4){
                            canho="Biệt thự";
                       } else if(t.Cat_ID==5){
                            canho="Dinh thự";
                       }
                        return canho;
                    }
                },                                   
                {
                    field: "Date_create", title: "Date Create", width: 200,
                    template: function (t) {
                        if (t.Display==1) {a="checked"}else {a=""}
                     return `<span style="width:200px;">` + moment(t.Date_create*1000).format('D/M/YYYY h:mm:ss a') + `</span>`
                    }
                }                               
            ]
        })

  }        
</script> 
