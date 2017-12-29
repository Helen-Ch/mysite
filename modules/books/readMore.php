<?php
Core::$META['title'] = 'Books';
//выбираем  книгу
$book1 = q("
    SELECT *
    FROM `books`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1 
");
if(!$book1->num_rows){
    $_SESSION['info'] = 'данной книги не существует!';
    header("Location: /books");
    exit();
}
$row_books = $book1->fetch_assoc();

//выбираем id авторов по id книги
$l = q("
    SELECT `author_id`
    FROM `books2books_author`  
    WHERE `book_id` = ".(int)$row_books['id']."
");

//помещаем id авторов в массив
$author = array();
while ($row_l = $l->fetch_assoc()){
    $author[] = $row_l['author_id'];
}

//выбираем нужных авторов
$authors = q("
    SELECT *
    FROM `books_author`
    WHERE `id` IN (".implode(",",$author).")
");

$author1 = array();
while($row_authors = $authors->fetch_assoc()) {
    $author1[$row_authors['id']] = $row_authors;
}

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}