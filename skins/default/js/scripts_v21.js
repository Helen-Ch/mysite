console.log('Скрипт подгрузился в данный модуль!');

function del(){
    return confirm('Вы действительно хотите удалить запись?');
}

function hideShow(id) { // 1 вариант
    var x = document.getElementById(id);
    if(x.style.display=='block'){
        x.style.display='none';
    } else {
        x.style.display='block';
    }
}

function slide(id) { // 1 вариант
    var x = document.getElementById(id);
    if(x.style.display == 'block'){
        $('#' + id).slideUp();
    } else {
        $('#' + id).slideDown("slow");

    }
}

// Регистрация
function checkFormReg(){
    var login = document.getElementById('login').value.length;
    var pass = document.getElementById('pass').value.length;
    var email = document.getElementById('email').value.length;
    var error = 0;
    if(login == 0) {
        //alert('Вы не заполнили логин!');
        document.getElementById('logerror').style.display = 'block';
        document.getElementById('logerror').innerHTML = 'Вы не заполнили логин!';
        error = 1;
    } else if (login < 2){
        //alert('Логин слишком короткий!');
        document.getElementById('logerror').style.display = 'block';
        document.getElementById('logerror').innerHTML = 'Логин слишком короткий!';
        error = 1;
    } else if (login > 16 ){
        //alert('Логин слишком длинный!');
        document.getElementById('logerror').style.display = 'block';
        document.getElementById('logerror').innerHTML = 'Логин слишком длинный!';
        error = 1;
    }else {
        document.getElementById('logerror').style.display = 'none';
    }
    if(pass < 5) {
        //alert('Пароль должен содержать не менее 5 символов!');
        document.getElementById('passerror').style.display = 'block';
        document.getElementById('passerror').innerHTML = 'Пароль должен содержать не менее 5 символов!';
        error = 1;
    }else {
        document.getElementById('passerror').style.display = 'none';
    }
    if(email == 0) {
        //alert('Вы не заполнили email!');
        document.getElementById('mailerror').style.display = 'block';
        document.getElementById('mailerror').innerHTML = 'Вы не заполнили email!';
        error = 1;
    }else {
        document.getElementById('mailerror').style.display = 'none';
    }

    if(error == 0){
        return true;
    }else {
        return false;
    }
}
// Авторизация
function myAjax() {
    var form = $('form:first').serialize();
    var login = $('#alog').val();
    var pass = $('#apass').val();

    if(login == "" || pass == "") {
       if(login == ""){
           $('#alogerror').text('Вы не заполнили логин!').css('display','block');
       } else {
           $('#alogerror').css('display','none');
       }
       if (pass == "") {
           $('#apasserror').text('Вы не заполнили пароль!').css('display', 'block');
       }else {
           $('#apasserror').css('display', 'none');
       }
    }
    else {
        $('#alogerror').css('display','none');
        $('#apasserror').css('display', 'none');
        $.ajax({
            url:     '/cabinet/authorization',
            type:    "POST",
            cache:   false,
            data:    form,
            success: function (msg) {
                if (msg == 'no') {
                    $('#erroruser').text('Нет пользователя с таким логином или паролем!').css('display', 'block');
                } else {
                   location.reload();
                }
            },
        });
    }
    return false;
}
//Comments
function commentsAjax() {
    var name = $('#name').val();
    var mail = $('#mail').val();
    var text = $('#text').val();

    if(name == "" || mail == "" || text == "") {
        if(name == ""){
           $('#name').css('border', '1px solid red');
        } else {
            $('#name').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        }
        if (mail == "") {
            $('#mail').css('border', '1px solid red');
        }else {
            $('#mail').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        }
        if (text == "") {
            $('#text').css('border', '1px solid red');
        }else {
            $('#text').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        }
    } else {
        var d = new Date();
        var dd = d.toLocaleString();
        $('#un').text(name + '\u0020' + dd);
        $('#ct').text(text);
        $('#req').css('display', 'none');
        $('#resp').text('Ваш комментарий добавлен!').css('display', 'block');
        $.ajax({
            url: '/comments',
            type: "POST",
            cache: false,
            data: {
                name: name,
                email: mail,
                text: text
            },
            success: function (msg) {
            },
        });
    }
    return false;
}

//появление/исчезновение стрелочки "наверх"  и разворачивание/сворачивание фиксированного меню при прокрутке окна
window.onscroll = function() {
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 300) {
        $('.red').fadeIn("slow");
       // $('.red').css('display', 'block');
        $('.headerFixed').slideDown();
    } else {
        $('.red').fadeOut("slow");
       // $('.red').css('display', 'none');
        $('.headerFixed').slideUp();
    }
}