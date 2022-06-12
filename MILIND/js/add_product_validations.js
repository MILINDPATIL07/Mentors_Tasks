$(document).ready(function () {
    // var $FNameLNameRegEx = /^([a-zA-Z]{2,20})$/;
    var $FNameLNameRegEx =/^([a-zA-Z/w/]{2,20})$/;

    var pnameflag = false, activeflag = false, categoryflag = false, imageflag = false;

    $("#pname").blur(function () {
        pnameflag = false
        $("#pnameval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#pnameval").html("(*) Product Name Required..!");
            pnameflag = false;
        }
        else {
            
                pnameflag = true;
        }
    });
    $("#category_id").blur(function () {
        categoryflag = false;
        $("#category_idval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#category_idval").html("(*) Please select atleast one category..!");
            categoryflag = false;
        }
        else {
            categoryflag = true;
        }
    });

    $("#active").blur(function () {
        activeflag = false;
        $("#activeval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#activeval").html("(*) Please select atleast one option..!");
            activeflag = false;
        }
        else {
            activeflag = true;
        }
    });

    $("#image").blur(function () {
        imageflag = false;
        $("#imageval").empty();
        if ($(this).val() == "" || $(this).val() == null) {
            $("#imageval").html("(*) Please Select a Image..!");
            imageflag = false;
        }
        else {
            imageflag = true;
        }
    });
    $('#pname').keypress(function (e) {
        $('#pnameval').empty();
        var flag = false;
        (e.which >= 65 && e.which <= 90) || (e.which >= 92 && e.which <= 122) || (e.which == 32) || (e.which >= 47 && e.which <= 57)
            ? flag = true
            : (flag = false, $('#pnameval').html('(*) Please Enter Valid Product Name..!'));
        return flag;
    });

    $('#Btnsubmit').click(function () {

        pnameflag = false;
        $("#pnameval").empty();
        if ($("#pname").val() == "") {
            $("#pnameval").html("(*) Product Name Required..!");
        } else {
            
                pnameflag = true;
            
        }
        categoryflag = false;
        $("#category_idval").empty();
        if ($("#category_id").val() == "" || $("#category_id").val() == null) {
            $("#category_idval").html("(*) Please select atleast one category..!");
            categoryflag = false;
        }
        else {
            categoryflag = true;
        }

        activeflag = false;
        $("#activeval").empty();
        if ($("#active").val() == "") {
            $("#activeval").html("(*)Please select atleast one option..!");
            activeflag = false;
        } else {
            activeflag = true;
        }

        imageflag = false;
        $("#imageval").empty();
        if ($("#image").val() == "" || $("#image").val() == null) {
            $("#imageval").html("(*) Please Select a Image..!");
            imageflag = false;
        }
        else {
            imageflag = true;
        }


        if (pnameflag == true && activeflag == true && imageflag == true && categoryflag == true) {
            // alert("Form submitted successfully..!");
            document.product.submit();
            // location.replace("process1.php")
        } else {
            // echo("Error to submit form..!!");
            //$('#error').html(alert('Please Enter Valid Input'));


        }
    });

});