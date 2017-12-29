<?php
Core::$META['title'] = 'Admin/NEWS';
//wtf($_POST, 1);

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

if(isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete'){
    q("
        DELETE FROM `news`
        WHERE `id` = ".(int)$_GET['key2']."        
    ");
    $_SESSION['info'] = 'новость была удалена из базы данных!';
    header("Location: /admin/news");
    exit();
}
//выбираем категорию
$cat = q("
        SELECT *
        FROM `news_category`
        WHERE `name` = '".mresAll($_GET['key1'])."'
        LIMIT 1
        ");
if(!$cat->num_rows){
    $_SESSION['info'] = 'данной категории не существует!';
    header("Location: /admin/news");
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

/*//выбираем news без пагинации
$news = q("
    SELECT *
    FROM `news` 
    WHERE `cat_id` = '".(int)$row2['id']."'
    ORDER BY `id`    
");
*/
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}