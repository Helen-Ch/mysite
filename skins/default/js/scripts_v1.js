/*var d = new Date();
 alert( d.toString() );
 var d = new Date(2016, 1, 28);
 d.setDate(d.getDate() + 2);

 alert( d );
 alert( new Date().getTimezoneOffset() );


 /* var curr_date = d.getDate();
 var curr_month = d.getMonth() + 1;
 var curr_year = d.getFullYear();*/

// document.getElementById('adcom').innerHTML += '<br>' + name +'<br>' + text;
// $('#un').text(name + ' ' + curr_year + "-" + curr_month + "-" + curr_date);



 /*
function hideShow() { // 1 вариант
    var x = document.getElementById('xx');
    if(x.style.display=='block'){
        x.style.display='none';
    } else {
        x.style.display='block';
    }
}


function hideShowChecked(id1,id2) {
    var a = document.getElementById('divv');
    var b = document.getElementById('af');
    var y = document.getElementById(id2);
    var x = document.getElementById(id1);
    if(y.checked) {
        x.style.display = 'block';
        x. style.width = '50%';
        x. style.height = '50%';
        x. style.backgroundColor = '#FFFFFF';
        x.style.position = 'fixed';
        x.style.top = '200px';
        x.style.left = '25%';
        x.style.zIndex = 3;
        a.style.position = 'relative';
        b.style.backgroundImage = 'url(/skins/default/img/bg-black.png)';
        b.style.backgroundRepeat = 'repeat';
        b.style.backgroundPosition = 'top left';
        b.style.position = 'absolute';
        b.style.left = 0;
        b.style.top = 0;
        b.style.width = '100%';
        b.style.height = '200%';
        b.style.opacity = 0.4;
        b.style.zIndex = 2;
    } else {
        x.style.display = 'none';
    }

}

function myAjax1() {
    document.getElementById('jq').innerHTML += '<br>Login = Inpost';
    //var x = document.getElementById('xx').innerHTML;
    $.ajax({
        url: '/test_ajax.php',
        type: "POST",
        cache: false,
        //timeout: 15000,
        data: {login: 'Inpost', age: 24, text: x}, //запрос на сервер
        success: function (msg) { //ответ сервера
            if(msg == 'ok'){
                alert('Ваш комментарий добавлен!');
            }
           // alert(msg);
        },
        /*error: function (x, t, m) {
            if(t ==='timeout'){
                setTimeout(myAjax,30000); // повторный вызов myAjax если нет ответа сервера(н-р, не работант интернет) в течение периода, установленного  timeout. не имеет смысла, если есть setInterval();
                alert('слишком долгое ожидание ответа от сервера');
            } else {
                alert('massage hasn\'t been sent');//любые другие проблемы с скрвером
            }
        }*/
 /*   });

}

/*
function myAjax() {
    $.ajax({
        url: '/test_ajax.php',
        type: "POST",
        cache: false,
        data: {login: 'Inpost'}, //запрос на сервер
        success: function (msg) { //ответ сервера
            var response = JSON.parse(msg); //перевод снова в объект
            alert(response.Name);
        },
    });
    return false;
}
*/
function myJquery() {

}






/*window.onload = function () { // только один раз
   // alert(document.getElementById('xx').innerHTML);
    /* document.getElementById('keey').onclick = function(){ // 2 вариант
     x = document.getElementById('xx');
     if(x.style.display=='block'){
     x.style.display='none';
     } else {
     x.style.display='block';
     }
     }*/
  /* document.getElementById('keey').onclick = hideShow; // 3 вариант м. б. проблему с мобильными устройствами
     intervalId = setInterval(test, 2000);
   document.getElementById('aj').onclick = myAjax1;
    document.getElementById('jq').onclick = myJquery;
}*/
console.log('Скрипт подгрузился!');
var x = 0;
function test() {
    ++x;
    console.log('lalalal' + x);
    if(x == 5){
        clearInterval(intervalId);
    }
}
//var intervalId = setInterval(test, 2000);

