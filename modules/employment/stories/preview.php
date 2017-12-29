<?php
Core::$META['title'] = 'Story preview';
Core::$JS[] = '<script src="/skins/employment/js/scripts2.js"></script>';

$myStory = q("
    SELECT *
    FROM `stories`
    WHERE `id` = ".(int)$_GET['key1']."
    AND `status` = 0
    LIMIT 1 
");

if($myStory->num_rows) {
	$row = $myStory->fetch_assoc();
}

if(isset ($_POST['publishOk'])) {

		q("
            UPDATE `stories` SET            
            `status`      = 1,
             `date`       = NOW()
             WHERE `id` = ".(int)$_GET['key1']."            	
            ");

		$id = DB::_()->insert_id;
		$_SESSION['info'] = 'Ваша история добавлена!';
		header("Location: /employment/stories");
		exit();


}