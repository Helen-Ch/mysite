<?php
Core::$META['title'] = 'Add new book';
//wtf($_POST,1);
//выбираем автора для вида
$author3 = q("
    SELECT *
    FROM `books_author`
");
if(isset ($_POST['add'], $_POST['title'], $_POST['price'], $_POST['description'])) {

  /* foreach ($_POST['author'] as $k1 => $v1) {
        $_POST['author'][$k1] = (int)$v1;
    }
    $_POST['author'] = implode(',', $_POST['author']);
    //wtf($_POST['author'],1);*/
    foreach ($_POST as $k => $v) {
        if (!is_array($_POST[$k])) {
            $_POST[$k] = trim($v);
        }
    }
    $errors = array();
    if (empty($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили название книги!';
    }

    if (empty($_POST['price'])) {
        $errors['price'] = 'Введите цену книги!';
    }
    if (!empty($_POST['price']) && !is_numeric($_POST['price'])) {
        $errors['price'] = 'Неверный формат цены книги!';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Вы не заполнили описание книги!';
    }
    if (!isset($_POST['author'])) {
        $errors['author'] = 'Укажите автора книги!';
    }

    if ($_FILES['file']['error'] == 0) {

        if (ImageUploading::upload($_FILES['file'])) {
            $img = ImageUploading::resize('.' . ImageUploading::$name, 300, 300);
            $avatar = ImageUploading::resize('.' . ImageUploading::$name, 200, 200);
        } else {
            $errors['file'] = ImageUploading::$errors;
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл!';
    }

    if (!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `books`
            WHERE `title` = '" . mresAll($_POST['title']) . "'
            LIMIT 1
        ");
        if ($res->num_rows) {
            $errors['title'] = 'Книга с таким названием уже существует в базе данных!';
        }
        $res->close();
    }
        if (!count($errors)) {
            q("
            INSERT INTO `books` SET
            `title`        = '" . mresAll($_POST['title']) . "',            
            `price`        =  " . (int)$_POST['price'] . ",
            `description`  = '" . mresAll($_POST['description']) . "',            
            `image`        = '" . mresAll($avatar) . "',
            `big_img`      = '" . mresAll($img) . "'           
            ");

            $id = DB::_()->insert_id;
           // $item = explode(',', $_POST['author']);

            /* foreach ($item as $v1){
                 q("
                 INSERT INTO `books2books_author` SET
                 `book_id`   = " .(int)$id . ",
                 `author_id` =  " . (int)$v1 . "
                 ");
             }*/
            $sql = 'INSERT INTO `books2books_author` (`book_id`, `author_id`) VALUES ';
            foreach ($_POST['author'] as $array) {// Дополняем SQL запрос
                $sql .= "(" . (int)$id . ", " . $array['author_id'] . "),";
            }
            // Отрезаем лишнюю запятую (последнюю)
            $sql = rtrim($sql, ',');
            // Тут записываем в БД
            q("$sql");

          /*  $_SESSION['info'] = 'книга добавлена!';
            header("Location: /admin/books");
            exit();*/
        }

}