<?php
Core::$META['title'] = 'Author_list';
$author = q("
    SELECT *
    FROM `books_author`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1 
");
if(!$author->num_rows){
    $_SESSION['info'] = 'данного автора не существует!';
    header("Location: /books");
    exit();
}
$row = $author->fetch_assoc();
$ab = q("
    SELECT `book_id`
    FROM `books2books_author`  
    WHERE `author_id` = ".(int)$row['id']."
");
$list = array();
while ($row_ab = $ab->fetch_assoc()){
    $list[] = $row_ab['book_id'];
}

$books = q("
    SELECT *
    FROM `books`
    WHERE `id` IN (".implode(",",$list).")
");
$allbook = array();
while($row_b = $books->fetch_assoc()){
    $allbook[$row_b['id']] = $row_b;
}
$ab1 =  q("
    SELECT *
    FROM `books2books_author`  
    WHERE `book_id` IN (".implode(",",$list).")
");

//дописываем авторов в книги
while ($row_ab1 = $ab1->fetch_assoc()){
    $allbook[$row_ab1['book_id']]['author'][$row_ab1['author_id']]= $row_ab1;
}
//wtf($allbook,1);
//выбираем  авторов
$authors = q("
    SELECT *
    FROM `books_author`
");
//массив авторов
$authors2 = array();
while($row_a2 = $authors->fetch_assoc()) {
    $authors2[$row_a2['id']] = $row_a2['author'];
}
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}