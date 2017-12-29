<?php
//Core::$JS[] = '<script src="/skins/default/js/scripts_v21.js"></script>';

if(isset($_SESSION['user'])){
    $res = q("
        SELECT *
        FROM `users`
        WHERE `id` = ".(int)$_SESSION['user']['id']."
        LIMIT 1
    ");
    $_SESSION['user'] = $res->fetch_assoc();

    //создаем переменные для использования в  JS
    $name   = $_SESSION['user']['login'];
    $access = $_SESSION['user']['access'];

    if($_SESSION['user']['active'] != 1){// проверка не забанен ли данный пользователь
        //  1-й способ выполнить выход
        include './cabinet/exit.php';

        //   2-й способ выхода
        //myExit();

        //   3-й способ
       /* if($_GET['page'] != 'exit'){
            header("Location: ./cabinet/exit");
            exit();
        }*/
    }
    $res = q("
        UPDATE `users` SET
        `last_date`    = NOW()        
        WHERE `id` = "  . (int)$_SESSION['user']['id']. "            
    ");
            //АВТОАВТОРИЗАЦИЯ
} elseif (isset($_COOKIE['autoauthhash'],$_COOKIE['autoauthid'])) {
    $res = q("
        SELECT *
        FROM `users`
        WHERE `id` = " . (int)$_COOKIE['autoauthid'] . "
            AND `hash` = '" . mresAll($_COOKIE['autoauthhash']) . "'
            AND `user_ip` = '" . mresAll($_SERVER['REMOTE_ADDR']) . "'
            AND `user_agent` = '" . mresAll($_SERVER['HTTP_USER_AGENT']) . "'
        LIMIT 1    
    ");
    if ($res->num_rows) {
        $_SESSION['user'] = $res->fetch_assoc();
    } else {
        include './cabinet/exit.php';
    }
    $res->close();
}