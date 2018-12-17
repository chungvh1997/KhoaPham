function logout(){
    $.ajax({
        url:PATH+"admin/logout",
        type:"get",
        dataType:"json",
        success:function(response){
            var res = (typeof response === 'object') ? response : JSON.parse(response);
            if(res.status == true){
                window.location.reload(true);
            }
        }
});//get public key
}
function checkonchange(is){
	
    type = is.getAttribute('data-skip');
       console.log(type)
       skip = true;
       switch(type){
           case 'length' : 
               skip = checklengthstr(is);
               break;
           case 'email' : 
               skip = checkemail(is);
               break;
           case 'number' : 
               skip = checknumber(is);
               break;
           default :
               break;
       }
       if (skip == false) { 
           return false; 
       }
   return skip;
}
function checkformaddbooking(){
    txt= document.querySelectorAll("[data-error]");
    for (var i = 0; i < txt.length; i++) {
        type = txt[i].getAttribute('data-skip');
        console.log(type)
        skip = true;
        switch(type){
            case 'length' : 
                skip = checklengthstr(txt[i]);
                break;
            case 'email' : 
                skip = checkemail(txt[i]);
                break;
            case 'number' : 
                skip = checknumber(txt[i]);
                break;
            default :
                break;
        }
        if (skip == false) { 
            return false; 
        }
    }
  return skip;
}
$(".number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
         // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
checklengthstr = function(is) {
    name= is.getAttribute("data-error");
    min = is.getAttribute('data-min');
    max = is.getAttribute('data-max');
    length = is.getAttribute('data-length');
    operator = is.getAttribute('data-operator');
    min = (min == '' || min == null) ? 0 : Number(min);
    max = (max == '' || max == null) ? 0 : Number(max);
    val = (is.value == '' || is.value == null) ? '' : is.value;
    length = (length == '' || length == null) ? 0 : Number(length);
    operator = (operator == '' || operator == null) ? ">=" : operator;
    skip = true;
    if (min == max && max == 0) {
        if (eval(val.length + operator + length) == false) {
            skip = false;
        }
    } else {
        lsdk = operator.split('|');
        lsdk = (lsdk.length > 1) ? lsdk : ['>=', '<='];
        if (eval(val.length + lsdk[0] + min) == true && eval(val.length + lsdk[1] + max) == true) {} else {
            skip = false;
        }
    }
    if (skip == false) {
        m= name+" không được để trống";
        messengererror(m)
        is.focus();
    }
    return skip;
}
checkemail = function(is) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var skip = true;
    if (re.test(is.value) == false) {
        is.setAttribute('class','borderErr form-controlep')
        is.focus();
        skip = false;
    }else{
        is.setAttribute('class','form-controlep form-icon')
   }
    return skip;
}
checknumber = function(is) {
    min =  is.getAttribute('data-min');
    max =  is.getAttribute('data-max');
    min = (min == '' || min == null) ? 0 : Number(min);
    max = (max == '' || max == null) ? 0 : Number(max);
    val = (is.value == '' || is.value == null) ? 0 : Number(is.value);
    skip = true;
    if (min == max && max == 0) {
        skip = false;
    } else {
        if (val < min || max < val) {
            skip = false;
        }
    }
    if (skip == false) {
        is.setAttribute('class','borderErr form-controlep form-icon')
        is.focus();
    }else{
		 is.setAttribute('class','form-controlep form-icon')
	}
    return skip;
}
function notifysuccess(mess){
    $.notify({
        title: '<strong>Success!</strong>',
        message: mess,
    },{
        type: 'success',
        z_index: 1101,
    });
    return true;
}
function messengererror(mess,idbtn){
    $.notify({
        title: '<strong>Error!</strong>',
        message: mess
    },{
        type: 'danger',
        z_index: 1101,
    });
   
    $(idbtn).prop('disabled', false);
    $(idbtn).removeClass( " m-loader m-loader--light m-loader--right" ); 
    return  a = false;
}