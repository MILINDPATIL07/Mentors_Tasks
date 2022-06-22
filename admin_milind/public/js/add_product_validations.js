$(document).ready(function () {
    $("#ProductForm").validate({
        rules: {
            pname: {
                required: true,
                maxlength: 20,
            },
            image: {
                required: true,
            },

            active: {
                required: true,
            },
        }
    });
});
