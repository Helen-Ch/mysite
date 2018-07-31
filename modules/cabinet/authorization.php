<?php
//Core::$META['title'] = 'Authorization';
//wtf($_POST,1);
if(isset($_POST['login'],$_POST['password'])) {
    $res = q("
        SELECT *
        FROM `users`
        WHERE `login`      = '". mresAll($_POST['login'])."'
            AND `password` = '". mresAll(myHash($_POST['password']))."'
            AND `active`   = 1
        LIMIT 1    
    ");

    if ($res->num_rows) {
        $_SESSION['user'] = $res->fetch_assoc();
        $status = 'ok';
        // для автоавторизацции создать cookies и записать в базу hash, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']
        if(isset($_POST['rememberMe'])) {
            $hash = mresAll(myHash($_SESSION['user']['id'] . $_SESSION['user']['login'] . $_SESSION['user']['email']));
            setcookie('autoauthhash', $hash, time() + 2592000, '/');
            $_COOKIE['autoauthhash'] = $hash;
            setcookie('autoauthid', $_SESSION['user']['id'], time() + 2592000, '/');
            $_COOKIE['autoauthid'] = $_SESSION['user']['id'];
            q("
               UPDATE `users` SET
               `hash`             = '".mresAll(myHash($_SESSION['user']['id'] . $_SESSION['user']['login'] . $_SESSION['user']['email']))."',
               `user_ip`          = '".mresAll($_SERVER['REMOTE_ADDR'])."',
               `user_agent`       = '".mresAll($_SERVER['HTTP_USER_AGENT'])."'
               WHERE `login`      = '" . mresAll($_POST['login']) . "'
                   AND `password` = '" . mresAll(myHash($_POST['password'])) . "'
                   AND `active`   = 1                         
           ");
        }
    } else {
        $error = 'Нет пользователя с таким логином или паролем!';
    }
    
  /* if(Core::$SKIN == 'default') {
        $_SESSION['error'] = 'Нет пользователя с таким логином или паролем!';
        header("Location: /");
        exit();
    }*/
}
/*if(Core::$SKIN == 'default') {
    if (isset($_SESSION['user'])) {
        echo 'ok';
        exit();
    } else {
        echo 'no';
        exit();
    }
}*/



















/*if(isset($_POST['login'],$_POST['password'])) {
    $res = q("
        SELECT *
        FROM `users`
        WHERE `login`      = '". mresAll($_POST['login'])."'
            AND `password` = '". mresAll(myHash($_POST['password']))."'
            AND `active`   = 1
        LIMIT 1    
    ");
    if (mysqli_num_rows($res)) {
        $_SESSION['user'] = mysqli_fetch_assoc($res);
        $status = 'ok';
                // для автоавторизацции создать cookies и записать в базу hash, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']
        if(isset($_POST['rememberMe'])) {
            $hash = mresAll(myHash($_SESSION['user']['id'] . $_SESSION['user']['login'] . $_SESSION['user']['email']));
            setcookie('autoauthhash', $hash, time() + 2592000, '/');
            $_COOKIE['autoauthhash'] = $hash;
            setcookie('autoauthid', $_SESSION['user']['id'], time() + 2592000, '/');
            $_COOKIE['autoauthid'] = $_SESSION['user']['id'];
            q("
               UPDATE `users` SET
               `hash`             = '".mresAll(myHash($_SESSION['user']['id'] . $_SESSION['user']['login'] . $_SESSION['user']['email']))."',
               `user_ip`          = '".mresAll($_SERVER['REMOTE_ADDR'])."',
               `user_agent`       = '".mresAll($_SERVER['HTTP_USER_AGENT'])."'
               WHERE `login`      = '" . mresAll($_POST['login']) . "'
                   AND `password` = '" . mresAll(myHash($_POST['password'])) . "'
                   AND `active`   = 1                         
           ");

        }
    } else {
        $error = 'Нет пользователя с таким логином или паролем!';
    }
}*/
