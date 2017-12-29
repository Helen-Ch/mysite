<?php
Core::$META['title'] = 'Admin/News';
//Core::$CSS = '<link href="/css/styledelicatos.css" rel="stylesheet" type="text/css">';// подключение CS-стилей JS, которые будут работать тольео на этой странице, а не подключать на главной странице и перегружать весь сайт
//Core::$JS = 'подключаем  JS';

/*if($var==10){//  проверка буферизации вывода}*/

if(isset($_POST['delete'])){
    q("
        DELETE FROM `news`
        WHERE `id` = ".(int)$_GET['id']." 
    ");
    $_SESSION['info'] = 'новость была удалена из базы данных!';
    header("Location: /admin/news");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    q("
        DELETE FROM `news`
        WHERE `id` = ".(int)$_GET['id']."        
    ");
    $_SESSION['info'] = 'новость была удалена из базы данных!';
    header("Location: /admin/news");
    exit();
}
$news = q("
    SELECT *
    FROM `news`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1      
");

if(!$news->num_rows){
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /admin/news");
    exit();
}


/*
if(isset($_POST['delete'])){
    foreach($_POST['ids'] as $k=>$v){
        $_POST['ids'][$k] = (int)$v;
    }
    $ids = implode(',',$_POST['ids']);
    mysqli_query($link1, "
        DELETE FROM `news`
        WHERE `id` IN(".$ids.")
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'новости были удалены из базы данных!';
    header("Location: /admin/news");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    mysqli_query($link1, "
        DELETE FROM `news`
        WHERE `id` = ".(int)$_GET['id']."        
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'новость была удалена из базы данных!';
    header("Location: /admin/news");
    exit();
}
$news = mysqli_query($link1, "
    SELECT *
    FROM `news`
    ORDER BY `id`    
") or exit(mysqli_error($link1));

if(isset($_SESSION['info'])){
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}*/

