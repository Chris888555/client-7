$(document).ready(function(){
    $('#registerAccount').click(function(){
        $.post('/auth/register',{
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password2: $('#password2').val(),
        }, function(data){
            if(data.status){
                success_to(data.msg, '/login');
            }else{
                error(data.msg)
            }
        }, 'json');
    });
});