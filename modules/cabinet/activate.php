<?php
Core::$META['title'] = 'Activation';
//Core::$JS[] = '<script src="/skins/default/js/scripts_v1.js"></script>';//если хотим подключить конкретный JS только для этой страницы
if(isset ($_GET['hash'],$_GET['id'])){
    q("
       UPDATE `users` SET
       `active` = 1
       WHERE `id` = ".(int)$_GET['id']."
            AND `hash` = '".mresAll($_GET['hash'])."'
    ");
    $info = 'Ваш аккаунт активирован!<br>Для входа на сайт Вам необходимо авторизироваться!';
} else {
    $info = 'Вы прошли по неверной ссылке!';
}



