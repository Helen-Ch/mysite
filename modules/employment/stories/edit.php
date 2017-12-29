<?php
Core::$META['title'] = 'Edit Story';

$ed = q("
    SELECT *
    FROM `stories`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
");

if(!$ed->num_rows){
	$_SESSION['info'] = 'данной истории не существует!';
	header("Location: /employment/stories");
	exit();
}
$row = $ed->fetch_assoc();

if(isset ($_POST['edit'], $_POST['author_name'], $_POST['header'], $_POST['short_text'], $_POST['text'])) {
	foreach ($_POST as $k => $v) {
		$_POST[$k] = trim($v);
	}
	$errors = array();
	if (empty ($_POST['author_name'])) {
		$errors['author_name'] = 'Вы не заполнили свое имя!';
	}

	if (empty ($_POST['header'])) {
		$errors['header'] = 'Вы не заполнили название истории!';
	}

	if (empty ($_POST['text'])) {
		$errors['text'] = 'Вы не заполнили содержание истории!';
	}
	if (empty ($_POST['short_text'])) {
		$errors['short_text'] = 'Вы не заполнили краткое описание истории!';
	}

	if (!count($errors)) {
		q("
        UPDATE `stories` SET
        `author_name`      = '" . es($_POST['author_name']) . "',
        `header`     = '" . es($_POST['header']) . "',        
        `short_text`  = '" . es($_POST['short_text']) . "',
        `text` = '" . es($_POST['text']) . "',        
        `date`       = NOW()
        WHERE `id`   = " . (int)$_GET['key1'] . "
        ");
	}

	//wtf($_POST, 1);
	$_SESSION['info'] = 'История была изменена!';
	header("Location: /employment/stories");
	exit();
}
if(isset($_POST['delete'])){
	q("
        UPDATE `stories` SET        
        `deleted` = 1 
        WHERE `id`  = ".(int)$_GET['key1']."        
    ");
	$_SESSION['info'] = 'История была удалена!';
	header("Location: /employment/stories");
	exit();
}