<?php
Core::$META['title'] = 'Chat';
Core::$JS[] = '<script src="/skins/default/js/scripts_v31.js"></script>';
//для вывода пользователей онлайн, когда пользователь  только заходит в чат
$us = q("
          SELECT `login`
          FROM `users`
          WHERE `last_date` > NOW() - INTERVAL 3 MINUTE 
          ORDER BY `login` 
       ");

//для вывода последних сообщений, когда пользователь  только заходит в чат
$mess  = q("
    SELECT *
    FROM `chat`    
    ORDER BY `id`      
");

/*$mid= q("
    SELECT MAX(`id`)
    FROM `chat`
");
$m = $mid->fetch_assoc();
$mess  = q("
    SELECT *
    FROM `chat`
    WHERE `id` > ".($m['MAX(`id`)'] - 10)."
    ORDER BY `id`      
");
*/