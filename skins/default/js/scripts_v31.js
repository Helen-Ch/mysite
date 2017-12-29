console.log('Скрипт подгрузился в данный модуль!');
// Chat
window.onload = function () {
    // скрол внизу div и курсор в поле для ввода сообщения
    var block = document.getElementById("show_msg");
    if (block) {
        block.scrollTop = block.scrollHeight;
    }
    $('#msg').focus();
    //вывод новых сообщений, информации об удалении сообщения, списка пользователей онлайн каждые 5 секунд
    setInterval(showMessage, 5000);
}
var lastId;
var lastDelId;

// добавление имени пользователя в поле для ввода сообщения для персонального ответа
function privateMess(name) {
    $('#msg').val(name + ', ').focus();
}

//добавление сообщения в базу
function chatAjax() {
    var text = $('#msg').val();
    if (text == "") {
        $('#msg').text('Введите сообщение!').css('border', '1px solid red');
        $('#msg').focus(function () {
            $('#msg').val("");
            $('#msg').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        })
    } else {
        $('#msg').css('border', 'none').css('border-bottom', 'solid 1px #A4ACB0');
        $.ajax({
            url: '/chat/add',
            type: "POST",
            cache: false,
            data: {
                text: text
            },
            success: function (msg) {
                $('#msg').val("");
                $('#msg').focus();
                var myM = document.getElementById('show_msg');
                myM.innerHTML += '<div id="' + msg + '" class="full_text"><p>' + name + ':&nbsp;' + '</p><p class="msg_text">' + text + '</p>';
                if (access == 5) {
                    var newl = document.getElementById(msg);
                    newl.innerHTML += '<div class="delete_msg" onclick="delMess(' + msg + ');">&#10008;</div>';
                }
                myM.innerHTML += '</div>';
                $('#show_msg').scrollTop($('#show_msg').prop('scrollHeight'));
                lastId = msg;
            },
        });
    }
    return false;
}

//запрос и вывод новых сообщений, информации об удалении сообщения, списка пользователей онлайн
function showMessage() {
    $.ajax({
        url: '/chat/show',
        type: "POST",
        cache: false,
        data: {
            last: lastId,
            lastDel: lastDelId
        },
        success: function (msg) {
            var response = JSON.parse(msg);
            if (response !== undefined) {
                //вывод новых сообщений
                var newM = document.getElementById('show_msg');
                for (var i in response.new) {
                    newM.innerHTML += '<div  id="' + response.new[i].id + '" class="full_text"><p>' + response.new[i].login + ':&nbsp;' + '<span>' + response.new[i].date + '</span></p>' +
                        '<p class="msg_text">' + response.new[i].text + '</p>' + '<p><span>id: ' + response.new[i].id + '</span></p>';
                    //если пользователь - модератор, добавляем возможность удаления сообщений
                    if (access == 5) {
                        var newl = document.getElementById(response.new[i].id);
                        newl.innerHTML += '<div class="delete_msg" onclick="delMess(' + response.new[i].id + ');">&#10008;</div>';
                    }
                    newM.innerHTML += '</div>';
                    //изменение фона у персональных сообщений
                    if (response.new[i].appeal == 1) {
                        var dd = document.getElementById(response.new[i].id);
                        dd.style.backgroundColor = '#FF96E8';
                        if (response.new[i].del_msg == 1) {
                            newl.style.backgroundColor = '#FF96E8';
                        }
                    }
                }

                //вывод информации об удалении сообщения
                for (var k in response.del) {
                    var ttt = document.getElementById(response.del[k].deleted_id);
                    ttt.innerHTML = '<div  id="' + response.del[k].deleted_id + '"><p>Это сообщение было удалено!</p></div>';
                }

                //вывод пользователей онлайн
                $('.count_us').text(response.countUs);
                var newUs = '';
                for (var l in response.users) {
                    newUs += '<p class="user_name" onclick="privateMess(\'' + response.users[l].login + '\')">' + response.users[l].login + '</p>';
                }
                $('#us_list').html(newUs);

                //перезаписываем последние переданные id, если они есть
                if (response.lastId !== undefined) {
                    lastId = response.lastId;
                }
                if (response.lastDelId !== undefined) {
                    lastDelId = response.lastDelId;
                }
            }
            // скрол внизу div
            $('#show_msg').scrollTop($('#show_msg').prop('scrollHeight'));
        },
    });
}

// удаление сообщения модератором
function delMess(id) {
    if (confirm('Вы действительно хотите удалить сообщение?')) {
        $.ajax({
            url: '/chat/del_msg',
            type: "POST",
            cache: false,
            data: {
                id: id,
                delete: 'delete'
            },
            success: function (msg) {
                var delM = document.getElementById(msg);
                delM.innerHTML = '<div  id="' + msg + '"><p>Это сообщение было удалено!</p></div>';
            },
        });
    }
    return false;
}