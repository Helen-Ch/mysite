<?php
Core::$META['title'] = 'Story';
$stories = q("
    SELECT *
    FROM `stories`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
");
if ($stories->num_rows) {
	$row = $stories->fetch_assoc();
	if ($row['views'] == 0) {
		// Если еще не было посещений
		// Заносим в базу дату посещения и устанавливаем кол-во просмотров в значение 1
		q("
			UPDATE `stories` SET				
			`views`    = 1
			WHERE `id` = " . (int)$_GET['key1'] . "
		");
	} else {
		// Если посещения  уже были
		// Добавляем в базу  +1 просмотр
		q("
			UPDATE `stories` SET
			`views`=`views`+1
			WHERE `id` = ".(int)$_GET['key1']."
		");
	}
} elseif(!$stories->num_rows){
	$_SESSION['info'] = 'данной истории не существует!';
	header("Location: /employment/stories");
	exit();
}