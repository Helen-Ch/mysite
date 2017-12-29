<?php
Core::$JS[] = '<script src="/skins/default/js/scripts_v2.js"></script>';
Core::$META['title'] = 'News';
//выбираем категорию
$cat = q("
    SELECT *
    FROM `news_category`
    ORDER BY `id`
");
if(isset($_SESSION['info'])){
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}

$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
if($page < 1) { $page = 1; }
$count = $page*Pagination::$limit-Pagination::$limit;
$result = q("SELECT COUNT(*) FROM `news`");
$posts = $result->fetch_row();
$result->close();

$news = q("
    SELECT *
    FROM `news`    
    ORDER BY `id`
    LIMIT ".$count.",".Pagination::$limit."        
");                                        //записей на странице

$show_pages = Pagination::pages($posts, $page);
