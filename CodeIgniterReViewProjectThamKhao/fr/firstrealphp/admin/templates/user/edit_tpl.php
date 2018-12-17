
<div class="m-portlet m-portlet--mobile">
     <div class="m-portlet__head">
                    <div class="m-portlet__head-caption" style="position: relative;">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" >
                                Admin <small>Infomation</small>
                            </h3>

                        </div>
 
                    </div>
                </div>
<div class="m-portlet__body">
<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <form name="frm" method="post" action="index.php?post=user&action=save" class="m-form m-form--fit m-form--label-align-right">
                        <div class="m-portlet__body">
                            

                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-2 col-form-label">Username</label>
                                <div class="col-7">
                                    <input class="form-control m-input" name="username" id="username" type="text" value="<?=$get_post['Username']?>">
                                </div>
                            </div>                           
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-2 col-form-label">Password</label>
                                <div class="col-7">
                                    <input class="form-control m-input" type="password" id="oldpassword" name="oldpassword" value="" required="">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-2 col-form-label">New Password</label>
                                <div class="col-7">
                                    <input class="form-control m-input" type="password" id="new_pass" name="new_pass" value="" required="">
                                </div>
                            </div>     
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-2 col-form-label">ReNew Password</label>
                                <div class="col-7">
                                    <input class="form-control m-input" type="password" id="renew_pass" name="renew_pass" value="" required="">
                                </div>
                            </div>                                                     
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                            <input type="hidden" name="id" value="1">
                                <button type="button" onclick="send_f()" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                    </form>
                </div>

            </div>
        </div>

</div>
</div>
<script language="javascript" src="public/media/scripts/my_script.js"></script>
<script language="javascript">
    function send_f() {
        if (isEmpty(document.frm.username, "Chưa nhập tên đăng nhập.")) {
            return false;
        }

        if (isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu cũ.")) {
            return false;
        }

        if (document.frm.new_pass.value.length < 5) {
            alert("Mật khẩu phải nhiều hơn 4 ký tự.");
            document.frm.new_pass.focus();
            return false;
        }

        if (document.frm.new_pass.value != document.frm.renew_pass.value) {
            alert("Nhập lại mật khẩu mới không chính xác.");
            document.frm.renew_pass.focus();
            return false;
        }
        frm.submit();

    }
</script>





