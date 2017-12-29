<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php } ?>
    <p><?php echo $row['author'] ?></p>
    <?php if($books->num_rows){ ?>
        <p>Всего книг данного автора <?php echo $books->num_rows; ?></p>
        <?php foreach($allbook as $bookarray) { ?>
            <div class="goods_image">
                <a href="/admin/books"><img src="<?php echo hscAll($bookarray['image']); ?>" alt="image"></a>
            </div>
            <div class="category">
                <p><a class="title" href="/admin/books/readMore/<?php echo $bookarray['id']; ?>"><?php echo hscAll($bookarray['title']); ?></a></p>
                <p>Цена: <span><?php echo number_format(hscAll($bookarray['price'])/100,2,',',' '); ?> грн.</span></p>
                <?php  if(isset($bookarray['author'])){
                    end($bookarray['author']);
                    $last = key($bookarray['author']);
                    foreach($bookarray['author'] as $m => $n) { ?>
                        <a href="/admin/books/author_list/<?php echo $m; ?>">
                            <?php foreach($authors2 as $k5 => $v5){
                                if($k5 == $n['author_id']){
                                    echo hscAll($v5);
                                }
                            }
                            if($m != $last){ echo ', '; } ?>
                        </a>
                    <?php  }
                } ?>
            </div>
            <div class="clear"></div>
            <hr>
        <?php }
    } else {
        echo '<p>Книг нет</p>';
    } ?>
</div>