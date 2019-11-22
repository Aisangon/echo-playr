$(function() {
    $('#registerForm').hide();

    $('#hideLogin').click(function() {
        $('#loginForm').hide();
        $('#registerForm').show();
    });

    $('#hideSignUp').click(function() {
        $('#loginForm').show();
        $('#registerForm').hide();
    });
});