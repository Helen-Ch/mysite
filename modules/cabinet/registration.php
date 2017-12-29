<?php
Core::$META['title'] = 'Registration';
if (isset ($_POST['login'], $_POST['password'], $_POST['email'])){

    $errors = array();
    if(empty($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили логин!';
    } elseif (mb_strlen($_POST['login']) < 2){
        $errors['login'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['login']) > 16 ){
        $errors['login'] = 'Логин слишком длинный!';
    }
    if(mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен содержать не менее 5 символов!';
    }
    if(empty($_POST['email'])  || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили email!';
    }

    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `login` = '".mresAll($_POST['login'])."'
            LIMIT 1
        ");
        if($res->num_rows){
            $errors['login'] = 'Такой логин уже занят!';
        }
        $res->close();

        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `email` = '".mresAll($_POST['email'])."'
            LIMIT 1
        ");
        if($res->num_rows){
            $errors['email'] = 'Такой email уже занят!';
        }
        $res->close();
    }

    if(!count($errors)) {
        q("
            INSERT INTO `users` SET
            `login`    = '".mresAll($_POST['login'])."',
            `password` = '".mresAll(myHash($_POST['password']))."',                 
            `email`    = '".mresAll($_POST['email'])."',
            `date`     = NOW(),
            `hash`     = '".mresAll(myHash($_POST['login'].$_POST['email']))."';
         ");

        $id = DB::_()->insert_id;

        $_SESSION['regok'] = 'Ok!';

        Mail::$to = $_POST['email'];
        Mail::$subject = 'Вы зарегистрировались на сайте';
        /*Mail::$text = 'Для активации Вашего аккаунта пройдите по ссылке '
            .Core::$DOMAIN.'index.php?module=cabinet&page=activate&id='.$id.'&hash='.myHash($_POST['login']).'';*/
       Mail::$text = 'Для активации Вашего аккаунта пройдите по ссылке '
            .Core::$DOMAIN.'cabinet/activate?id='.$id.'&hash='.myHash($_POST['login'].$_POST['email']).'';
        Mail::send();

	/*	Mail::$subject = 'domashka11 blocks';
        Mail::$text = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Лучшие предложения для Вас!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-size: 14px; line-height: 1.5; background-color: #B8D8E4; height: 100%; margin: 0; padding: 0; text-align: center;">
<style>
	@media only screen and (max-device-width: 480px) {
		.content {
			float: none;
			width: 100% !important;
			max-width: 100% !important;
		}
	}
</style>
<!--[if (gte mso 9)|(IE)]>
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding-top:0; padding-bottom:20px; padding-right:0; padding-left:0; margin:0px; background-color: #FFFFFF;">
<![endif]-->
<div style="max-width: 600px; width: 100%; background-color: #FFFFFF; margin: 0 auto;">
	<!--[if (gte mso 9)|(IE)]>
	<table width="100%" style="background-color: #FFE8A5;">
		<tr>
			<td style="padding: 20px;" valign="top">
	<![endif]-->
	<div role="banner" style="width: 100%; background-color: #FFE8A5; padding: 20px 0;">
		<img src="https://drive.google.com/uc?export=download&id=0B3nVIjoiiJ-hZ3NMU2RxenVWeHc"
			 alt="WELCOME TO AGROLUX" width="197"
			 style="border:0; outline:none; text-decoration:none; display:block; padding-left: 20px;">
	</div>
	<!--[if (gte mso 9)|(IE)]>
	</td></tr></table>
	<table width="100%" cellpadding="20">
		<tr>
			<td width="50%" valign="top">
	<![endif]-->
	<div role="main" style="padding: 0 20px;">
		<div class="content" style="max-width: 300px; min-width: 250px; float:left;">
			<img src="https://drive.google.com/uc?export=download&id=0B3nVIjoiiJ-hWnB1VG1jS21yaG8"
				 alt="Vegetables&Fruits" width="209"
				 style="border:0; outline:none; text-decoration:none; display:block; margin: 0 auto;">
		</div>
		<!--[if (gte mso 9)|(IE)]>
		</td>
		<td width="50%" valign="top">
		<![endif]-->
		<div class="content" style="text-align: center; max-width: 300px; min-width: 250px; float:left;">
			<span style="font-size: 20px; font-weight: 700;">Vestibulum est ante!</span>
			<p style="margin: 0; text-align: justify; text-indent: 20px;">Sed eleifend finibus orci, at
				aliquam sem vehicula
				non. Mauris id luctus ipsum. Maecenas
				turpis odio,
				dapibus in facilisis vel, pellentesque sed nunc. Vivamus vitae magna quis felis ultrices
				efficitur. Proin
				semper commodo diam, sed pulvinar sapien porta commodo. Phasellus iaculis erat a dignissim
				malesuada. Nullam
				semper nisl et ex faucibus, vitae dignissim justo rutrum.</p>
		</div>
		<div style="clear: left;"></div>
	</div>
	<!--[if (gte mso 9)|(IE)]>
	</td>
	</tr>
	</table>
	<table width="100%" style="text-align: center;" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top">
	<![endif]-->
	<div role="contentinfo" style="width: 100%;  border-top: 1px solid #eeeeee; margin-top: 20px; padding: 20px 0; text-align: center;">
		<p style="margin: 0;">9870st vincent place, glasgow, dc 45 fr 45.</p>
		<a href="#"
		   style="color: #282A2F; font-weight: bold; padding-right: 10px; display: inline-block;">agrolux.com</a>
		<a href="mailto:agrolux@mail.com" style="color: #282A2F; font-weight: bold; display: inline-block;">agrolux@mail.com</a><br>
		<p style="margin: 0 0 14px 0;">8&nbsp;(800)&nbsp;500&ndash;50&ndash;50</p>
		<!--[if (gte mso 9)|(IE)]>
		<table width="100%" style="text-align: center; background-color: #FFE8A5;">
			<tr>
				<td valign="top">
		<![endif]-->
		<div style="width: 100%;  background-color: #FFE8A5; padding: 20px 0; margin-bottom: 20px; text-align: center;">
			<p style="margin: 20px; text-indent: 20px; text-align: justify;">
				Вступайте в наши сообщества, чтобы участвовать в конкурсах, получать подарки и полезные материалы:
			</p>
			<a href="#" style="color: #6C2A01; font-weight: 600;">Facebook</a>
			<a href="#" style="color: #6C2A01; font-weight: 600; padding: 0 10px;">VKontakte</a>
			<a href="#" style="color: #6C2A01; font-weight: 600; padding: 0 10px 0 0;">YouTube</a>
			<a href="#" style="color: #6C2A01; font-weight: 600;">Twitter</a>
		</div>
		<!--[if (gte mso 9)|(IE)]>
		</td></tr></table>
		<![endif]-->
		<p>С наилучшими пожеланиями, Ваш
			<a href="/"
			   style="text-decoration: none; color: #6C2A01; font-weight: 900; font-style: italic;">Agrolux!</a></p>
		<p><a href="#" style="color: #C5BAA2;">Отписаться от рассылки</a></p>
	</div>
	<!--[if (gte mso 9)|(IE)]>
	</td></tr></table>
	<![endif]-->
</div>
<!--[if (gte mso 9)|(IE)]>
</td></tr></table><![endif]-->
</body>
</html>';
        Mail::send();
*/
        header("Location: /cabinet/registration");
        exit();
    }
}
/*if (isset ($_POST['login'], $_POST['password'], $_POST['email'])){

    $errors = array();
    if(empty($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили логин!';
    } elseif (mb_strlen($_POST['login']) < 2){
        $errors['login'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['login']) > 16 ){
        $errors['login'] = 'Логин слишком длинный!';
    }
    if(mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен содержать не менее 5 символов!';
    }
    if(empty($_POST['email'])  || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили email!';
    }

    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `login` = '".mresAll($_POST['login'])."'
            LIMIT 1
        ");
        if(mysqli_num_rows($res)){
            $errors['login'] = 'Такой логин уже занят!';
        }

        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `email` = '".mresAll($_POST['email'])."'
            LIMIT 1
        ");
        if(mysqli_num_rows($res)){
            $errors['email'] = 'Такой email уже занят!';
        }
    }

    if(!count($errors)) {
        q("
            INSERT INTO `users` SET
            `login`    = '".mresAll($_POST['login'])."',
            `password` = '".mresAll(myHash($_POST['password']))."',                 
            `email`    = '".mresAll($_POST['email'])."',
            `date`     = NOW(),
            `hash`     = '".mresAll(myHash($_POST['login'].$_POST['email']))."';
         ");

        $id = mysqli_insert_id($link1);

        $_SESSION['regok'] = 'Ok!';

        Mail::$to = $_POST['email'];
        Mail::$subject = 'Вы зарегистрировались на сайте';
        /*Mail::$text = 'Для активации Вашего аккаунта пройдите по ссылке '
            .Core::$DOMAIN.'index.php?module=cabinet&page=activate&id='.$id.'&hash='.myHash($_POST['login']).'';*/
       /* Mail::$text = 'Для активации Вашего аккаунта пройдите по ссылке '
            .Core::$DOMAIN.'cabinet/activate?id='.$id.'&hash='.myHash($_POST['login']).'';
        Mail::send();

        header("Location: /cabinet/registration");
        exit();
    }
}*/