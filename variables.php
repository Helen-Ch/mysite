<?php
// обработка rewrite
if(isset($_GET['route'])){
    $temp = explode('/',$_GET['route']);
        if($temp[0] == 'admin'){
            Core::$CONT = Core::$CONT.'/admin';
            Core::$SKIN = 'admin';
            unset($temp[0]);
        } elseif ($temp[0] == 'employment'){
			Core::$CONT = Core::$CONT.'/employment';
			Core::$SKIN = 'employment';
			unset($temp[0]);
		}elseif ($temp[0] == 'vatel'){
			Core::$CONT = Core::$CONT.'/vatel';
			Core::$SKIN = 'vatel';
			unset($temp[0]);
		}
    $i = 0;
    foreach ($temp as $k=>$v){
        if($i == 0){
            if (!empty($v)) {
                $_GET['module'] = $v;
            }
        } elseif ($i == 1){
            if (!empty($v)) { // если случайно после названия модуля в адр. строке поставили слэш
                $_GET['page'] = $v;
            }
        } else{
            $_GET['key'.($i-1)] = $v; // -1, чтобы ключи начинались с 1, а не с 2   !!!!! $k поменять $i?  !!!!!!
        }
        ++$i;
    }
    unset($_GET['route']);
}

 //подключение статичной страницы без указания имени модуля site.ua/about, а не  site.ua/static/about
if (!isset($_GET['module'])) {
    $_GET['module'] = 'static';
} else{
    $res = q("
        SELECT *
        FROM `pages`
        WHERE `module` = '".mresAll($_GET['module'])."'
        LIMIT 1
    ");
    if(!$res->num_rows){
		header("Location: /404");
        exit();
    }
    else{
        $staticpage = $res->fetch_assoc();
        $res->close();
        if($staticpage['static'] == 1){
            $_GET['module'] = 'staticpage';
            $_GET['page'] = 'main';
        }
    }
    /*if(!mysqli_num_rows($res)){
        header("Location: /404");
        exit();
    }
    else{
        $staticpage = mysqli_fetch_assoc($res);
        if($staticpage['static'] == 1){
            $_GET['module'] = 'staticpage';
            $_GET['page'] = 'main';
        }
    }*/
}
if(!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}


if(preg_match('#["\\\/:\*\?<>\|\+\#%&!]|\.{2}/|^\.#ui', $_GET['page'])){
    header("Location: /404");
    exit();
}

/* //допустимые модули
$allowed = array('static', 'goods', 'news', 'game', 'comments', 'auth', 'file_manager', 'main', 'services', 'gallery', 'contact', 'about', 'cabinet', 'exit', 'game1', 'game1over', 'program1', 'errors');

if (!isset($_GET['module'])) {
    $_GET['module'] = 'static';
} elseif (!in_array($_GET['module'], $allowed) && Core::$SKIN != 'admin') {
    header("Location: /errors/404");
    exit();
}

if(!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}

*/
if(isset($_POST)){
    $_POST = trimAll($_POST);
}