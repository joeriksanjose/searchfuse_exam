$().ready(function() {
    $("#formRegister").validate({
        errorClass: "text-danger",
        rules: {
            firstname: "required",
            lastname: "required",
            role: "required",
            username: {
                required: true,
                minlength: 5
            },
            pass: {
                required: true,
                minlength: 6
            },
            repass: {
                required: true,
                minlength: 6,
                equalTo: "#pass"
            }
        },
        messages: {
            firstname: "Enter your first name.",
            lastname: "Enter your last name.",
            username: {
                required: "Please provide a username.",
                minlength: "Username must be at least 5 characters long."
            },
            pass: {
                required: "Password is required.",
                minlength: "Password must be at least 6 characters long."
            },
            repass: {
                required: "Please retype your password.",
                minlength: "Password must be at least 6 characters long.",
                equalTo: "Password did not match."
            },
        }
    });
});