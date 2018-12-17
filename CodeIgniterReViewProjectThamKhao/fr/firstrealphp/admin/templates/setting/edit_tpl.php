<div class="m-content">
<form name="frm" method="post" action="index.php?post=setting&action=save" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
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
                            Infomation Setting 
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->

                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control m-input" name="name" id="name" value="<?=$get_setting['Name']?>" placeholder="Enter name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="hotline">Hotline</label>
                        <input type="number" class="form-control m-input"  name="hotline" id="hotline" value="<?=$get_setting['Hotline']?>"  placeholder="Enter hotline">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control m-input" name="email" id="email" value="<?=$get_setting['Email']?>"  placeholder="Enter email">        
                    </div>
                    <div class="form-group m-form__group">
                        <label for="address">Address</label>
                        <textarea class="form-control m-input m-input--solid" name="address" id="address"  rows="3"><?=$get_setting['Address']?></textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="location">Maps Location</label>
                         <textarea class="form-control m-input m-input--solid" name="location" id="location" rows="5"><?=$get_setting['Location']?></textarea>
                       
                    </div>
                    <div class="form-group m-form__group">
                        <label for="logo">Logo</label>

                        <div style="width: 100%;"><img style="width: 100px;" src="<?=_upload_thumb.$get_setting['Logo']?>"></div><br>
                        <div class="custom-file">

                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        <span class="m-form__help"><?=_logo_file?></span>
                        </div>
                    </div> 
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                             
                            <div class="col-11">
                                <button type="button" onclick="js_submit()" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div><br><br>
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
                        <label for="title">Title</label>
                        <input type="text" class="form-control m-input m-input--square" name="title" id="title"  value="<?=$get_setting['Title']?>" placeholder="Enter Title">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="keywords">Keywords</label>
                        <textarea class="form-control m-input m-input--solid" name="keywords" id="keywords" rows="3"><?=$get_setting['Keywords']?></textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="description">Description</label>
                        <textarea class="form-control m-input m-input--solid" name="description" id="description" rows="3"><?=$get_setting['Description']?></textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="extension">Extension code Script</label>
                          <textarea class="form-control m-input m-input--solid" name="extension" id="extension" rows="4"><?=$get_setting['Extension']?></textarea>
                    </div>                     
                    <div class="form-group m-form__group">
                        <label for="favicon">Favicon</label>
                        <div style="width: 100%;"><img style="width: 100px;" src="<?=_upload_thumb.$get_setting['Favicon']?>"></div><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="favicon" name="favicon">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <span class="m-form__help"><?=_favicon_file?></span>
                        </div>
                    </div> 
                                      
                </div>
<div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                             
                            <div class="col-11">
                                <button type="button" onclick="js_submit()" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div><br><br>
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
                            Content Footer Left
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->

                <div class="m-portlet__body">

                    <div class="form-group m-form__group">
                    <textarea class="form-control m-input m-input--solid editor" name="content" id="content_1" rows="3"><?=$get_setting['Content']?></textarea>
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
                            Content Footer Center
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                    <textarea class="form-control m-input m-input--solid editor" name="content2" id="content_2" rows="3"><?=$get_setting['Content2']?></textarea>
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
                            Content Footer Right
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->

                <div class="m-portlet__body">

                    <div class="form-group m-form__group">
                    <textarea class="form-control m-input m-input--solid editor" name="content3" id="content_3" rows="3"><?=$get_setting['Content3']?></textarea>
                    </div>
                </div>
<div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                             
                            <div class="col-11">
                                <button type="button" onclick="js_submit()" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
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
 </script>