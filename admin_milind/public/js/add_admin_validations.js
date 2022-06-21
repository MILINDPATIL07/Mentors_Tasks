
$(document).ready(function() {
    $("#regForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 20,
            },

            email: {
                required: true,
                email: true,
                maxlength: 50
            },

            password: {
                required: true,
                minlength: 5
            },

            hobbies: {
                required: true,
            },
            messages: {
                name: {
                    required: "Admin Name is Required",
                    maxlength: "First name cannot be more than 20 characters"
                },

                email: {
                    required: "Email is required",
                    email: "Email must be a valid email address",
                    maxlength: "Email cannot be more than 10 characters",
                },

                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 5 characters"
                },
                hobbies: {
                    required: "Please select a hobbie",
                }
            }
        }
    });
});
