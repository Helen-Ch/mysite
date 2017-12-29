<?php
Core::$META['title'] = 'News';
$news = q("
    SELECT *
    FROM `news`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
");

if(!$news->num_rows){
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /news");
    exit();
}