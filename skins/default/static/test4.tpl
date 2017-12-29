<?php
error_reporting(-1);
// a table with colored cells
echo '<table border=1 cellpadding=10>';
for ($x = 1; $x <= 3; ++$x) {
	echo '<tr >';
	if ($x == 3) {
		echo '<tr bgcolor="#FF1814">';
	}
	for ($y = 1; $y <= 5; ++$y) {
		if ($x == 1 && $y == 2) {
			echo '<td bgcolor="#FFD014">';
		} elseif ($x == 2 && ($y == 3 || $y == 4)) {
			echo '<td bgcolor="#186200">';
		} else {
			echo '<td></td>';
		}
	}
	echo '</tr>';
}
echo '</table>';
?>

<div id="af" class="afterfon"></div>
<div id="divv" style="text-align: center; padding: 50px;">

    <script>

       /* x = 10;
        y = 3;
        result = x - y;

        alert(x+' -'+y+' = '+result);*/

       // x = 1;
       /* while (x < 4){
            alert(x);
            ++x;
        }
        do{
            alert(x);
            ++x;
        } while (x < 3);
       for(i = 1; i < 5; ++i){
           alert(i);
       }
x = prompt('Сколько Вам лет?', 18);
alert('Вы указали, что Вам ' + x + ' лет');*/
     /*  x = confirm('Do you really want to delete?');
       if(x){
           alert('You agreed to delete');
       } else {
           alert('You refused to delete');
       }
alert(parseFloat('1.2px'));*/


      /*  function hideShow() {
           var x = document.getElementById('xx');
            if(x.style.display=='block'){
                x.style.display='none';
            } else {
                x.style.display='block';
            }
        }*/
      // console.log('Personel log' + 'Русский текст');




    </script>

    <div id="xx" style="background-color: yellow; display: none;">Hello</div>
   <!-- <div style="font-size: 16px;" onclick="hideShow();">Нажми на меня!</div>  --> <!--  1 вариант работает всегда-->
    <div id="keey" style="font-size: 16px;">Нажми на меня!</div> <!-- 2 и 3 вариант -->


    <form  id="f1" style="display: none;" action="" onsubmit="return checkLength();">
        <table style="width: 100%; padding: 0 300px;">
            <tr>
                <td><input type=text size="30" id="aa" value=""></td>
                <td id="error" style="display:none;"></td>
            </tr>
            <tr><td colspan="2"><input type="submit" value="send"></td></tr>
        </table>
    </form>

<form action="" method="post">
    <input type=checkbox id="testt" onchange="hideShowChecked('f1','testt');">check

</form>



<a href="http://google.com" onclick="return del()">Delete</a>
<div id="aj">testing Ajax</div>
<div id="jq">testing jQuery</div>

    <form action=""method="post" enctype="multipart/form-data" style="width:60%;margin:60px auto;text-align: center;">
        <p><img src="<?php if(isset($_FILES['file']['name'])){echo '/img/'.$_FILES['file']['name'];} ?>" alt="image"></p>
        <p><img src="<?php if(isset($img)){ echo $img;} ?>" alt="image"></p>
        <p><img src="<?php if(isset($avatar)){ echo $avatar;} ?>" alt="image"></p>
        <p><img src="<?php if(isset($logo)){ echo $logo;} ?>" alt="image"></p>
        <input type="file" name="file">
        <input type="submit" name="submit" value="upload file">
    </form>




</div>


<!-- сообщение об ошибке при авторизации
<div class="information">
    <a href="#" class="address">8901 Marmora Road, Glasgow, D04</a>
    <a href="#" class="phone">800 555 7744</a>
    <?php if(!isset($_SESSION['user'])){
					if(isset($_SESSION['error'])){ ?>
    <div id="error" class="error"><?php echo $_SESSION['error'].'<br>'; ?>
        <a href="/"></a>
    </div>
    <div id="ef" class="errorfon"></div>
    <?php unset($_SESSION['error']);
					} else{ ?>
    <div class="enreg" onclick="hideShow('log'); hideShow('af'); hideShow('x');">Войти | Регистрация</div>
    <?php } }else { ?>
    <div class="enreg log" onclick="hideShow('user');">Здравствуйте, <?php echo hscAll($_SESSION['user']['login']); ?>!</div>
    <div class="usprof" id="user">
        <a href="/static/user_profile" class="" id="prof">Профиль</a>
        <a href="/cabinet/exit" class="" id="ex">Выход</a>
    </div>
    <?php  } ?>
    <div class="clear"></div> -->



<div class="comments">
    <div class="services-01"></div>
    <div class="underline02"></div>
    <div id="resp" class="headline"></div>
    <div id="req" class="comform">
        <?php if(isset($_SESSION['user'])){
            if(!isset($_SESSION['commentok'])){ ?>
        <p class="headline">Оставьте свой комментарий</p>
        <form  action="" method="post" onsubmit="return commentsAjax();">
            <table class="formtable">
                <tr>
                    <td>Имя *</td>
                    <td><input id="name" type="text" name="name" size="30" value="<?php echo @htmlspecialchars($_POST['name']); ?>"></td><!-- здесь оставлю @ для примера, на память-->
                    <td><?=@$errors['name']; ?></td><!-- и здесь для примера-->
                </tr>
                <tr>
                    <td>E-mail *</td>
                    <td><input id="mail" type="email" name="email" size="30" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']);} ?>"></td>
                    <td><?php if(isset($errors['email'])) {echo $errors['email'];} ?></td>
                </tr>
                <tr>
                    <td>Введите свой комментарий *</td>
                    <td><textarea id="text" name="text" cols="31" rows="6" value="<?php if(isset($_POST['text'])) {echo htmlspecialchars($_POST['text']);} ?>"></textarea></td>
                    <td><?php if(isset($errors['text'])) {echo $errors['text'];} ?></td>
                </tr>
            </table>
            <p class="note">* - обязательные для заполнения поля</p>
            <input type="submit" name="sendcomment" value="Отправить" class="button-hello send">
        </form>
        <?php } else {unset($_SESSION['commentok']); ?>
        <div>Ваш комментарий добавлен!</div>
        <?php }
        } else { ?>
        <p> Чтобы добавить свой комментарий Вам необходимо авторизироваться на сайте <a href="#" onclick="hideShow('log'); hideShow('af'); hideShow('x');">Вход</a></p>
        <?php } ?>
    </div>
</div>



