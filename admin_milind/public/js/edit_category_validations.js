
$(document).ready(function() {
    $("#cateditForm").validate({
        rules: {
            cname: {
                required: true,
                maxlength: 20,
            },                
        }
    });
});
