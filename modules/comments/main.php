<?php
Core::$META['title'] = 'Comments';
if(isset ($_POST['name'], $_POST['email'], $_POST['text'])) {
    $errors = array();
    if(empty ($_POST['name'])) {
        $errors['name'] = 'Вы не заполнили имя!';
    }
    if(empty ($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили e-mail!';
    }
    if(empty ($_POST['text'])) {
        $errors['text'] = 'Введите комментарий!';
    }
    if(!count($errors)) {
        q("
          INSERT INTO `comments` SET
          `name` = '" . mresAll($_POST['name']) . "',
          `email` = '" . mresAll($_POST['email']) . "',
          `text` = '" . mresAll($_POST['text']) . "'
        ");
        $_SESSION['commentok'] = 'Ok';
        header("Location: /comments");
        exit();
    }
}
$res = q("
          SELECT *
          FROM `comments`
          ORDER BY `id` DESC 
       ");
/*if(isset($_SESSION['commentok'])){
    echo 'ok';
    exit();
}*/
/*if(isset ($_POST['name'], $_POST['email'], $_POST['text'])) {
    $errors = array();
    if(empty ($_POST['name'])) {
        $errors['name'] = 'Вы не заполнили имя!';
    }
    if(empty ($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Вы не заполнили e-mail!';
    }
    if(empty ($_POST['text'])) {
        $errors['text'] = 'Введите комментарий!';
    }
    if(!count($errors)) {
        mysqli_query($link1,
            "INSERT INTO `comments` SET
            `name` = '" . mysqli_real_escape_string($link1, $_POST['name']) . "',
            `email` = '" . mysqli_real_escape_string($link1, $_POST['email']) . "',
            `text` = '" . mysqli_real_escape_string($link1, $_POST['text']) . "'
            ") or exit(mysqli_error($link1));
        $_SESSION['commentok'] = 'Ok';
        header("Location: /comments");
        exit();
    }
}
$res = mysqli_query($link1, "SELECT * FROM `comments` ORDER BY `id`") or exit(mysqli_error($link1));*/