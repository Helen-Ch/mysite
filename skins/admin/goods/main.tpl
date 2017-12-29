<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
    <?php } ?>
    <p><a href="/admin/goods/add">добавить товар</a><br></p>
    <hr>
    <?php if($cat->num_rows) { ?>
        <p>Всего категорий товаров на сайте <?php echo $cat->num_rows;?></p>
    <?php while($row2 = $cat->fetch_assoc()){ ?>
        <div>
            <p><a class="title cat" href="/admin/goods/cat_goods/<?php echo $row2['name']; ?>"><?php echo htmlspecialchars($row2['name']); ?></a></p>
        </div>
    <?php } } ?>
    <div class="clear"></div>
    <hr>
    <form action="" method="post" onsubmit="return del();">
        <?php if($goods->num_rows) { ?>
            <p>Товаров на сайте <?php echo $goods->num_rows;?></p>
            <?php while($row = $goods->fetch_assoc()){ ?>
                <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
                    <a href="/admin/goods/edit/<?php echo $row['id']; ?>">Редактировать</a>
                    <a href="/admin/goods/main/delete/<?php echo $row['id']; ?>" onclick="return del();">Удалить</a>
                    <p><a class="title" href="/admin/goods/edit/<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                        <span><?php echo $row['date']; ?></span>
                    </p>
                </div>
                <div class="goods_image">
                    <a href="/admin/goods/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']); ?>" alt="image"></a>
                </div>
                <div class="category">
                    <p>Категория товара:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                    <p>№ категории:      <span><?php echo htmlspecialchars($row['cat_id']); ?></span></p>
                    <p>Код:               <span><?php echo htmlspecialchars($row['code']); ?></span></p>
                    <p>Описание товара:   <span><?php echo nl2br(htmlspecialchars($row['short_text'])); ?></span></p>
                    <p>Цена:              <span><?php echo number_format(htmlspecialchars($row['price'])/100,2,',',' '); ?> грн.</span></p>
                    <p>Наличие на складе: <span><?php if($row['availability'] == 0){echo 'товар временно отсутствует';}else {echo 'да';} ?></span></p>
                    <p><a class="title" href="/admin/goods/readMore/<?php echo $row['id']; ?>">Полное описание >></a>
                </div>
                <div class="clear"></div>
                <hr>
            <?php }
        } else {
            echo '<p>Товары отсутствуют</p>';
        }
        $goods->close();
        ?>
        <input type="submit" name="delete" value="Удалить отмеченные товары" class="button_goods">
    </form>
</div>