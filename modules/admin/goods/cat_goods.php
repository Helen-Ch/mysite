<?php
Core::$META['title'] = 'Admin/Catalog';
//wtf($_POST, 1);
if(isset($_POST['delete'])){
    if(!empty($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
        DELETE FROM `goods`
        WHERE `id` IN(" . $ids . ")
    ");
        $_SESSION['info'] = 'товары были удалены из базы данных!';
        header("Location: /admin/goods");
        exit();
    } else{
        $_SESSION['info'] = 'Вы не выбрали товары для удаления!';
        header("Location: /admin/goods");
        exit();
    }
}

if(isset($_GET['key1'], $_GET['key2']) && $_GET['key1'] == 'delete'){
    q("
        DELETE FROM `goods`
        WHERE `id` = ".(int)$_GET['key2']."        
    ");
    $_SESSION['info'] = 'товар был удален из базы данных!';
    header("Location: /admin/goods");
    exit();
}
//выбираем категорию
$cat = q("
        SELECT *
        FROM `goods_category`
        WHERE `name` = '".mresAll($_GET['key1'])."'
        ");
if(!$cat->num_rows){
    $_SESSION['info'] = 'данной категории не существует!';
    header("Location: /admin/goods");
    exit();
}
$row2 = $cat->fetch_assoc();
//выбираем товар
$goods = q("
    SELECT *
    FROM `goods` 
    WHERE `cat_id` = '".(int)$row2['id']."'
    ORDER BY `id`    
");


/*
  $goods = q("
    SELECT *
    FROM `goods`
       WHERE `cat_id` IN (SELECT `id`
    FROM `goods_category`
    WHERE `name`= '".mresAll($_GET['key1'])."')
    ORDER BY `id`
");


   $goods = q("
    SELECT `goods`.*
    FROM `goods` JOIN  `goods_category`
    ON `goods`.`cat_id` =  `goods_category`.`id`
    WHERE `goods_category`.`name` = '".mresAll($_GET['key1'])."'
    ORDER BY `goods`.`id` 
    
");



//вывод товаров по категориям через checkbox
/*if(isset($_POST['category'])) {
    $goods = q("
       SELECT *
       FROM `goods`
       WHERE `category` = '" . mresAll($_POST['cat']) . "'
    ");
  //  wtf($goods,1);
}else {
    $goods = q("
    SELECT *
    FROM `goods`
    ORDER BY `id`    
");
  //  wtf($goods,1);
}*/











//без класса DB
/*if(isset($_POST['delete'])){
    foreach($_POST['ids'] as $k=>$v){
        $_POST['ids'][$k] = (int)$v;
    }
    $ids = implode(',',$_POST['ids']);
    mysqli_query($link1, "
        DELETE FROM `goods`
        WHERE `id` IN(".$ids.")
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'товары были удалены из базы данных!';
    header("Location: /admin/goods");
    exit();
}

if(isset($_GET['key1'], $_GET['key2']) && $_GET['key1'] == 'delete'){
    mysqli_query($link1, "
        DELETE FROM `goods`
        WHERE `id` = ".(int)$_GET['key2']."        
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'товар был удален из базы данных!';
    header("Location: /admin/goods");
    exit();
}

$goods = mysqli_query($link1, "
    SELECT *
    FROM `goods`
    ORDER BY `id`    
") or exit(mysqli_error($link1));

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}*/