//проверка на кратность 3 и 5 диапазона положительных чисел, принимаемого функццией
function BuzzBizz(start,end) {
    if(start > 0 & end > 0) {
        for (i = start; i <= end; ++i) {
            if (i % 3 == 0 & i % 5 == 0) {
                console.log('BizzBuzz');
            } else if (i % 3 == 0) {
                console.log('Buzz');
            } else if (i % 5 == 0) {
                console.log('Bizz');
            } else {
                console.log(i);
            }
        }
    } else{
        console.log('Введите число > 0');
    }
}
BuzzBizz(3, 15);
///////////////////////////////////////////////////////////


function checkLength(){

    var l = document.getElementById('aa').value.length;
    if(l < 5) {
        alert( 'Текст должен содержать не менее 5 символов! Вы ввели' + l);
       // document.getElementById('error').style.display = 'block';
       // document.getElementById('error').innerHTML = 'Текст должен содержать не менее 5 символов!';
        return false;
    }

}

function del(){
    return confirm('Вы действительно хотите удалить запись?');
}


function myAjax() {
    var login = $('#alog').val();
    var pass = $('#apass').val();
    $.ajax({
        url: '/cabinet/authorization',
        type: "POST",
        cache: false,
        data: {login: login,
            pass: pass

        },
        success: function (msg) {
            /* if(msg == 'no') {
             alert('нет такого пользователя');
             }*/
            /* var response = JSON.parse(msg); //перевод снова в объект
             alert(response);
             /* if(response.status == 'no'){
             $('#erroruser').text('Нет пользователя с таким логином или паролем!').css('display','block');
             }*/
            if(msg == 'no'){
                $('#erroruser').text('Нет пользователя с таким логином или паролем!').css('display','block');
            }

        },
    });
    return false;
}
// $('#show_msg').scrollTop($('#show_msg').prop('scrollHeight'));
// добавление имени пользователя для персонального ответа
 /*  $('#users_on').on("click", ".user_name", function(){
 var name = $(this).text();
 $('#msg').val(name + ', ').focus();
 });*/




/*for (var i in response.new) {
    if (response.new[i].del_msg == 1) {
        newM.innerHTML += '<div id="' + response.new[i].id + '"><p>' + response.new[i].login + ': ' + '<span>' + response.new[i].date + '</span></p>' +
            '<p class="msg_text">' + response.new[i].text + '</p>' +
            '<p class="delete_msg"><span  onclick="delMess(' + response.new[i].id + ');">УДАЛИТЬ</span> Сообщение ' + response.new[i].id + '</p></div>';
    } else {
        newM.innerHTML += '<div  id="' + response.new[i].id + '"><p>' + response.new[i].login + ': ' + '<span>' + response.new[i].date + '</span></p>' +
            '<p class="msg_text">' + response.new[i].text + '</p></div>';
    }
    if(response.new[i].appeal !== undefined) {
        if (response.new[i].appeal == response.new[i].usSess) {
            //$('#response.new[i].id').css('background-color', '#FF96E8');
            var dd = document.getElementById(response.new[i].id);
            dd.style.backgroundColor = '#FF96E8';
        }
    }

}*/

$('form[name=order1]').on("submit", function () {
    /*  var form = $('form[name=order1]').serializeArray();
     //alert(form.length);
      var login = $('input[type="text"]').val();
      var tel = $('input[type="tel"]').val();
      var email = $('input[type="email"]').val();
      var counter = 0;
      for(var i = 0; i < form.length; i++){
       //   alert(form[i]);
          for(var key in form[i]){
             // alert(key+' '+form[i][key]);
              counter++;
          }

            /*  if(form[i].prop !== undefined){
                  counter++;
          }*/
    /*   }

      alert(counter);

     /* if(form !== ''){
      // if (login !== "" && tel !== "" && email !== "") {
           //открыть модальное окно с id="myModal"*/
    $("#myModal").modal('show');
    /*   $.ajax({
           url: '/addon/vatel.php',
           type: "POST",
           cache: false,
           data: form,
           success: function (msg) {
               $('form:first').trigger('reset');
           }
       });*/
    return false;
    /* }*/

});

$('form').on("submit", function () {
    var form = $(this).serializeArray();
    $("#myModal").modal('show');
    $.ajax({
        url: '/addon/vatel.php',
        type: "POST",
        cache: false,
        data: form,
        success: function (msg) {
            $('.form-control').val('');
        }
    });
    return false;
});