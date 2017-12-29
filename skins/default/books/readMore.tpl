<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
    <hr>
    <?php } ?>
    <?php if($book1->num_rows) { ?>
        <p>Всего книг выбрано <?php echo $book1->num_rows;  ?></p>
        <p><?php echo hscAll($row_books['title']); ?></p>
        <div class="goods_image">
            <a href="/books"><img src="<?php echo hscAll($row_books['big_img']); ?>" alt="image"></a>
        </div>
        <div class="category">
            <p>Цена: <span><?php echo number_format(hscAll($row_books['price'])/100,2,',',' '); ?> грн.</span></p>
            <?php  end($author1);
                $last = key($author1);
                foreach($author1 as $m => $n) { ?>
                    <a href="/books/author_list/<?php echo $n['id']; ?>"><?php echo hscAll($n['author']); if($m != $last){ echo ', '; } ?></a>
            <?php  }   ?>
            <p>Описание:   <span><?php echo nl2br(hscAll($row_books['description'])); ?></span></p>
        </div>
        <div class="clear"></div>
        <hr>
    <?php } else {
        echo '<p>Книг нет</p>';
    }
    $book1->close();  ?>
</div>