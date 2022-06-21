
$(document).ready(function() {
    $("#catregForm").validate({
        rules: {
            cname: {
                required: true,
                maxlength: 20,
            },                
        }
    });
});
