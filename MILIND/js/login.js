$(document).ready(function(){

    var $EmailIdRegEx = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,8}\b$/i;    
    var emailflag = false, passwordflag = false;

    $("#email").blur(function(){
        emailflag=false;
        $("#emailval").empty();
        if($(this).val()=="") 
        {
            $("#emailval").html("(*) Email Required..!!");
            emailflag = false;
        }
        else{
            if(!$(this).val().match($EmailIdRegEx)) 
            {
                $("#emailval").html("(*) Invalid Email..!!");
               emailflag= false;
            }
            else{
                emailflag=true;
            }
        }
    });

    $("#password").blur(function(){
        passwordflag=false;
        $("#passwordval").empty();
        if($(this).val()=="") 
        {
            $("#passwordval").html("(*) Password Required..!!");
        }
        else{
            // if(!$(this).val().match($PasswordRegEx)) 
            // {
            //     $("#passwordval").html("(*) Invalid Password..!!");
            // }
            // else{
                passwordflag=true;
            // }
        }
    });
    
    $("#btnsubmit").click(function(){
        //e.preventDefault();       
        $("#emailval").empty();
        if($("#email").val()=="") 
        {
            $("#emailval").html("(*) Email Required..!!");
            emailflag = false;
        }
        else{
            if(!$("#email").val().match($EmailIdRegEx)) 
            {
                $("#emailval").html("(*) Invalid email..!!");
                emailflag= false;
            }
            else{
                emailflag=true;
            }
        }
        passwordflag=false;
        $("#passwordval").empty();
        if($("#password").val()=="") 
        {
            $("#passwordval").html("(*) Password Required..!!");
            passwordflag = false;
        }
        else{
            // if(!$("#password").val().match($PasswordRegEx)) 
            // {
            //     $("#passwordval").html("(*) Invalid Password..!!");
            // }
            // else{
               passwordflag=true;
            // }
        }
        //return false;
        if(emailflag==true && passwordflag==true){
            //alert("Form submitted successfully..!!");
            document.register.submit();
        }
        else{
            //alert("Form not submitted");
           //document.login.error();
           
        }
        
    });
});


