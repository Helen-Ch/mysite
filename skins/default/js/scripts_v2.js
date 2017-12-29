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

/*function checkFormAuth(){
    var alog = document.getElementById('alog').value.length;
    var apass = document.getElementById('apass').value.length;
    var error = 0;
    if(alog == 0) {
        document.getElementById('alogerror').style.display = 'block';
        document.getElementById('alogerror').innerHTML = 'Вы не заполнили логин!';
        error = 1;
    }else {
        document.getElementById('alogerror').style.display = 'none';
    }
    if(apass == 0) {
        document.getElementById('apasserror').style.display = 'block';
        document.getElementById('apasserror').innerHTML = 'Вы не заполнили пароль!';
        error = 1;
    }else {
        document.getElementById('apasserror').style.display = 'none';
    }

    if(error == 0){
        return true;
    }else {
        return false;
    }
}*/

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




// Chat
window.onload = function () {
    // скрол внизу div и курсор в поле для ввода сообщения
    var block = document.getElementById("show_msg");
    if(block) {
        block.scrollTop = block.scrollHeight;
    }
    $('#msg').focus();
    //вывод новых сообщений, информации об удалении сообщения, списка пользователей онлайн каждые 5 секунд
    setInterval(showMessage, 5000);
}


// добавление имени пользователя в поле для ввода сообщения для персонального ответа
function privateMess(name) {
    $('#msg').val(name + ', ').focus();
    $('#hide').val(name);
}

//добавление сообщения в базу
function chatAjax() {
    var text = $('#msg').val();
    //var appeal = $('#hide').val();
    if(text == "") {
        $('#msg').text('Введите сообщение!').css('border', '1px solid red');
        $('#msg').focus(function() {
            $('#msg').val("");
            $('#msg').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        })
    }else {
        $('#msg').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        $.ajax({
            url: '/chat/add',
            type: "POST",
            cache: false,
            data: {
                text:   text,
                //appeal: appeal
            },
            success: function (msg) {
                if(msg == 1) {
                    $('#msg').val("");
                   // $('#hide').val("");
                    $('#msg').focus();
                   // showMessage();
                }
            },
        });
    }
  return false;
}
//запрос и вывод новых сообщений, информации об удалении сообщения, списка пользователей онлайн
function showMessage() {
    $.ajax({
        url:'/chat/show',
        cache:false,
        success: function (msg) {
            var response = JSON.parse(msg);
                if(response !== undefined) {
                    //вывод новых сообщений
                    var newM = document.getElementById('show_msg');
                    for (var i in response.new) {
                            newM.innerHTML += '<div  id="' + response.new[i].id + '" class="full_text"><p>' + response.new[i].login + ':&nbsp;' + '<span>' + response.new[i].date + '</span></p>' +
                                '<p class="msg_text">' + response.new[i].text + '</p>';
                        if (response.new[i].del_msg == 1) {
                            var newl = document.getElementById(response.new[i].id);
                            newl.innerHTML +='<div class="delete_msg" onclick="delMess(' + response.new[i].id + ');">&#10008;</div>';
                        }
                        newM.innerHTML += '</div>';

                        if(response.new[i].appeal == 1) {
                            // $('#response.new[i].id').css('background-color', '#FF96E8');// на локальном работает
                            var dd = document.getElementById(response.new[i].id);
                            dd.style.backgroundColor = '#FF96E8';
                            newl.style.backgroundColor = '#FF96E8';
                         }
                    }
                    //вывод информации об удалении сообщения
                    for (var k in response.del) {
                        var ttt = document.getElementById(response.del[k].deleted_id);
                            ttt.innerHTML = '<div  id="' + response.del[k].deleted_id + '"><p>Это сообщение было удалено</p></div>';
                    }
                    //вывод пользователей онлайн
                    $('.count_us').text(response.countUs);
                    var newU = document.getElementById('us_list');
                    var newUs = "";
                    for (var l in response.users) {
                        newUs += '<p class="user_name" onclick="privateMess(\'' + response.users[l].login + '\')">' + response.users[l].login + '</p>';
                        newU.innerHTML = newUs;
                    }
                }
            // скрол внизу div
            $('#show_msg').scrollTop($('#show_msg').prop('scrollHeight'));
        },
    });

}

// удаление сообщения модератором
function delMess(id){
    if(confirm('Вы действительно хотите удалить сообщение?')) {
        $.ajax({
            url: '/chat/del_msg',
            type: "POST",
            cache: false,
            data: {
                id: id,
                delete: 'delete'
            },
            success: function (msg) {
            },
        });
    }
    return false;
}