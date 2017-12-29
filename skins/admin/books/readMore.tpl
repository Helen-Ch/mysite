<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php } ?>
    <a href="/admin/books/add" class="cat">добавить книгу</a>
    <a href="/admin/books/authors">Добавить/Редактировать автора</a>
    <div class="clear"></div>
    <hr>
    <form action="" method="post" onsubmit="return del();">
        <div><input type="checkbox" name="ids[]" value="<?php echo $row_books['id']; ?>">
            <a href="/admin/books/edit/<?php echo $row_books['id']; ?>">Редактировать</a>
            <a href="/admin/books?action=delete&id=<?php echo $row_books['id']; ?>" onclick="return del();">Удалить</a>
            <p><a class="title" href="/admin/books/edit/<?php echo $row_books['id']; ?>"><?php echo hscAll($row_books['title']); ?></a></p>
        </div>
        <div class="goods_image">
            <a href="/admin/books"><img src="<?php echo hscAll($row_books['big_img']); ?>" alt="image"></a>
        </div>
        <div class="category">
            <p>Цена: <span><?php echo number_format(hscAll($row_books['price'])/100,2,',',' '); ?> грн.</span></p>
            <?php  end($author1);
                $last = key($author1);
                foreach($author1 as $m => $n) { ?>
                    <a href="/admin/books/author_list/<?php echo $n['id']; ?>"><?php echo hscAll($n['author']); if($m != $last){ echo ', '; } ?></a>
            <?php  }   ?>
            <p>Описание:   <span><?php echo nl2br(hscAll($row_books['description'])); ?></span></p>
        </div>
        <div class="clear"></div>
        <hr>
        <input type="submit" name="delete" value="Удалить отмеченные книги" class="button_goods">
    </form>
</div>