<?php
Core::$META['title'] = 'Admin/Books';
if(isset($_POST['delete'])){
    if(isset($_POST['ids'])){
        foreach($_POST['ids'] as $k=>$v){
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',',$_POST['ids']);
        q("
        DELETE FROM `books`
        WHERE `id` IN(".$ids.")
    ");
        q("
        DELETE FROM `books2books_author`
        WHERE `book_id` IN(".$ids.")
    ");
        $_SESSION['info'] = 'Книги были удалены из базы данных!';
        header("Location: /admin/books");
        exit();
    } else {
        $_SESSION['info'] = 'Не выбрано ни одной книги!';
        header("Location: /admin/books");
        exit();
    }
}

if(isset($_GET['key1'], $_GET['key2']) && $_GET['key1'] == 'delete'){
    q("
        DELETE FROM `books`
        WHERE `id` = ".(int)$_GET['key2']."        
    ");
    q("
        DELETE FROM `books2books_author`
        WHERE `book_id` = ".(int)$_GET['key2']." 
    ");
    $_SESSION['info'] = 'Книга была удалена из базы данных!';
    header("Location: /admin/books");
    exit();
}

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
   /* LIMIT 11*/
/*");*/


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
//wtf($authors1,1);
//wtf($books,1);
if(isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}





//wtf($books, 1);
/*$r = array();
$a = array($b=array($c=array($d=array(1=>555,'vvv'), 777), 'abc' ));
$r[$a[$b[$c[$d]]]] = $d;
wtf($r,1);

$bookss = array();
$row['id_book'] = 1;
$bookss[$row['id_book']] = $row;
wtf($bookss,1);*/
/*
$book = array(
    1 =>array(
        "id"     => 1,
        "title"  =>"Русалочка",
        "image"  =>"/uploaded/2017_01_29_19_36_42img69540.jpg",
        "price"  => 359.59,
        "author" => array(
            0 => array(
                "id" => 1,
                "name" => "Андерсен"
                ),
            1 => array(
                "id" => 2,
                "name" => "Пушкин"
                 )
         )
    ),
    2 => array(
        "id"     => 2,
        "title"  =>"Винни Пух",
        "image"  =>"/uploaded/2017_01_29_19_42_42img47878.jpg",
        "price"  => 456.99,
        "author" => array(
            0 => array(
                "id" => 3,
                "name" => "Алан Милн"
            )
        )
    ),

    3 =>array (
        "id"     => 3,
        "title"  =>"Бременские музыканты",
        "image"  =>"/uploaded/2017_01_29_19_44_00img23238.jpg",
        "price"  => 489.89,
        "author" => array(
            0 => array(
                "id" => 4,
                "name" => "Братья Гримм"
            ),
            1 => array(
                "id" => 5,
                "name" => "Ш. Перро"
            ),
            2 => array(
                "id" => 6,
                "name" => "Вильгельм Гауф"
            )
        )
    )
);      //  wtf( $book,1);

*/