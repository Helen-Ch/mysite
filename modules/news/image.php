<?php
Core::$META['title'] = 'NEWS';
$news = q("
    SELECT *
    FROM `news`
    WHERE `id`  = ".(int)$_GET['key1']."
        LIMIT 1
");

if(!$news->num_rows){
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /news");
    exit();
}

