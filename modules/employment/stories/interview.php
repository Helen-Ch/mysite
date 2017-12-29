<?php
Core::$META['title'] = 'Interview stories';

$thisPage = 'interview';
require_once ('./skins/employment/menu.tpl');
$interviews = q("
    SELECT *
    FROM `stories`
    WHERE `status` = 1
    AND `category` = 'interview'
    ORDER BY `id`  DESC  
");