<?php
Core::$META['title'] = 'Admin/Users';
//wtf($_POST,1);
if(isset($_POST['delete'])){
    if(isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
        DELETE FROM `users`
        WHERE `id` IN(" . $ids . ")
    ");
        $_SESSION['info'] = 'пользователи были удалены из базы данных!';
        header("Location: /admin/users");
        exit();
    } else{
        $_SESSION['info'] = 'Вы не выбрали ни одного пользователя!';
        header("Location: /admin/users");
        exit();
    }
}

if(isset($_POST['find'], $_POST['search'])) {
    $users = q("
    SELECT *
    FROM `users`
    WHERE `login` LIKE '%".mresAll($_POST['search'])."%' 
    ORDER BY `login` ASC      
");
    if (!$users->num_rows) {
        $_SESSION['info'] = 'Пользователя с таким логином не существует!';
        header("Location: /admin/users");
        exit();
    } else {
        $_SESSION['info'] = 'Поиск прошел успешно!';
    }

}else {
    $users = q("
    SELECT *
    FROM `users`
   ORDER BY `login` ASC   
");

}
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}
/*if(isset($_POST['delete'])){
    foreach($_POST['ids'] as $k=>$v){
        $_POST['ids'][$k] = (int)$v;
    }
    $ids = implode(',',$_POST['ids']);
    q( "
        DELETE FROM `users`
        WHERE `id` IN(".$ids.")
    ");
    $_SESSION['info'] = 'пользователи были удалены из базы данных!';
    header("Location: /admin/users");
    exit();
}

if(isset($_POST['find'], $_POST['search'])) {
    $users = q("
    SELECT *
    FROM `users`
    WHERE `login` LIKE '%".mresAll($_POST['search'])."%' 
    ORDER BY `login` ASC      
");
    if (!mysqli_num_rows($users)) {
        $_SESSION['info'] = 'Пользователя с таким логином не существует!';
        header("Location: /admin/users");
        exit();
    } else {
        $_SESSION['info'] = 'Поиск прошел успешно!';
    }

}else {
    $users = q("
    SELECT *
    FROM `users`
   ORDER BY `login` ASC   
");

}
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}*/