<?php
Core::$META['title'] = 'Admin/News/Cat';

if(isset($_POST['delete'])){
    if(!empty($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
        DELETE FROM `news_category`
        WHERE `id` IN(" . $ids . ")
    ");
        $_SESSION['info'] = 'категории были удалены из базы данных!';
        header("Location: /admin/news/category");
        exit();
    } else{
        $_SESSION['info'] = 'Вы не выбрали категории для удаления!';
        header("Location: /admin/news/category");
        exit();
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    q("
        DELETE FROM `news_category`
        WHERE `id` = ".(int)$_GET['id']."        
    ");
    $_SESSION['info'] = 'категория была удалена из базы данных!';
    header("Location: /admin/news/category");
    exit();
}

//выбираем категорию
$cat = q("
    SELECT *
    FROM `news_category`
    ORDER BY `id`
");


if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}




if(isset ($_POST['add'], $_POST['name'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['name'])) {
        $errors['name'] = 'Вы не заполнили название категории!';
    }

    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `news_category`
            WHERE `name` = '" . mresAll($_POST['name']) . "'
            LIMIT 1
        ");
        if ($res->num_rows) {
            $errors['name'] = 'Такая категория уже существует!';
        }
        $res->close();
    }
    if(!count($errors)) {
        q("
            INSERT INTO `news_category` SET
            `name`      = '".mresAll($_POST['name'])."'          
        ");       // wtf($_POST,1);
       $_SESSION['info'] = 'Категория добавлена!';
        header("Location: /admin/news/category");
        exit();
    }
}