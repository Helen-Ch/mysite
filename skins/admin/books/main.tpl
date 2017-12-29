<div class="goods">
   <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
   <?php } ?>
   <a href="/admin/books/add" class="cat">добавить книгу</a>
   <a href="/admin/books/authors">Добавить/Редактировать автора</a>
   <div class="clear"></div>
   <hr>
   <?php if($book->num_rows) { ?>
       <p>Всего книг <?php echo $posts[0];?> (<?php echo $book->num_rows;?> на странице )</p>
       <form action="" method="post" onsubmit="return del();">
       <?php foreach($books as $book_id) { ?>
           <div><input type="checkbox" name="ids[]" value="<?php echo $book_id['id']; ?>">
               <a href="/admin/books/edit/<?php echo $book_id['id']; ?>">Редактировать</a>
               <a href="/admin/books/main/delete/<?php echo $book_id['id']; ?>" onclick="return del();">Удалить</a>
               <p><a class="title" href="/admin/books/edit/<?php echo $book_id['id']; ?>"><?php echo hscAll($book_id['title']); ?></a></p>
           </div>
           <div class="goods_image">
               <a href="/admin/books/readMore/<?php echo $book_id['id']; ?>"><img src="<?php echo hscAll($book_id['image']); ?>" alt="image"></a>
           </div>
           <div class="category">
               <p> Цена: <?php echo number_format(hscAll($book_id['price'])/100,2,',',' '); ?> грн.</p>
               <?php if(isset($book_id['author'])){
                   end($book_id['author']);
                   $last = key($book_id['author']);
                   foreach ($book_id['author'] as $k => $authors){ ?>
                       <a href="/admin/books/author_list/<?php echo $authors['author_id']; ?>">
                       <?php foreach($authors1 as $k1 => $v1){ if($k1 == $authors['author_id']){ echo hscAll($v1); } } if($k != $last){ echo ', '; } ?>
                       </a>
               <?php } } ?>
               <p><a class="title" href="/admin/books/readMore/<?php echo $book_id['id']; ?>">Полное описание >></a>
           </div>
           <div class="clear"></div>
           <hr>
       <?php  } ?>
           <input type="submit" name="delete" value="Удалить отмеченные книги" class="button_goods">
       </form>
   <?php } else {
       echo '<p>Книги отсутствуют</p>';
   }
   $book->close(); ?>
   <div class="pag">
       <?php foreach($show_pages as $p){
           echo $p;
       } ?>
   </div>
</div>