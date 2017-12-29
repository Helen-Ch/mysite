<?php
Core::$META['title'] = 'Admin/News';
//Core::$CSS[] = '<link href="/css/styledelicatos.css" rel="stylesheet" type="text/css">';// подключение CS-стилей JS, которые будут работать только на этой странице, а не подключать на главной странице и перегружать весь сайт
//Core::$JS[] = 'подключаем  JS';

/*if($var==10){//  проверка буферизации вывода
}*/

if(isset($_POST['delete'])){
    if(!empty($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
        DELETE FROM `news`
        WHERE `id` IN(" . $ids . ")
    ");
        $_SESSION['info'] = 'новости были удалены из базы данных!';
        header("Location: /admin/news");
        exit();
    } else{
        $_SESSION['info'] = 'Вы не выбрали новости для удаления!';
        header("Location: /admin/news");
        exit();
    }
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

//выбираем категорию
$cat = q("
    SELECT *
    FROM `news_category`
    ORDER BY `id`
");

$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
if($page < 1) { $page = 1; }

$count = $page*Pagination::$limit-Pagination::$limit;

$result = q("SELECT COUNT(*) FROM `news`");
$posts = $result->fetch_row();
$result->close();

/*$result = q("SELECT * FROM `news`"); //медленно работает на больших объемахданных
$posts = $result->num_rows;//всего записей в таблице
$result->close();*/

/*$res = q("SELECT SQL_CALC_FOUND_ROWS * FROM `news`");//пример из класса Стаса
$res_count = q("SELECT FOUND_ROWS()");
$posts = $res_count->fetch_row();
$res_count->close();*/

//wtf($posts,1);
$news = q("
    SELECT *
    FROM `news`    
    ORDER BY `id`
    LIMIT ".$count.",".Pagination::$limit."        
");                                        //записей на странице

$show_pages = Pagination::pages($posts, $page);

/*
//пагинатор
$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
if($page < 1){
    $page = 1;
}
$limit = 3;
$count = $page*$limit-$limit;

// Определяем общее число сообщений в базе данных
$result = q("SELECT * FROM `news`");
$posts = $result->num_rows;
// Находим общее число страниц
$total = ceil($posts / $limit);
if($page > $total){
    $page = 1;
}
$before_limit  = $page - 2;
if($before_limit<1){
 $before_limit = 1;
}
$after_limit  = $page + 2;
if ($after_limit>$total){
    $after_limit = $total;
}


$news = q("
    SELECT *
    FROM `news`    
    ORDER BY `id`
    LIMIT $count, $limit        
");

// Проверяем нужны ли стрелки назад
if  ($page > 1 ){
    $prepage= '<a href= ?num=1><< </a><a href=?num=' . ($page - 1) . '>< </a>';
}
// Проверяем нужны ли стрелки вперед
if ($page < $total){
    $nextpage = '<a href=?num='. ($page + 1) .'> ></a><a href=?num='.$total.'> >></a>';
}

*/







/*
// Находим две ближайшие станицы с обоих краев, если они есть
if(($page - $limit) > 0){
    $page2left = ' <a href=?num='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
}
if($page - 1 > 0){
    $page1left = '<a href=?num='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
}
if($page + 2 <= $total){
    $page2right = ' | <a href=?num='. ($page + 2) .'>'. ($page + 2) .'</a>';
}
if($page + 1 <= $total){
    $page1right = ' | <a href=?num='. ($page + 1) .'>'. ($page + 1) .'</a>';
}
*/
if(isset($_SESSION['info'])){
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
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