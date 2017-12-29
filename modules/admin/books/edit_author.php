<?php
Core::$META['title'] = 'Edit Author';

$author = q("
    SELECT *
    FROM `books_author`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1    
");

if(!$author->num_rows){
    $_SESSION['info'] = 'данного автора не существует!';
    header("Location: /admin/books/authors");
    exit();
}

$row = $author->fetch_assoc();

if(isset ($_POST['edit'], $_POST['author'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['author'])) {
        $errors['author'] = 'Вы не заполнили имя автора!';
    }

    if(!count($errors)) {
        q("
        UPDATE `books_author` SET
        `author`      = '" . mresAll($_POST['author']) . "'        
        WHERE `id`   = " . (int)$_GET['id'] . "
        ");

        //  wtf($_POST,1);
        $_SESSION['info'] = 'Автор был изменен!';
        header("Location: /admin/books/authors");
        exit();
    }
}