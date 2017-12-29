<?php
Core::$META['title'] = 'Test stories';

$thisPage = 'tests';
require_once ('./skins/employment/menu.tpl');
$tests = q("
    SELECT *
    FROM `stories`
    WHERE `status` = 1
    AND `category` = 'test'
    ORDER BY `id`  DESC  
");
