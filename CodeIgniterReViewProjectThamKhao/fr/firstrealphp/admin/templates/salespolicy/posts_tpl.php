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
                    data: {id: $id, action: $action, post: 'salespolicy',status: status},
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
                    data: {id: id,action: "delete",table: "salespolicy"},
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
<div class="m-portlet m-portlet--mobile " style="width: 100%;margin: 0 auto;">
<div class="m-portlet__head">
                    <div class="m-portlet__head-caption" style="position: relative;">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                               Sales Policy<small>LIST Sales Policy</small>
                            </h3>
                        </div>
                        <a style="position: absolute;right: 20px;top: 12px;" href="index.php?post=salespolicy&action=add" title="New Category" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-cart-plus"></i>
                            <span>New Sales Policy</span>
                        </span>
                    </a>    
                    </div>
                </div>
    <div class="m-portlet__body">
  
        <!--begin: Datatable -->
    <div class="m_datatable m-datatable m-datatable--default " id="m_datatable" >
    
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
              $('#menu').change(function(event) {
                  options = {
                          menu: $("#menu").val(), //'default/dropdown'                       
                      }
                      $("#m_datatable").mDatatable().search(
                          options , "category"                        
                     );
              });
              $('#category').change(function(event) {
                  options = {
                          category: $("#category").val(), //'default/dropdown'                       
                      }
                      $("#m_datatable").mDatatable().search(
                          options , "category"                        
                     );
              });              
        $("#m_datatable").mDatatable({
            data: {
                type: "remote",
                source: {read: {url:"index.php?post=salespolicy&action=data_lists"}},
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
                    field: "Rank", title: "Rank", width: 50,
                    template: function (t) {
                        console.log(t)
                        return `<div style="width:50px;text-align: center;"><b>`+t.Rank+`</b></div>`
                    }
                },  
                {
                    field: "Name", title: "Name", width: 200,
                    template: function (t) {
                        console.log(t)
                        return '<span style="width:200px;">' + t.Name + "</span>"
                    }
                },            
                {
                    field: "Picture", title: "Picture", width: 200,
                    template: function (t) {
                     return `<span style="width:200px;"><img style="width:100px;" src="<?=_upload_thumb?>` + t.Thumb + `" ></span>`
                    }
                },
                {
                    field: "Display", title: "Display", width: 200,
                    template: function (t) {
                    	if (t.Display==1) {a="checked"}else {a=""}
                     return `<span><label><input class="switch-inputx" data-action="display" data-post="salespolicy" data-id="`+t.ID+`" `+a+`  type="checkbox" name=""> <span></span></label></span>`
                    }
                },
                {
                    field: "Action", title: "Action", width: 300,
                    template: function (t) {
                        console.log(t)
                        return ` <span style="width: 110px;">
			        

			        <a href="index.php?post=salespolicy&action=edit&id=`+t.ID+`" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill " title="Edit"><i class="la la-edit"></i></a>
			        <a data-id=`+t.ID+` onclick="if (!confirm('Xác nhận xóa')) return false;
                        else
                            delete1(`+t.ID+`);" class=" delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"  title="Delete"><i class="la la-trash"></i></a>
			        </span>`;
                    }
                }                                   
                              
            ]
        })

  }        
</script> 
