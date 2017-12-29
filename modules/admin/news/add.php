<?php
Core::$META['title'] = 'Add News';
if(isset ($_POST['add'], $_POST['title'], $_POST['category'], $_POST['full_text'],$_POST['short_text'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили заголовок новости!';
    }
    if(empty ($_POST['category'])) {
        $errors['category'] = 'Вы не заполнили категорию новости!';
    }
    if(empty ($_POST['full_text'])) {
        $errors['full_text'] = 'Вы не заполнили содержание новости!';
    }
    if(empty ($_POST['short_text'])) {
        $errors['short_text'] = 'Вы не заполнили краткое описание новости!';
    }

    if ($_FILES['file']['error'] == 0) {

        if (ImageUploading::upload($_FILES['file'])) {
            $img    = ImageUploading::resize('.'.ImageUploading::$name, 800, 600);
            $avatar = ImageUploading::resize('.'.ImageUploading::$name, 200, 200);
        } else{
            $errors['file'] = ImageUploading::$errors;
        }
    }else{
        $errors['file'] = 'Вы не загрузили файл!';
    }

    if(!count($errors)) {
        q("
            INSERT INTO `news` SET
            `title`      = '".mresAll($_POST['title'])."',
            `category`   = '".mresAll($_POST['category'])."',                 
            `full_text`  = '".mresAll($_POST['full_text'])."',
            `short_text` = '".mresAll($_POST['short_text'])."', 
            `image`        = '" . mresAll($avatar) . "',
            `big_img`      = '" . mresAll($img) . "',
            `date`       = NOW()
        ");
    }
}

$id = DB::_()->insert_id;
//echo $id;

//выбираем категорию
$cat = q("
    SELECT *
    FROM `news_category`
");
$news = q("
    SELECT *
    FROM `news`
    WHERE `id` = ".(int)$id."
    LIMIT 1    
");
$row = $news->fetch_assoc();
//wtf($goods,1);
$cat1 = q("
    SELECT *
    FROM `news_category`
    WHERE `name` = '".mresAll($row['category'])."'
");
$row4 = $cat1->fetch_assoc();



if ($row['cat_id'] != $row4['id']) {
    $_POST['category'] = $row4['id'];
    q("
    UPDATE `news` SET
    `cat_id` = '" . $_POST['category'] . "'
    WHERE `id`     = " . (int)$id . " 
      
    "); //wtf($_POST,1);
    $_SESSION['info'] = 'новость добавлена!';
    header("Location: /admin/news");
    exit();
}



/*if(isset ($_POST['add'], $_POST['title'], $_POST['category'], $_POST['full_text'],$_POST['short_text'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили заголовок новости!';
    }
    if(empty ($_POST['category'])) {
        $errors['category'] = 'Вы не заполнили категорию новости!';
    }
    if(empty ($_POST['full_text'])) {
        $errors['full_text'] = 'Вы не заполнили содержание новости!';
    }
    if(empty ($_POST['short_text'])) {
        $errors['short_text'] = 'Вы не заполнили краткое описание новости!';
    }
    if(!count($errors)) {
        mysqli_query($link1,
            "INSERT INTO `news` SET
            `title`        = '".mysqli_real_escape_string($link1, $_POST['title'])."',
            `category`     = '".mysqli_real_escape_string($link1, $_POST['category'])."',                 
            `full_text`  = '".mysqli_real_escape_string($link1, $_POST['full_text'])."',
            `short_text`   = '".mysqli_real_escape_string($link1, $_POST['short_text'])."',            
            `date`         = NOW()
            ") or exit(mysqli_error($link1));
        $_SESSION['info'] = 'новость добавлена!';
        header("Location: /admin/news");
        exit();
    }
}*/