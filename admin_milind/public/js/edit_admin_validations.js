$(document).ready(function() {
    $("#editForm").validate({
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

                hobbies: {
                    required: "Please select a hobbie",
                }
            }
        }
    });
});
