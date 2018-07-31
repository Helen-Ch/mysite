<?php
Core::$META['title'] = 'My profile';

$users = q("
    SELECT *
    FROM `users`
    WHERE `login` = '".mresAll($_SESSION['user']['login'])."'
    LIMIT 1    
");

if(!$users->num_rows){
    $_SESSION['info'] = 'Пользователя с таким логином не существует!';
    header("Location: /static/user_profile");
    exit();
}

$row = $users->fetch_assoc();
$users->close();
//wtf($_POST,1);
//wtf($_FILES, 1);
if(isset ($_POST['edit'],  $_POST['password'], $_POST['login'], $_POST['email'])) {
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }
    $errors = array();

    if (empty ($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили имя пользователя!';
    } elseif (mb_strlen($_POST['login']) < 2) {
        $errors['login'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['login']) > 16 ){
        $errors['login'] = 'Логин слишком длинный!';
    }

    if(!empty($_POST['password']) && mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен содержать не менее 5 символов!';
    }

    if (empty ($_POST['email'])  || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили адрес электронной почты!';
    }
    if(!empty($_POST['fb_delete_id'])){

    }
    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `login` = '".mresAll($_POST['login'])."' AND `id` <> ".(int)$row['id']."
            LIMIT 1
        ");
        if($res->num_rows){
            $errors['login'] = 'Такой логин уже занят!';
        }
        $res->close();

        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `email` = '".mresAll($_POST['email'])."'  AND `id` <> ".(int)$row['id']."
            LIMIT 1
        ");
        if($res->num_rows){
            $errors['email'] = 'Такой email уже занят!';
        }
        $res->close();
    }
    if($_FILES['file']['error'] == 0) {
        // wtf($_FILES,1);
        $upload = ImageUploading::upload($_FILES['file']);
        if ($upload == true) {
            $avatar = ImageUploading::resize('.'.ImageUploading::$name, 200, 200);
        }
    }

    if (!count($errors)) {
        q("
        UPDATE `users` SET
        `login`    = '" . mresAll($_POST['login']) . "',             
        `email`    = '" . mresAll($_POST['email']) . "'        
        ".((!empty($_POST['password'])) ? ",`password` = '".mresAll(myHash($_POST['password']))."'" : "")."
        ".((!empty($_POST['fb_delete_id'])) ? ",`fb_user_id` = ''" : "'".mresAll($row['fb_user_id'])."' " )."
        ".((isset($avatar)) ? ",`image` = '".mresAll($avatar)."'" : "")."
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'                    
    ");
        $_SESSION['info'] = 'Данные о пользователе были изменены!';
        header("Location: /static/user_profile");
        exit();
    }
}

if(isset($_POST['delete'])){
    q( "
        DELETE FROM `users`
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'        
    ");
    $_SESSION['info'] = 'пользователь был удален из базы данных!';
    header("Location: /static/user_profile");
    exit();
}

if(isset($_POST['delete_image'])){
    q("
        UPDATE `users` SET
        `image` = NULL -- или ''    
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'        
    ");
    $_SESSION['info'] = 'фото было удалено из базы данных!';
    header("Location: /static/user_profile");
    exit();
}
if(isset($_SESSION['info'])){
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}
/*$users = q("
    SELECT *
    FROM `users`
    WHERE `login` = '".mresAll($_SESSION['user']['login'])."'
    LIMIT 1    
");

if(!mysqli_num_rows($users)){
    $_SESSION['info'] = 'Пользователя с таким логином не существует!';
    header("Location: /static/user_profile");
    exit();
}

$row = mysqli_fetch_assoc($users);
//wtf($_POST,1);
//wtf($_FILES, 1);

if(isset ($_POST['edit'],  $_POST['password'], $_POST['login'], $_POST['email'])) {
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }
    $errors = array();

    if (empty ($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили имя пользователя!';
    } elseif (mb_strlen($_POST['login']) < 2) {
        $errors['login'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['login']) > 16 ){
        $errors['login'] = 'Логин слишком длинный!';
    }

    if(!empty($_POST['password']) && mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен содержать не менее 5 символов!';
    }

    if (empty ($_POST['email'])  || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили адрес электронной почты!';
    }
    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `login` = '".mresAll($_POST['login'])."' AND `id` <> ".(int)$row['id']."
            LIMIT 1
        ");
        if(mysqli_num_rows($res)){
            $errors['login'] = 'Такой логин уже занят!';
        }

        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `email` = '".mresAll($_POST['email'])."'  AND `id` <> ".(int)$row['id']."
            LIMIT 1
        ");
        if(mysqli_num_rows($res)){
            $errors['email'] = 'Такой email уже занят!';
        }
    }
    if(isset($_FILES['file'])) {
        $check = ImageUploading::check($_FILES['file']);

        if ($check == true) {
            $avatar = ImageUploading::resize($_FILES['file']['tmp_name'], 200, 200);
        }
    }

    if (!count($errors)) {
        q("
        UPDATE `users` SET
        `login`    = '" . mresAll($_POST['login']) . "',             
        `email`    = '" . mresAll($_POST['email']) . "'        
        ".((!empty($_POST['password'])) ? ",`password` = '".mresAll(myHash($_POST['password']))."'" : "")."
        ".((isset($avatar)) ? ",`image` = '".mresAll($avatar)."'" : "")."
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'                    
    ");
        $_SESSION['info'] = 'Данные о пользователе были изменены!';
        header("Location: /static/user_profile");
        exit();
    }
}

if(isset($_POST['delete'])){
    q( "
        DELETE FROM `users`
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'        
    ");
    $_SESSION['info'] = 'пользователь был удален из базы данных!';
    header("Location: /static/user_profile");
    exit();
}

if(isset($_POST['delete_image'])){
    mysqli_query($link1, "
        UPDATE `users`
        SET `image` = NULL -- или ''
        WHERE `login` = '".mresAll($_SESSION['user']['login'])."'        
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'фото было удалено из базы данных!';
    header("Location: /static/user_profile");
    exit();
}
if(isset($_SESSION['info'])){
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}*/