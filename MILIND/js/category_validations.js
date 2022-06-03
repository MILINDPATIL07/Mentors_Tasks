
$(document).ready(function () {
    var $NameRegEx = /^([a-zA-Z]{2,20})$/; 
    var cnameflag = false, actionflag = false;

    $("#cname").blur(function () {
        cnameflag = false
        $("#cnameval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#cnameval").html("(*) Category Name Required..!!");
            cnameflag = false;
        }
        else {
            cnameflag = false
            if (!$(this).val().match($NameRegEx)) {
                $("#cnameval").html("(*) Invalid Category Name..!!");
                cnameflag = false;
            }
            else {
                cnameflag = true;
            }
        }
    });
    actionflag = false;
    $("#active").blur(function () {
        $("#activeval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#activeval").html("(*) Please Select Any..!!");
            actionflag = false;
        }
        else {
            actionflag = true;
        }
    });

    $('#cname').keypress(function (e) {
        $('#cnameval').empty();
        var flag = false;
        (e.which >= 65 && e.which <= 90) || (e.which >= 92 && e.which <= 122)
            ? flag = true
            : (flag = false, $('#cnameval').html('(*) Please Enter Valid Name..'));
        return flag;
    });

    $('#Btnsubmit').click(function () {
       // cnameflag = false;
        $("#nameval").empty();
        if ($("#cname").val() == "" || $("#cname").val() == null) {
            $("#nameval").html("(*) Category name Required..!!");
            cnameflag = false;
        }
        else {
            if (!$("#cname").val().match($NameRegEx)) {
                $("#nameval").html("(*) Invalid Category..!!");
                cnameflag = false;
            }
            else {
                cnameflag = true;
            }
        }
        actionflag = false;
        $("#activeval").empty();
        if ($("#active").val() == "" || $("#active").val() == null) {
            $("#activeval").html("(*) Please Select Any..!!");
            actionflag = false;
        }
        else {
            actionflag = true;
        }

 
   
        if (cnameflag == true && actionflag == true ) {
            // alert("Form submitted successfully..!!");
             document.category.submit();
             // location.replace("process1.php")
         } else {
 
             // alert("Form");
            // $('#error').html('(*) Please Enter Valid Input.');
         }
    
    });

});