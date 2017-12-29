<?php
Core::$META['title'] = 'Edit News';

$news = q("
    SELECT *
    FROM `news`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
");

if(!$news->num_rows){
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /admin/news");
    exit();
}
$row = $news->fetch_assoc();

if(isset ($_POST['edit'], $_POST['title'], $_POST['full_text'], $_POST['short_text'])) {
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if (empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили заголовок новости!';
    }

    if (empty ($_POST['full_text'])) {
        $errors['full_text'] = 'Вы не заполнили содержание новости!';
    }
    if (empty ($_POST['short_text'])) {
        $errors['short_text'] = 'Вы не заполнили краткое описание новости!';
    }

    if ($_FILES['file']['error'] == 0) {
        //wtf($_FILES, 1);
        if (ImageUploading::upload($_FILES['file'])) {
            $img = ImageUploading::resize('.' . ImageUploading::$name, 800, 600);
            $avatar = ImageUploading::resize('.' . ImageUploading::$name, 200, 200);
        } else{
            $errors['file'] = ImageUploading::$errors;
        }
    }

    if (!count($errors)) {
        q("
        UPDATE `news` SET
        `title`      = '" . mresAll($_POST['title']) . "',
        `cat_id`     = '" . $_POST['category'] . "',        
        `full_text`  = '" . mresAll($_POST['full_text']) . "',
        `short_text` = '" . mresAll($_POST['short_text']) . "'
        " . ((isset($img)) ? ",`big_img` = '" . mresAll($img) . "'" : "") . "
        " . ((isset($avatar)) ? ",`image` = '" . mresAll($avatar) . "'" : "") . ",
        `date`       = NOW()
        WHERE `id`   = " . (int)$_GET['id'] . "
        ");
    }

    $news1 = q("
    SELECT *
    FROM `news`
    WHERE `id` = " . (int)$_GET['id'] . "
    LIMIT 1    
    ");
    $row5 = $news1->fetch_assoc();

    $cat1 = q("
        SELECT `name`
        FROM `news_category`
        WHERE `id` = " . (int)$row5['cat_id'] . "
    ");
    $row4 = $cat1->fetch_assoc();

    if ($row5['category'] != $row4['name']) {
        $_POST['category'] = $row4['name'];
        q("
            UPDATE `news` SET
            `category` = '" . $_POST['category'] . "'
            WHERE `id`     = " . (int)$_GET['id'] . "     
        ");
    }
    //wtf($_POST, 1);
    $_SESSION['info'] = 'Новость была изменена!';
     header("Location: /admin/news");
     exit();

}
//выбираем категорию
$cat = q("
    SELECT *
    FROM `news_category`
");

if(isset($_POST['delete_image'])){
    q("
        UPDATE `news` SET
        `image` = NULL,
        `big_img` = NULL -- или ''
        WHERE `id`  = ".(int)$_GET['key1']."        
    ");
    $_SESSION['info'] = 'изображение было удалено из базы данных!';
    header("Location: /admin/goods");
    exit();
}


/*if(isset ($_POST['edit'], $_POST['title'], $_POST['category'], $_POST['full_text'], $_POST['short_text'])) {
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
        mysqli_query($link1, "
        UPDATE `news` SET
        `title`        = '" . mysqli_real_escape_string($link1, $_POST['title']) . "',
        `category`     = '" . mysqli_real_escape_string($link1, $_POST['category']) . "',        
        `full_text`  = '" . mysqli_real_escape_string($link1, $_POST['full_text']) . "',
        `short_text`   = '" . mysqli_real_escape_string($link1, $_POST['short_text']) . "',        
        `date`         = NOW()
        WHERE `id`     = " . (int)$_GET['id'] . "
        ") or exit(mysqli_error($link1));
        $_SESSION['info'] = 'Новость была изменена!';
        header("Location: /admin/news");
        exit();
    }
}

$news = mysqli_query($link1, "
    SELECT *
    FROM `news`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
") or exit(mysqli_error($link1));

if(!mysqli_num_rows($news)){
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /admin/news");
    exit();
}

$row = mysqli_fetch_assoc($news);*/