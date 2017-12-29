<?php
Core::$META['title'] = 'Edit catalog';
//wtf($_POST,1);
//wtf($_POST['delete_image'],1);
$goods = q("
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
");
if(!$goods->num_rows){
    $_SESSION['info'] = 'данного товара не существует!';
    header("Location: /admin/goods");
    exit();
}
$row = $goods->fetch_assoc();

if(isset ($_POST['edit'], $_POST['title'],  $_POST['code'], $_POST['price'], $_POST['description'], $_POST['short_text'], $_POST['amount'])) {
    if(isset($_POST['delete_image'])) {
        q("
        UPDATE `goods` SET
        `image` = NULL,
        `big_img` = ''
        WHERE `id`  = " . (int)$_GET['key1'] . "        
    ");
    }
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if (empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили название товара!';
    }
    if (empty ($_POST['code'])) {
        $errors['code'] = 'Вы не заполнили код товара!';
    }
    if (empty ($_POST['price'])) {
        $errors['price'] = 'Введите цену товара!';
    }
    if (!empty($_POST['price']) && !is_numeric($_POST['price'])) {
        $errors['price'] = 'Неверный формат цены товара!';
    }
    if (empty ($_POST['description'])) {
        $errors['description'] = 'Вы не заполнили описание товара!';
    }
    if (empty ($_POST['short_text'])) {
        $errors['short_text'] = 'Вы не заполнили краткое описание товара!';
    }
    if (empty ($_POST['amount'])) {
        $errors['amount'] = 'Введите количество товара!';
    }

    if ($_FILES['file']['error'] == 0) {
        // wtf($_FILES,1);
       // $upload = ImageUploading::upload($_FILES['file']);
        if (ImageUploading::upload($_FILES['file'])) {
           /* if(ImageUploading::add_WM('.' . ImageUploading::$name)) {*/
                $img = ImageUploading::resize('.' . ImageUploading::$name, 800, 600);
                $avatar = ImageUploading::resize('.' . ImageUploading::$name, 200, 200);
           /* }*/
        } else{
            $errors['file'] = ImageUploading::$errors;
        }
    }

    if (!count($errors)) {
        q("
        UPDATE `goods` SET
        `title`        = '" . mresAll($_POST['title']) . "',        
        `cat_id`       = '" . $_POST['category'] . "',  
        `code`         =  " . (int)$_POST['code'] . ",
        `availability` = '" . mresAll($_POST['availability']) . "',
        `price`        =  " . (int)$_POST['price'] . ",
        `description`  = '" . mresAll($_POST['description']) . "',
        `short_text`   = '" . mresAll($_POST['short_text']) . "',
        `amount`       =  " . (int)$_POST['amount'] . "
        " . ((isset($img)) ? ",`big_img` = '" . mresAll($img) . "'" : "") . "
        " . ((isset($avatar)) ? ",`image` = '" . mresAll($avatar) . "'" : "") . ",
        `date`         = NOW()               
        WHERE `id`     = " . (int)$_GET['key1'] . "
    ");
        $goods1 = q("
        SELECT *
        FROM `goods`
        WHERE `id`     = " . (int)$_GET['key1'] . "
        LIMIT 1
        ");
        $row1 = $goods1->fetch_assoc();
        $cat1 = q("
        SELECT `name`
        FROM `goods_category`
        WHERE `id` = " . (int)$row1['cat_id'] . "
        LIMIT 1
    ");
        $row4 = $cat1->fetch_assoc();

        if ($row1['category'] != $row4['name']) {
            $_POST['category'] = $row4['name'];
            q("
            UPDATE `goods` SET
            `category` = '" . $_POST['category'] . "'
            WHERE `id`     = " . (int)$_GET['key1'] . "     
        ");
        }       // wtf($_POST,1);
        $_SESSION['info'] = 'Данные о товаре были изменены!';
        header("Location: /admin/goods");
        exit();
    }
}

//выбираем категорию
$cat = q("
    SELECT *
    FROM `goods_category`
");

/*if(isset($_POST['delete_image'])){ //если фото удаляется кнопкой submit
    q("
        UPDATE `goods` SET
        `image` = NULL,
        `big_img` = ''
        WHERE `id`  = ".(int)$_GET['key1']."        
    ");
    $_SESSION['info'] = 'изображение было удалено из базы данных!';
    header("Location: /admin/goods");
    exit();
}*/








/*
    if(!count($errors)) {
        mysqli_query($link1, "
        UPDATE `goods` SET
        `title`        = '" . mysqli_real_escape_string($link1, $_POST['title']) . "',
        `category`     = '" . mysqli_real_escape_string($link1, $_POST['category']) . "',
        `code`         =  " . (int)$_POST['code'] . ",
        `availability` = '" . mysqli_real_escape_string($link1, $_POST['availability']) . "',
        `price`        =  " . (int)$_POST['price'] . ",
        `description`  = '" . mysqli_real_escape_string($link1, $_POST['description']) . "',
        `short_text`   = '" . mysqli_real_escape_string($link1, $_POST['short_text']) . "',
        `amount`       =  " . (int)$_POST['amount'] . "
        ".((isset($img)) ? ",`big_img` = '".mresAll($img)."'" : "")."
        ".((isset($avatar)) ? ",`image` = '".mresAll($avatar)."'" : "").",
        `date`         = NOW()
               
        WHERE `id`     = " . (int)$_GET['key1'] . "
    ") or exit(mysqli_error($link1));
       $_SESSION['info'] = 'Данные о товаре были изменены!';
        header("Location: /admin/goods");
        exit();

    }
}

if(isset($_POST['delete_image'])){
    mysqli_query($link1, "
        UPDATE `goods`
        SET `image` = NULL -- или ''
        WHERE `id`  = ".(int)$_GET['key1']."        
    ") or exit(mysqli_error($link1));
   $_SESSION['info'] = 'изображение было удалено из базы данных!';
    header("Location: /admin/goods");
    exit();
}

$goods = mysqli_query($link1, "
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
") or exit(mysqli_error($link1));

if(!mysqli_num_rows($goods)){
    $_SESSION['info'] = 'данного товара не существует!';
    header("Location: /admin/goods");
    exit();
}

$row = mysqli_fetch_assoc($goods);
*/


