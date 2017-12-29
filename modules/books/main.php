<?php
Core::$META['title'] = 'Books';
$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
if($page < 1) { $page = 1; }
Pagination::$limit = 4;
$count = $page*Pagination::$limit-Pagination::$limit;

$result = q("SELECT COUNT(*) FROM `books`");
$posts = $result->fetch_row();
$result->close();
$book = q("
    SELECT *
    FROM `books`    
    ORDER BY `id`
    LIMIT ".$count.",".Pagination::$limit."        
");                                        //записей на странице

$show_pages = Pagination::pages($posts, $page);
/*$book = q("
    SELECT *
    FROM `books`
    ORDER BY `id`    
");*/

//массив книг
$books = array();
$list1 = array();
while($row = $book->fetch_assoc()) {
    $books[$row['id']] = $row;
    $list1[] = $row['id'];
}

//выбираем id авторов
$l = q("
    SELECT *
    FROM `books2books_author` 
    WHERE `book_id` IN (".implode(",",$list1).") 
");
//дописываем авторов в книги
$list2 = array();
while ($row_l = $l->fetch_assoc()){
    $list2[] = $row_l['author_id'];
    $books[$row_l['book_id']]['author'][$row_l['author_id']] = $row_l;
}
//выбираем  авторов
$authors = q("
    SELECT *
    FROM `books_author`
     WHERE `id` IN (".implode(",",$list2).")
");
//массив авторов
$authors1 = array();
while($row_a = $authors->fetch_assoc()) {
    $authors1[$row_a['id']] = $row_a['author'];
}
//wtf($books,1);
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}