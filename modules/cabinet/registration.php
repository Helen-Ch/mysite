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
        header("Location: /socials/registration");
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