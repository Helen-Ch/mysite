<?php
Core::$META['title'] = 'Admin/Books';
//выбираем  книгу
$book1 = q("
    SELECT *
    FROM `books`
    WHERE `id` = ".(int)$_GET['key1']."
    LIMIT 1 
");
if(!$book1->num_rows){
    $_SESSION['info'] = 'данной книги не существует!';
    header("Location: /admin/books");
    exit();
}
$row_books = $book1->fetch_assoc();
//wtf($row_books,1);

//выбираем id авторов по id книги
$l = q("
    SELECT `author_id`
    FROM `books2books_author`  
    WHERE `book_id` = ".(int)$row_books['id']."
");
//wtf($l,1);

//помещаем id авторов в массив
$author = array();
while ($row_l = $l->fetch_assoc()){
    $author[] = $row_l['author_id'];
}
//wtf($author,1);

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
//wtf($author1,1);

if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}