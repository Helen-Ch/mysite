<?php
Core::$META['title'] = 'Add new good';
//wtf($_POST,1);
if(isset ($_POST['add'], $_POST['title'], $_POST['code'], $_POST['category'], $_POST['price'], $_POST['description'], $_POST['short_text'], $_POST['amount'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили название товара!';
    }
    if(empty ($_POST['code'])) {
        $errors['code'] = 'Вы не заполнили код товара!';
    }
   // $category = array('холодильники','телевизоры','стиральные машины');
   /* if(!in_array($_POST['category'], array('холодильники','телевизоры','стиральные машины'))) {
        $errors['category'] = 'Выберите категорию товара!';
    }*/

    if(empty($_POST['category'])) {
        $errors['category'] = 'Выберите категорию товара!';
    }
    if(!isset($_POST['availability'])) {
        $errors['availability'] = 'Отметьте наличие товара!';
    }
    if(empty ($_POST['price'])) {
        $errors['price'] = 'Введите цену товара!';
    }
    if(!empty($_POST['price']) && !is_numeric($_POST['price'])){
        $errors['price'] = 'Неверный формат цены товара!';
    }
    if(empty ($_POST['description'])) {
        $errors['description'] = 'Вы не заполнили описание товара!';
    }
    if(empty ($_POST['short_text'])) {
        $errors['short_text'] = 'Вы не заполнили краткое описание товара!';
    }
    if(empty ($_POST['amount'])) {
        $errors['amount'] = 'Введите количество товара!';
    }

    if ($_FILES['file']['error'] == 0) {

        if (ImageUploading::upload($_FILES['file'])) {
            $img    = ImageUploading::resize('.'.ImageUploading::$name, 800, 600);
            $avatar = ImageUploading::resize('.'.ImageUploading::$name, 200, 200);
        } else{
            $errors['file'] = ImageUploading::$errors;
        }
    } else{
        $errors['file'] = 'Вы не загрузили файл!';
    }
        if(!count($errors)) {
            q("
            INSERT INTO `goods` SET
            `title`        = '" . mresAll($_POST['title']) . "',
            `category`     = '" . mresAll($_POST['category']) . "',
            `code`         =  " . (int)$_POST['code'] . ",
            `availability` = '" . mresAll($_POST['availability']) . "',
            `price`        =  " . (int)$_POST['price'] . ",
            `description`  = '" . mresAll($_POST['description']) . "',
            `short_text`   = '" . mresAll($_POST['short_text']) . "',
            `amount`       =  " . (int)$_POST['amount'] . ",
            `image`        = '" . mresAll($avatar) . "',
            `big_img`      = '" . mresAll($img) . "',
            `date`         = NOW()
            ");
        }
}
$id = DB::_()->insert_id;
//echo $id;

//выбираем категорию
$cat = q("
    SELECT *
    FROM `goods_category`
");
$goods = q("
    SELECT *
    FROM `goods`
    WHERE `id` = ".(int)$id."
    LIMIT 1    
");
$row = $goods->fetch_assoc();
//wtf($goods,1);
$cat1 = q("
    SELECT *
    FROM `goods_category`
    WHERE `name` = '".mresAll($row['category'])."'
");
$row4 = $cat1->fetch_assoc();



if ($row['cat_id'] != $row4['id']) {
    $_POST['category'] = $row4['id'];
    q("
    UPDATE `goods` SET
    `cat_id` = '" . $_POST['category'] . "'
    WHERE `id`     = " . (int)$id . " 
      
    "); //wtf($_POST,1);
    $_SESSION['info'] = 'товар добавлен!';
    header("Location: /admin/goods");
    exit();
}



/*
       if(!count($errors)) {
       mysqli_query($link1,
           "INSERT INTO `goods` SET
           `title`        = '".mysqli_real_escape_string($link1, $_POST['title'])."',
           `category`     = '".mysqli_real_escape_string($link1, $_POST['category'])."',
           `code`         =  ".(int)$_POST['code'].",
           `availability` = '".mysqli_real_escape_string($link1,$_POST['availability'])."',
           `price`        =  ".(int)$_POST['price'].",
           `description`  = '".mysqli_real_escape_string($link1, $_POST['description'])."',
           `short_text`   = '".mysqli_real_escape_string($link1, $_POST['short_text'])."',
           `amount`       =  ".(int)$_POST['amount'].",
           `image`        = '".mresAll($avatar)."',
           `big_img`        = '".mresAll($img)."',
           `date`         = NOW()
           ") or exit(mysqli_error($link1));
       $_SESSION['info'] = 'товар добавлен!';
       header("Location: /admin/goods");
       exit();
   }*/