<?php
Core::$META['title'] = 'Catalog';
$goods = q("
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
");

if(!$goods->num_rows){
    $_SESSION['info'] = 'данного товара не существует!';
    header("Location: /goods/main");
    exit();
}

/*$goods = mysqli_query($link1, "
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$_GET['id']."
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
}*/