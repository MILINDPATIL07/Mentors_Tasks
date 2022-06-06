
$(document).ready(function () {
    var $FNameLNameRegEx = /^([a-zA-Z]{2,20})$/;
    var $PasswordRegEx = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,12}$/;
    var $EmailIdRegEx = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,8}\b$/i;
    var nameflag = false, emailflag = false, passwordflag = false, hobbiesflag = false;
    
        
    $("#name").blur(function () {
        nameflag = false;
        $("#nameval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#nameval").html("(*) Name Required..!!");
            nameflag = false;
        }
        else {
            if (!$(this).val().match($FNameLNameRegEx)) {
                $("#nameval").html("(*) Invalid Name..!!");
                nameflag = false;
            }
            else {
                nameflag = true;
            }
        }
    });
   
    $("#email").blur(function () {
        emailflag = false;
        $("#emailval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#emailval").html("(*) Email Required..!!");
            emailflag = false;
        }
        else {
            if (!$(this).val().match($EmailIdRegEx)) {
                $("#emailval").html("(*) Invalid Email..!!");
                emailflag = false;
            }
            else {
                emailflag = true;
            }
        }
    });
   
    $("#password").blur(function () {
        passwordflag = false;
        $("#passwordval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#passwordval").html("(*) Password Required..!!");
            passwordflag = false;
        }
        else {
            if (!$(this).val().match($PasswordRegEx)) {
                $("#passwordval").html("(*) Invalid Password..!!");
                passwordflag = false;
            }
            else {
                passwordflag = true;
            }
        }
    });    
   
    $('#name').keypress(function (e) {
        $('#nameval').empty();
        var flag = false;
        (e.which >= 65 && e.which <= 90) || (e.which >= 92 && e.which <= 122)
            ? flag = true
            : (flag = false, $('#nameval').html('(*) Please Enter Valid Name..!'));
        return flag;
    });
    
    $('#Btnsubmit').click(function () {
       
        nameflag = false;
        $("#nameval").empty();
        if ($("#name").val() == "" || $("#name").val() == null) {
            $("#nameval").html("(*) Name Required..!!");
            nameflag = false;
        }
        else {
            if (!$("#name").val().match($FNameLNameRegEx)) {
                $("#nameval").html("(*) Invalid Name..!!");
                nameflag = false;
            }
            else {
                nameflag = true;
            }
        }
        emailflag = false;
        $("#emailval").empty();
        if ($("#email").val() == "" || $("#email").val() == null) {
            $("#emailval").html("(*) Email Required..!!");
            emailflag = false;
        }
        else {
            if (!$("#email").val().match($EmailIdRegEx)) {
                $("#emailval").html("(*) Invalid Email..!!");
                emailflag = false;
            }
            else {
                emailflag = true;
            }
        }
        passwordflag = false;
        $("#passwordval").empty();
        if ($("#password").val() == "" || $("#password").val() == null) {
            $("#passwordval").html("(*) Password Required..!!");
            passwordflag = false;
        }
        else {
            if (!$("#password").val().match($PasswordRegEx)) {
                $("#passwordval").html("(*) Invalid Password..!!");
                passwordflag = false;
            }
            else {  
                passwordflag = true;
            }
        }       

         hobbiesflag = false;
        $("#hobbiesval").empty();
        if ($("#hobbies").val() == "" ||  $("input[type='checkbox']:checked").length == 0) {
            //$("input.select:checked").length > 0
            $("#hobbiesval").html("(*) Please Select Atleast one checkbox ..!!");
            hobbiesflag = false;
        }
        else {
            hobbiesflag = true;
        }    
        
        if (nameflag == true && emailflag == true && passwordflag == true && hobbiesflag==true) {
           // alert("Form submitted successfully..!!");
            document.register.submit();
          
        } else {

            // alert("Form");
           // $('#error').html('(*) Please Enter Valid Input.');
        }
    });

});