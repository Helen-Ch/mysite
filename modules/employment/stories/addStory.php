<?php
Core::$META['title'] = 'Add new story';

$thisPage = 'addStory';

if(isset ($_POST['publish'], $_POST['author_name'],$_POST['category'], $_POST['header'], $_POST['short_text'], $_POST['text'])) {
	foreach ($_POST as $k => $v) {
		if (!is_array($_POST[$k])) {
			$_POST[$k] = trim($v);
		}
	}
	$errors = array();
	if (empty($_POST['author_name'])) {
		$errors['author_name'] = 'Укажите имя!';
	} elseif (mb_strlen($_POST['author_name']) < 2){
		$errors['author_name'] = 'Имя слишком короткое!';
	} elseif (mb_strlen($_POST['author_name']) > 16 ){
		$errors['author_name'] = 'Имя слишком длинное!';
	}

	if (empty($_POST['header'])) {
		$errors['header'] = 'Вы не заполнили название истории!';
	}

	if (empty($_POST['short_text'])) {
		$errors['short_text'] = 'Укажите коротко о чем Ваше сообщение!';
	}
	if (empty($_POST['text'])) {
		$errors['text'] = 'Вы не заполнили содержание истории!';
	}

	if (!count($errors)) {
		q("
            INSERT INTO `stories` SET
            `author_name` = '" . es($_POST['author_name']) . "',
            `author_id`   = ".(int)User::$id.",
            `header`      = '" . es($_POST['header']) . "',           
            `short_text`  = '" . es($_POST['short_text']) . "',            
            `text`        = '" .es($_POST['text']) . "',
            `status`      = 0,
            `category`    = '".$_POST['category']."',
             `date`       = NOW()               
            ");

		$id = DB::_()->insert_id;
		  $_SESSION['info'] = 'История добавлена!';
		  header("Location: /employment/stories/preview/$id");
		  exit();
	}
}

if(isset($_GET['key1'])) {
	$myStory = q("
    SELECT *
    FROM `stories`
    WHERE `id` = " . (int)$_GET['key1'] . "
    AND `status` = 0
    LIMIT 1 
");
	if ($myStory->num_rows) {
		$row = $myStory->fetch_assoc();
	}
	q("
            UPDATE `stories` SET            
            `deleted`   = 1,
             `date`     = NOW()
             WHERE `id` = ".(int)$_GET['key1']."            	
            ");
}