<?php
Core::$META['title'] = 'Admin/Catalog';

if(isset($_POST['delete'])){
    if(isset($_POST['ids'])){
    foreach($_POST['ids'] as $k=>$v){
        $_POST['ids'][$k] = (int)$v;
    }
    $ids = implode(',',$_POST['ids']);
    q("
        DELETE FROM `goods`
        WHERE `id` IN(".$ids.")
    ");
   $_SESSION['info'] = 'товары были удалены из базы данных!';
    header("Location: /admin/goods");
    exit();
} else {
        $_SESSION['info'] = 'Не выбрано ни одного товара!';
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
    ORDER BY `id`
");

$goods = q("
    SELECT *
    FROM `goods`
    ORDER BY `id` 
");

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}

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