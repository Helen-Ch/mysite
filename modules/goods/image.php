<?php
Core::$META['title'] = 'Catalog';
$goods = q("
    SELECT *
    FROM `goods`
    WHERE `id`  = ".(int)$_GET['key1']."
        LIMIT 1
");

