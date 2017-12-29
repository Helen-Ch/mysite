<?php
Core::$META['title'] = 'NEWS';
//выбираем категорию
$cat = q("
        SELECT *
        FROM `news_category`
        WHERE `name` = '".mresAll($_GET['key1'])."'
        LIMIT 1
        ");
if(!$cat->num_rows){
    $_SESSION['info'] = 'данной категории не существует!';
    header("Location: /news");
    exit();
}
$row2 = $cat->fetch_assoc();

Pagination::$limit = 2;
Pagination::$view_limit = 3;
$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
if($page < 1) { $page = 1; }
$count = $page*Pagination::$limit-Pagination::$limit;
$result = q("
SELECT COUNT(*)
FROM `news`
WHERE `cat_id` = '".(int)$row2['id']."'
");
$posts = $result->fetch_row();//всего записей в таблице
$news = q("
    SELECT *
    FROM `news`    
    WHERE `cat_id` = '".(int)$row2['id']."'
    LIMIT ".$count.",".Pagination::$limit."        
");
$show_pages = Pagination::pages($posts, $page);
