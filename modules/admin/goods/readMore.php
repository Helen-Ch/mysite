<?php
Core::$META['title'] = 'Admin/Catalog';
if(isset($_POST['delete'])){
    q("
        DELETE FROM `goods`
        WHERE `id` = ".(int)$_GET['key1']."
    ");
    $_SESSION['info'] = 'товар был удален из базы данных!';
    header("Location: /admin/goods");
    exit();
}

if(isset($_GET['key1'],$_GET['key2']) && $_GET['key1'] == 'delete'){
    q("
        DELETE FROM `goods`
        WHERE `id` = ".(int)$_GET['key2']."        
    ");
    $_SESSION['info'] = 'товар был удален из базы данных!';
    header("Location: /admin/goods");
    exit();
}

$goods = q("
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
");

if(!$goods->num_rows){
    $_SESSION['info'] = 'данного товара не существует!';
    header("Location: /admin/goods");
    exit();
}

/*if(isset($_POST['delete'])){
    foreach($_POST['ids'] as $k=>$v){
        $_POST['ids'][$k] = (int)$v;
    }
    $ids = implode(',',$_POST['ids']);
    mysqli_query($link1, "
        DELETE FROM `news`
        WHERE `id` IN(".$ids.")
    ") or exit(mysqli_error($link1));
    $_SESSION['info'] = 'товары были удалены из базы данных!';
    header("Location: /admin/goods");
    exit();
}

if(isset($_GET['key1'],$_GET['key2']) && $_GET['key1'] == 'delete'){
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
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
") or exit(mysqli_error($link1));

if(!mysqli_num_rows($goods)){
    $_SESSION['info'] = 'данного товара не существует!';
    header("Location: /admin/goods");
    exit();
}

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}
*/
