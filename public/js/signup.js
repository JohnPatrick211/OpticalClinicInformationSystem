$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    
    $('#btn-signup').click(function(){

        var firstname = $('#firstname').val();
        var middlename = $('#middlename').val();
        var lastname = $('#lastname').val();
        var phone_no = $('#phone_no').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var houseno = $('#houseno').val();
        var street = $('#street').val();
        var barangay = $('#barangay').val();
        var city = $('#city').val();
        var province = $('#province').val();
        var username = $('#username').val();
        var age = $('#age').val();
        var birthdate = $('#birthdate').val();
        var gender = $('#gender').val();
        var civilstatus = $('#civilstatus').val();
        var validid = $('#validid').prop('files')[0];
        var form = new FormData();
        form.append('firstname',firstname);
        form.append('middlename',middlename);
        form.append('lastname',lastname);
        form.append('phone_no',phone_no);
        form.append('password',password);
        form.append('email',email);
        form.append('houseno',houseno);
        form.append('street',street);
        form.append('barangay',barangay);
        form.append('city',city);
        form.append('province',province);
        form.append('username',username);
        form.append('validid',validid);
        form.append('age',age);
        form.append('birthdate',birthdate);
        form.append('gender',gender);
        form.append('civilstatus',civilstatus);


        var is_valid = validateInputs(firstname, lastname, phone_no, password,email,houseno, street, barangay, city, province,username,age,gender,birthdate);
        
        if(is_valid){
            signUp(form);
        }
      
    });

    function validateInputs(firstname, lastname, phone_no, password,email,houseno, street, barangay, city, province,username,age,gender,birthdate) {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var phone_no = $('#phone_no').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        var email = $('#email').val();
        var houseno = $('#houseno').val();
        var street = $('#street').val();
        var barangay = $('#barangay').val();
        var city = $('#city').val();
        var province = $('#province').val();  
        var username = $('#username').val();

        if(birthdate == '' || gender == '' || age == '' || firstname == '' || lastname == '' || phone_no == '' || password == '' || email == '' || houseno == '' || street == '' || barangay == '' || city == '' || province == '' || username == ''){
            alert('Please input all of your credentials!');
        }
        else{
            return validatePassword(password, confirm_password);        
        }
         
    }

    function validatePassword(password, confirm_password) {
        if(password.replace(/ /g,'').length >= 6){
            if(password == confirm_password){
                return true;
            }
            else{
                alert('Password do not match!');
            }
        }
        else{
            alert('Minimum of 8 characters!')
        }
    }

   

    $('#phone_no').blur(function() {
        var phone_no = $('#phone_no').val();
        isPhoneNumberExists(phone_no.replace(/\s/g, ''));
    });

    function isPhoneNumberExists(phone_no) {
        $.ajax({
            url:"/signup/isexists",
            type:"GET",
            data:{
                phone_no:phone_no
            },
            success:function(response){
             
             setTimeout(function() {
                if(isPhoneNoValid(phone_no) == true)
                {
                    if(response == '1')
                    {
                        $("#pn-validation").remove();
                        $('#phone_no')
                        .after('<span class="label-small text-danger" id="pn-validation">Phone number is already exists.</div>');
                        $('#phone_no').val('');
                    }
                    else{
                        $("#pn-validation").remove();
                    }
                  }
             },500);
              
            }         
           })
    }

    function isPhoneNoValid(phone_no) {
        if(phone_no){
            if(phone_no.replace(/ /g,'').length > 11 || phone_no.replace(/ /g,'').length < 10){
                $("#pn-validation").remove();
                $('#phone_no')
                .after('<span class="label-small text-danger" id="pn-validation">Please enter a valid phone number.</div>');
                return false
            }
            else{
                $("#pn-validation").remove();
                return true;
            }
        }
        else{
            $("#pn-validation").remove();
            $('#phone_no')
            .after('<span class="label-small text-danger" id="pn-validation">Please enter your phone number.</div>');
        }
    }

    $('#send-OTP').click(function() {
        var phone_no = $('#phone_no').val().replace(/^0+/, ''); //remove leading zeros
        console.log(phone_no);
        sendOTP(phone_no);
      // setTimer();
    });

    function sendOTP(phone_no){
       if(isPhoneNoValid(phone_no)){
        if(phone_no){
            $.ajax({
                url:"/signup/send-OTP",
                type:"GET",
                data:{
                   phone_no:phone_no
                },
                success:function(){
                    setTimer();
                }         
               });
        }
       }

    }

    function setTimer(){
        $('#send-OTP').css('display', 'none');
        var timer2 = "0:30";
        var interval = setInterval(function() {
        
          var timer = timer2.split(':');
          //by parsing integer, I avoid all extra string processing
          var minutes = parseInt(timer[0], 10);
          var seconds = parseInt(timer[1], 10);
          --seconds;
          minutes = (seconds < 0) ? --minutes : minutes;
          if (minutes < 0) clearInterval(interval);
          seconds = (seconds < 0) ? 59 : seconds;
          seconds = (seconds < 10) ? '0' + seconds : seconds;
          //minutes = (minutes < 10) ?  minutes : minutes;
          $('.countdown').text('Resend OTP in ' + minutes + ':' + seconds);
          timer2 = minutes + ':' + seconds;

          if(seconds == 0){
              minutes = 0;
              seconds = 0;
            $('.countdown').css('display', 'none');
            $('#send-OTP').css('display', 'inline');
            $('#send-OTP').text('Resend OTP');
          }
        }, 1000);
    }


    $('#otp').blur(function() {
         var otp = $(this).val();
         validateOTP(otp);
    });

    function validateOTP(otp){
        if(otp){
            $.ajax({
                url:"/signup/validate-otp/"+otp,
                type:"GET",
                success:function(response){
                    if(response == '1'){
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-success" id="pn-validation">OTP is valid.</div>');
                    }
                    else{
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-danger" id="pn-validation">OTP is invalid.</div>');
                    }
                }         
               });
        }
    }

    function signUp(form) {
        var otp = $('#otp').val();
        if(otp){
            $.ajax({
                url:"/signup/validate-otp/"+otp,
                type:"GET",
                success:function(response){
                    if(response == '1'){
                        $.ajax({
                            url:"/signup/signup",
                            type:"POST",
                            data:form,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                $('#loading-modal').modal('toggle');
                            },
                            success:function(){
                                $('#alert-acc-success').css('display', 'block');
                                $('#alert-acc-success').addClass('alert-success');
                                $('#alert-acc-success')
                                .html('You have successfully created your account!');
                                window.location.href = "/login";
                            }         
                           });   
                    }
                    else{
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-danger" id="pn-validation">OTP is invalid.</div>');
                    }
                }         
               });
        }
           
       
    }



});