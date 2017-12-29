<?php
Core::$META['title'] = 'Catalog';
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
/*$goods = mysqli_query($link1, "
    SELECT *
    FROM `goods`
    ORDER BY `id`    
") or exit(mysqli_error($link1));

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}*/