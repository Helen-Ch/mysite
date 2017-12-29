<?php
error_reporting(-1);
ini_set('display_errors','On');
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('Europe/Kiev');

// Конфиг сайта
include_once './config.php';
include_once './libs/default.php';

//Подключение к БД без класса DB
/*$link1 = mysqli_connect(/*DB_HOST,*//*Core::$DB_HOST,Core::$DB_LOGIN,Core::$DB_PASS,Core::$DB_NAME);
mysqli_set_charset($link1, 'utf8');
$db = mysqli_query($link1,"SET time_zone = 'Europe/Kiev'");
*/

include_once './variables.php';

// Роутер

ob_start();
    include './'.Core::$CONT.'/allpages.php';
    if(!file_exists('./'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php') || !file_exists('./skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl')){
        header("Location: /404");
        exit();
    }
    include './'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php';
    include './skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';
    $content = ob_get_contents();

ob_end_clean();

if(isset($_GET['ajax'])){
    echo $content;
    exit;
}

include './skins/'.Core::$SKIN.'/index.tpl';