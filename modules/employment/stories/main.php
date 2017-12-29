<?php
Core::$META['title'] = 'Stories';

$thisPage = 'allStory';
require_once('./skins/employment/menu.tpl');

$all_stories = q("
    SELECT *
    FROM `stories`
    WHERE `status` = 1
    AND `deleted` <> 1
    ORDER BY `id`  DESC  
");

$unpublished = q("
    SELECT *
    FROM `stories`
    WHERE `author_id` = ".(int)User::$id."
    AND `status` = 0
    AND `deleted` <> 1
    LIMIT 1 
");
if($unpublished->num_rows){
	$row_un = $unpublished -> fetch_assoc();
}

if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}