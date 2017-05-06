$(document).ready(function(){

    // Login action after clicking on login image
    $(document).on('click', '#sub_driver_registration', function() {
       var firstname=$('#driver_firstname').val(),
           middlename=$('#driver_middlename').val(),
           lastname=$('#driver_lastname').val(),
           email=$('#driver_email').val(),
           password=$('#driver_password').val(),
           conpassword=$('#driver_c_password').val(),
           csrf_form_name=$('input[name="csrf_form_name"]').val(),
           base_url=$('#base_url').val();
           error_flag=true;
        var $regexname=/^([a-zA-Z]{3,80})$/;
        var regxemail=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
        var passwordregx=/^(?=.*[A-Z].)(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/
        $('.error-input').removeClass('error-input');$('.error_div').find('error_message').remove();
        if(firstname=='')
        {
            $('#driver_firstname').addClass('error-input');
            $('#error_user_first_name').html("<div class='error_message'>First Name is Required</div>");
            error_flag=false;
        }else if(!firstname.match($regexname)){
            $('#driver_firstname').addClass('error-input');
            $('#error_user_first_name').html("<div class='error_message'>Only character allow</div>");
            error_flag=false;
        }
        if(middlename!='' && !middlename.match($regexname))
        {
            $('#driver_middlename').addClass('error-input');
            $('#error_driver_middlename').html("<div class='error_message'>Only character allow</div>");
            error_flag=false;
        }
        if(lastname=='')
        {
            $('#driver_lastname').addClass('error-input');
            $('#error_driver_lastname').html("<div class='error_message'>First Name is Required</div>");
            error_flag=false;
        }else if(!lastname.match($regexname)){
            $('#driver_lastname').addClass('error-input');
            $('#error_driver_lastname').html("<div class='error_message'>Only character allow</div>");
            error_flag=false;
        }
        if(email=='')
        {
            $('#driver_email').addClass('error-input');
            $('#error_driver_email').html("<div class='error_message'>Enter Email address</div>");
            error_flag=false;
        }else if(!email.match(regxemail)){
            $('#driver_email').addClass('error-input');
            $('#error_driver_email').html("<div class='error_message'>Enter valid Email address</div>");
            error_flag=false;
        }
        if(password=='')
        {
            $('#driver_password').addClass('error-input');
            $('#error_driver_password').html("<div class='error_message'>Password is required</div>");
            error_flag=false;
        }else if(password.length<8)
        {
            $('#driver_password').addClass('error-input');
            $('#error_driver_password').html("<div class='error_message'>Minimun 8 character required</div>");
            error_flag=false;
        }
        if(conpassword=='')
        {
            $('#driver_c_password').addClass('error-input');
            $('#error_driver_c_password').html("<div class='error_message'>Confirm password is required</div>");
            error_flag=false;
        }else if(password!=conpassword)
        {
            $('#driver_c_password').addClass('error-input');
            $('#error_driver_c_password').html("<div class='error_message'>Mismatch confirm password</div>");
            error_flag=false;
        }
        if (error_flag == false) 
        {   $('.error_message').fadeOut(15000).hide(0);         
            return false;
        }
        
        // ajax to check login data and if matched then redirect to dashboard page
        
        $.ajax({
            url: base_url + 'home/registration',
            type: 'POST',            
            data:{firstname:firstname,middlename:middlename,lastname:lastname,email:email,password:password,csrf_form_name:csrf_form_name} ,
            success: function(response) {                
                response=JSON.parse(response);
                
                if (response.responsecode == '200') {
                    $('#success').text(response.responsemessage).append('<i class="close small">x</i>').removeClass('hide');
                    $('#driver_firstname').val('');
                    $('#driver_middlename').val('');
                    $('#driver_lastname').val('');
                    $('#driver_email').val('');
                    $('#driver_password').val('');
                    $('#driver_c_password').val('');           
                } else {
                    $('#warning').text(response.responsemessage).append('<i class="close small">x</i>').removeClass('hide');
                }
            }
        });

    });
    $(document).on('click','.close',function(){
        $('#errorMsg,#success,#warning').hide();
    });
    $(document).on('click', '#login_btn', function() {        
        var username = $.trim($('#username').val()),
            password = $.trim($('#password').val()),
            csrftokenhash=$('input[name="csrf_form_name"]').val()
            error_found = 0,
            base_url = $('#base_url').val(),            
            request_data = {};
           
        // hide error message
        $('#errorMsg').hide();
        $('#password,#username').css('border-color', '#bfbfbf');
        // null validation
        $('#username, #password').css('border-color', ''); // remove border color at the time of login clicking
        if (username == '') {            
            $('#username').css('border-color', '#ff8080');
            error_found = 1;
        }
        if (password == '') {
            $('#password').css('border-color', '#ff8080');
            error_found = 1;
        }
        if (error_found == 1) 
        {
            $('#errorMsg').text("Username And Password are required").append('<i class="close">x</i>').css({'border':'1px solid #fcd1d1','padding':'2%','background-color': '#fff8f8','width':'100%',top:'0%','margin-bottom':'.1em','display':'block'}).animate({top: '30%'});
            return false;
        }

        // ajax to check login data and if matched then redirect to dashboard page
        request_data['username'] = username;
        request_data['password'] = password;
        if($('#loginremenberme').prop('checked')==true)
            request_data['loginremenberme']=1;
        else
            request_data['loginremenberme']=0;
        request_data['csrf_form_name'] = csrftokenhash;
        $.ajax({
            url: base_url + 'login/checklogin',
            type: 'POST',
            data: request_data,
            success: function(response) {                
                response=JSON.parse(response);
                
                if (response.responsecode == '200') {
                    location.href = base_url + response.responsedata.redirecturl;
                } else {
                    $('#username, #password').css('border-color', '#ff8080');
                    $('#errorMsg').text(response.responsemessage).append('<i class="close">x</i>').toggle().css({'border':'1px solid #fcd1d1','padding':'2%','background-color': '#fff8f8','width':'100%',top:'0%','margin-bottom':'.1em'}).animate({top: '30%'});
                }
            }
        });

    });
 $(document).on('click','#consubmit',function(){
     var fullname=$('#fullname').val(),           
           email=$('#conemail').val(),
           phoneno=$('#conphone').val(),
           conlocation=$('#conlocation').val(),
           conmessage=$('#conmessage').val(),
           csrf_form_name=$('input[name="csrf_form_name"]').val(),
           base_url=$('#base_url').val();
    var error_flag=true;
    var $regexname=/^([a-zA-Z ]{3,150})$/;
    var regxemail=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
    var phoneregx=/^[0-9]{10,11}$/
        $('.error_con_input').removeClass('error_con_input');$('.error_div').find('error_message').remove();
        if(fullname=='')
        {
            $('#fullname').addClass('error_con_input');
            $('#error_fullname').html("<div class='error_message'>Name is Required</div>");
            error_flag=false;
        }else if(!fullname.match($regexname)){
            $('#fullname').addClass('error_con_input');
            $('#error_fullname').html("<div class='error_message'>Only character allow</div>");
            error_flag=false;
        }
        
        if(email=='')
        {
            $('#conemail').addClass('error_con_input');
            $('#error_conemail').html("<div class='error_message'>Enter Email address</div>");
            error_flag=false;
        }else if(!email.match(regxemail)){
            $('#conemail').addClass('error_con_input');
            $('#error_conemail').html("<div class='error_message'>Enter valid Email address</div>");
            error_flag=false;
        }
        if(phoneno=='')
        {
            $('#conphone').addClass('error_con_input');
            $('#error_conphone').html("<div class='error_message'>Phone no is required</div>");
            error_flag=false;
        }else if(!phoneno.match(phoneregx))
        {
            $('#conphone').addClass('error_con_input');
            $('#error_conphone').html("<div class='error_message'>Only nunber allowed</div>");
            error_flag=false;
        }
        if(conlocation=='')
        {
            $('#conlocation').addClass('error_con_input');
            $('#error_conlocation').html("<div class='error_message'>Enter your location</div>");
            error_flag=false;
        }
        if(conmessage=='')
        {
            $('#conmessage').addClass('error_con_input');
            $('#error_conmessage').html("<div class='error_message'>Wrire your message</div>");
            error_flag=false;
        }
        if (error_flag == false) 
        {   $('.error_message').fadeOut(7000).hide(0);         
            return false;
        }
        
        // ajax to check login data and if matched then redirect to dashboard page
        
        $.ajax({
            url: base_url + 'home/contuctus',
            type: 'POST',            
            data:{fullname:fullname,email:email,phoneno:phoneno,conlocation:conlocation,conmessage:conmessage,csrf_form_name:csrf_form_name} ,
            success: function(response) {                
                response=JSON.parse(response);                
                if (response.responsecode == '200') {
                    $('#consuccess').text(response.responsemessage).append('<i class="close small">x</i>').removeClass('hide');
                    $('#fullname').val('');
                    $('#conemail').val('');
                    $('#conphone').val('');
                    $('#conlocation').val('');
                    $('#conmessage').val('');                    
                } else {
                    $('#conwarning').text(response.responsemessage).append('<i class="close small">x</i>').removeClass('hide');
                }
            }
        });
 });
});