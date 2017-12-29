<?php
Core::$META['title'] = 'Edit book';
//wtf($_POST,1);
//wtf($_POST['delete_image'],1);
//wtf($_POST['delete_author'],1);
$book = q("
    SELECT *
    FROM `books`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1    
");

if(!$book->num_rows){
    $_SESSION['info'] = 'данной книги не существует!';
    header("Location: /admin/books");
    exit();
}

$row = $book->fetch_assoc();

$l = q("
        SELECT `author_id`
        FROM `books2books_author`
        WHERE `book_id` = ".(int)$row['id']."
        ");

//помещаем id авторов в массив
$authors = array();
while ($aut = $l->fetch_assoc()) {
    $authors[] = $aut['author_id'];
}
//выбираем нужных авторов
$author = q("
    SELECT *
    FROM `books_author`
    WHERE `id` IN (" . implode(",", $authors) . ")
");
$author1 = q("
    SELECT *
    FROM `books_author`
    ORDER BY `id`
");

if (isset ($_POST['edit'], $_POST['title'], $_POST['price'], $_POST['description'])) {

    $errors = array();

    foreach ($_POST as $k => $v) {
        if (!is_array($_POST[$k])) {
            $_POST[$k] = trim($v);
        }
    }

    if (isset($_POST['delete_image'])) {
        q("
        UPDATE `books` SET
        `image` = NULL,
        `big_img` = NULL -- или ''
        WHERE `id`  = " . (int)$_GET['key1'] . "        
    ");
    }

    if (isset($_POST['delete_author'])) {
        foreach ($_POST['delete_author'] as $k1 => $v1) {
            $_POST['delete_author'][$k1] = (int)$v1;
        }
        $del_author = implode(',', $_POST['delete_author']);

        q("
        DELETE FROM `books2books_author`
        WHERE `author_id` IN(" . $del_author . ")
        AND `book_id` = " . (int)$_GET['key1'] . "
    ");
    }

    if (isset($_POST['add_author'])) {
        foreach ($_POST['add_author'] as $val) {
            $res = q("
            SELECT `author_id`
            FROM `books2books_author`
            WHERE `author_id` = '" . (int)$val . "'
            AND `book_id` = " . (int)$_GET['key1'] . "
            LIMIT 1
        ");
        }
        if ($res->num_rows) {
            $errors['author'] = 'Такой автор уже указан для данной книги!';
        } else {
            $sql = 'INSERT INTO `books2books_author` (`book_id`, `author_id`) VALUES ';

            foreach ($_POST['add_author'] as $array) {// Дополняем SQL запрос
                $sql .= "(" . (int)$_GET['key1'] . ", " . $array['author_id'] . "),";
            }
            // Отрезаем лишнюю запятую (последнюю)
            $sql = rtrim($sql, ',');

            // Тут записываем в БД
            q("$sql");
        }
        $res->close();
    }

    if (empty ($_POST['title'])) {
        $errors['title'] = 'Вы не заполнили название книги!';
    }
    if (empty ($_POST['price'])) {
        $errors['price'] = 'Введите цену книги!';
    }
    if (!empty($_POST['price']) && !is_numeric($_POST['price'])) {
        $errors['price'] = 'Неверный формат цены книги!';
    }
    if (empty ($_POST['description'])) {
        $errors['description'] = 'Вы не заполнили описание книги!';
    }

    if ($_FILES['file']['error'] == 0) {
        if (ImageUploading::upload($_FILES['file'])) {
            $img = ImageUploading::resize('.' . ImageUploading::$name, 300, 300);
            $avatar = ImageUploading::resize('.' . ImageUploading::$name, 200, 200);
        } else {
            $errors['file'] = ImageUploading::$errors;
        }
    }
    if (!count($errors)) {
        q("
        UPDATE `books` SET
        `title`        = '" . mresAll($_POST['title']) . "',        
        `description`  = '" . mresAll($_POST['description']) . "',
        `price`        = " . (int)$_POST['price'] . "
        " . ((isset($img)) ? ",`big_img` = '" . mresAll($img) . "'" : "") . "
        " . ((isset($avatar)) ? ",`image` = '" . mresAll($avatar) . "'" : "") . "                       
        WHERE `id`     = " . (int)$_GET['key1'] . "
    ");

        $_SESSION['info'] = 'Данные о книге были изменены!';
        header("Location: /admin/books/main");
        exit();
    }
}

