$(document).ready(function () {
    // show hide login box
    $('#show-login').click(function () {
        if ($(this).next().is(':visible')) {
            $(this).next().hide();
        }
        else {
            $(this).next().show();
            $('.login-form, .login-msg').show();
        }
    });

    // Show registration form.
    $('#join').click(function (e) {
        e.preventDefault();

        $('.register-form').show();
        $('.login-form').hide();
    });
});
