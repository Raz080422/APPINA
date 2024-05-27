(function(){
    $.ajaxSetup({
        timeout: 60000,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(){
            // loading();
        },
        complete: function(){
            // clearLoading();
        },
        error: function (x, e) {
            var msg = '';
            if (x.status == 0) {
                msg = 'Request Aborted!';
            } else if (x.status == 404) {
                msg = 'Page Not Found!';
            } else if (x.status == 500) {
                msg = 'Internal Server Error!';
            } else if (e == 'parsererror') {
                msg = 'Error.\nParsing JSON Request failed!';
            } else if (e == 'timeout') {
                msg = 'Request Timeout!';
            } else if (x.status == 401) {
                msg = 'Authentication Timeout!';
                window.location = base_url + '/logout';
            } else if (x.status == 419) {
                msg = 'Token Mismatch, Authentication Timeout!';
                window.location = base_url + '/logout';
            } else {
                msg = 'Error tidak diketahui: \n' + x.responseText;
            }
            
            swal('', msg, 'error');
        }
    });
})();

function loading()
{
    $('.page-loader').show();
}

function clearLoading()
{
    $('.page-loader').delay(1000).fadeOut(500);
}

function inputLoading(elm)
{
    var loading = '<img id="input_loading" src="'+base_url+'/assets/front/img/theme/facebook.gif">';
    elm.closest('.form-group').next().find('select').hide();
    if(elm.closest('.form-group').next().find('div').length > 0)
        elm.closest('.form-group').next().find('div').append(loading);
    else
        elm.closest('.form-group').next().append(loading);
}

function clearInputLoading(elm)
{
    elm.closest('.form-group').next().find('#input_loading').remove();
    elm.closest('.form-group').next().find('select').show();
}


function input_validator(id){
    var err = 0;
    $('#'+id).find(':input').each(function(){
        var elm = $(this);
        var div = $(this).closest('div').html();
        var label = '<span class="text-danger form-text m-b-none">This value is required.</span>';
        elm.closest('div').removeClass('has-error');
      //  elm.closest('div').append('<span></span>');
      //  elm.closest('div').find('span').hide();
       // console.log('asd');
        if(elm.val().trim() === '')
        {
            if(elm.attr('required'))
            {
                if (elm.is('select')) {
                    
                }
                else {

                    console.log( elm.closest('div').find('span').length+' -');
                    elm.closest('div').addClass('has-error');
                    if( elm.closest('div').find('span').length == 0 ){
                        elm.closest('div').html(div + label);
                    }
                }
                err++;
            }
        }
        // else {
        //     elm.closest('div').find('span').hide();
        //     if(elm.attr('type') == 'email')
        //     {
        //         if(!validateEmail(elm.val()))
        //         {
        //             elm.closest('div').addClass('has-error');
        //             err++;
        //         }
        //     }
        // }
    });

   
    $('#'+id).find('select').each(function(){

        var elm = $(this);
        var div = $(this).closest('div').html();
        var label = '<span class="text-danger form-text m-b-none">This value is required.</span>';
        
        if(elm.val().trim() == '0' || elm.val().trim() == '' )
        {
            if(elm.attr('required'))
            {
               
                elm.closest('div').parent().closest('div').find('.label-error').html(label);
             
                
                err++;
            }
        }
    });



    if(err > 0)
        return response = {fail:true};
    else
        return response = {fail:false};
}

function remove_error(form_id){
    var err = 0;
    $('#'+form_id).find(':input').each(function(){
        var elm = $(this);
        var div = $(this).closest('div').html();

        elm.closest('div').removeClass('has-error');
        elm.closest('div').find('span').hide();
    });
}

function show_error(id, message){
    var elm = $('#'+id);
    var div = elm.closest('div').html();
    var label = '<span class="text-danger form-text m-b-none">'+ message +'</span>';

    elm.closest('div').addClass('has-error');
    elm.closest('div').html(div + label);
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function loadingbar(id)
{
    var loading_img = '<img id="input_loading" src="'+base_url+'/loader/facebook2.gif">'
    $('#'+id).show().html(loading_img);
}

function closeLoadingbar(id)
{
    $('#'+id).hide();
}

function ThausandSeperator(hidden, value, digit = 4) {
    var thausandSepCh = ",";
    var decimalSepCh = ".";
    var tempValue = "";
    var realValue = value + "";
    var devValue = "";
    if (digit == "")
        digit = 3;
    realValue = characterControl(realValue);
    var comma = realValue.indexOf(decimalSepCh);
    if (comma != -1) {
        tempValue = realValue.substr(0, comma);
        devValue = realValue.substr(comma);
        devValue = removeCharacter(devValue, thausandSepCh);
        devValue = removeCharacter(devValue, decimalSepCh);
        devValue = decimalSepCh + devValue;
        if (devValue.length > digit) {
            devValue = devValue.substr(0, digit + 1);
        }
    } else {
        tempValue = realValue;
    }
    tempValue = removeCharacter(tempValue, thausandSepCh);
    var result = "";
    var len = tempValue.length;
    while (len > 3) {
        result = thausandSepCh + tempValue.substr(len - 3, 3) + result;
        len -= 3;
    }
    result = tempValue.substr(0, len) + result;
    if (hidden != "") {
        $("#" + hidden).val(tempValue + devValue);
    }
    
    return result + devValue;
}

function characterControl(value) {
    var tempValue = "";
    var len = value.length;
    for (i = 0; i < len; i++) {
        var chr = value.substr(i, 1);
        if ((chr < '0' || chr > '9') && chr != '.' && chr != ',') {
            chr = '';
        }
        tempValue = tempValue + chr;
    }
    return tempValue;
}

function removeCharacter(v, ch) {
    var tempValue = v + "";
    var becontinue = true;
    while (becontinue == true) {
        var point = tempValue.indexOf(ch);
        if (point >= 0) {
            var myLen = tempValue.length;
            tempValue = tempValue.substr(0, point) + tempValue.substr(point + 1, myLen);
            becontinue = true;
        } else {
            becontinue = false;
        }
    }
    return tempValue;
}

function show_password(id, id_icon, id_div, show){
    var password = $('#' + id);
    var icon = $('#' + id_icon);
    var div = $('#' + id_div);

    if (show) {
        password.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
        div.attr('onclick', 'show_password("'+ id +'", "'+ id_icon +'", "'+ id_div +'", false)');
    }
    else {
        password.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
        div.attr('onclick', 'show_password("'+ id +'", "'+ id_icon +'", "'+ id_div +'", true)');
    }
}


function input_uppercase(id, val){
    var uppercase = val.toUpperCase();
    $('#'+id).val(uppercase);
}

function isNumber(e) {
    var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
    var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode == 45));
    return ret;
}


$.fn.serializeFormJSON = function () {

    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function replace_point(value){
    var replace_value = value.toString().replace(/\./g, ',');
    return replace_value;
}