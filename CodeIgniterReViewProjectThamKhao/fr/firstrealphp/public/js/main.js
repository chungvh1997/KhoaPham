 //select
 $('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;

    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());

    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);

    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }

    var $listItems = $list.children('li');

    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });

    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });

    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});
//contact

$("#Fomrcontact").validate({
    rules: {
        name: {
            required: !0
        },
        phone:{
            required: !0,
            number: true
        },
        email:{
            required: !0,
            email: true
        },
        

    },
    invalidHandler: function(e, r) {
        
      swal({
            title: "",
            text: "Các trường thông tin cần nhập bị sai. Xin vui lòng kiểm tra lại.",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
        })
    },
    submitHandler: function(e) {
        console.log( PATH +"addcontact");
        $.ajax({
            url: PATH +"addcontact",
            type: "post",
            dataType: "json",
            data:
            {
                name : $("#name").val(),
                phone : $('#phone').val(),
                email : $('#email').val(),
                canho : $('#canho').val(),
                content : $('#content').val()
            },
            success: function (response) {
                var res = (typeof response === 'object') ? response : JSON.parse(response);
                if(res.status == true){
                    swal({
                        title: "",
                        text: res.message,
                        type: "success",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                    })
                }else{
                    swal({
                        title: "",
                        text: "Gửi thất bại",
                        type: "error",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                    })
                }
            }
        });

    }
});