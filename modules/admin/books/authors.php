<?php
Core::$META['title'] = 'Admin/Books/Authors';
if(isset($_POST['delete'])){
    if(!empty($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
        DELETE FROM `books_author`
        WHERE `id` IN(" . $ids . ")
    ");
        q("
        DELETE FROM `books2books_author`
        WHERE `author_id` IN(" . $ids . ")
    ");
        $_SESSION['info'] = 'авторы были удалены из базы данных!';
        header("Location: /admin/books/authors");
        exit();
    } else{
        $_SESSION['info'] = 'Вы не выбрали авторов для удаления!';
        header("Location: /admin/books/authors");
        exit();
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    q("
        DELETE FROM `books_author`
        WHERE `id` = ".(int)$_GET['id']."        
    ");
    q("
        DELETE FROM `books2books_author`
        WHERE `author_id` = ".(int)$_GET['id']." 
    ");
    $_SESSION['info'] = 'автор был удален из базы данных!';
    header("Location: /admin/books/authors");
    exit();
}

if(isset ($_POST['add'], $_POST['author'])) {
    foreach($_POST as $k=>$v){
        $_POST[$k] = trim($v);
    }
    $errors = array();
    if(empty ($_POST['author'])) {
        $errors['author'] = 'Вы не заполнили имя автора!';
    }

    if(!count($errors)) {
        $res = q("
            SELECT `id`
            FROM `books_author`
            WHERE `author` = '" . mresAll($_POST['author']) . "'
            LIMIT 1
        ");
        if ($res->num_rows) {
            $errors['author'] = 'Такой автор уже существует!';
        }
        $res->close();
    }
    if(!count($errors)) {
        q("
            INSERT INTO `books_author` SET
            `author`  = '".mresAll($_POST['author'])."'          
        ");
        // wtf($_POST,1);
        $_SESSION['info'] = 'Автор добавлен!';
        header("Location: /admin/books/authors");
        exit();
    }
}
$author = q("
    SELECT *
    FROM `books_author`
    ORDER BY `id`
");
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}