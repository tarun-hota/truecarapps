$(document).ready(function(){

    // Login action after clicking on login image
    $(document).on('click', '#login_btn', function() {
        var username = $.trim($('#username').val()),
            password = $.trim($('#password').val()),
            error_found = 0,
            base_url = $('#base_url').val(),
            csrftokenname = $('#csrf').attr('data-csrftokenname'),
            csrftokenhash = $('#csrf').attr('data-csrftokenhash'),
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
            $('#errorMsg').text("Username And Password are required").append('<i class="close">x</i>').toggle().css({'border':'1px solid #fcd1d1','padding':'2%','background-color': '#fff8f8','width':'100%',top:'0%','margin-bottom':'.1em'}).animate({top: '30%'});
            return false;
        }

        // ajax to check login data and if matched then redirect to dashboard page
        request_data['username'] = username;
        request_data['password'] = password;
        if($('#loginremenberme').prop('checked')==true)
            request_data['loginremenberme']=1;
        else
            request_data['loginremenberme']=0;
        request_data[csrftokenname] = csrftokenhash;
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
    $(document).on('click','.close',function(){
        $('#errorMsg').hide();
    });
    // Redirect after entering OTP
 
});