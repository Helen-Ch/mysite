<?php
Core::$META['title'] = 'Admin/Catalog';
//выбираем категорию
$cat = q("
        SELECT *
        FROM `goods_category`
        WHERE `name` = '".mresAll($_GET['key1'])."'
        ");
if(!$cat->num_rows){
    $_SESSION['info'] = 'данной категории не существует!';
    header("Location: /goods");
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