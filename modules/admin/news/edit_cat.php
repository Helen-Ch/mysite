<?php
Core::$META['title'] = 'Edit News category';

$cat = q("
    SELECT *
    FROM `news_category`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
");

if(!$cat->num_rows){
    $_SESSION['info'] = 'данной категории не существует!';
    header("Location: /admin/news/category");
    exit();
}

$row = $cat->fetch_assoc();

if(isset ($_POST['edit'], $_POST['name'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['name'])) {
        $errors['name'] = 'Вы не заполнили название категории!';
    }

    if(!count($errors)) {
        q("
        UPDATE `news_category` SET
        `name`      = '" . mresAll($_POST['name']) . "'        
        WHERE `id`   = " . (int)$_GET['id'] . "
        ");
    }
       $cat1 = q("
        SELECT *
        FROM `news_category`
        WHERE `name` = '" . mresAll($_POST['name']) . "'        
    ");
        $row4 = $cat1->fetch_assoc();
        $news = q("
        SELECT *
        FROM `news`
        WHERE `cat_id` = " . (int)$row4['id'] . "       
    ");
       $row1 = $news->fetch_assoc();

       if ($row1['category'] != $row4['name']) {
            $_POST['category'] = $row4['name'];
            q("
            UPDATE `news` SET
            `category` = '" .mresAll($_POST['category']). "'
            WHERE `cat_id`     = " . (int)$row4['id'] . "     
        ");
        }       //  wtf($_POST,1);
        $_SESSION['info'] = 'Категория была изменена!';
        header("Location: /admin/news/category");
        exit();
}