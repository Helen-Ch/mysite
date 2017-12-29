<div class="goods">
    <a href="/admin/goods">все товары</a>
    <hr>
    <a href="/admin/goods/add">добавить товар</a><br>
    <hr>
    <?php if($goods->num_rows) { ?>
        <p>Товаров категории <?php echo $row2['name'].': '.$goods->num_rows;?></p><!-- wtf($row,1);-->
        <hr>
        <form action="" method="post" onsubmit="return del();">
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
                    <p>Код:               <span><?php echo htmlspecialchars($row['code']); ?></span></p>
                    <p>Описание товара:   <span><?php echo nl2br(htmlspecialchars($row['short_text'])); ?></span></p>
                    <p>Цена:              <span><?php echo number_format(htmlspecialchars($row['price'])/100,2,',',' '); ?> грн.</span></p>
                    <p>Наличие на складе: <span><?php if($row['availability'] == 0){echo 'товар временно отсутствует';}else {echo 'да';} ?></span></p>
                    <p><a class="title" href="/admin/goods/readMore/<?php echo $row['id']; ?>">Полное описание >></a>
                </div>
                <div class="clear"></div>
                <hr>
            <?php } ?>
        <input type="submit" name="delete" value="Удалить отмеченные товары" class="button_goods">
    </form>
    <?php } else {
        echo '<p>Товары отсутствуют</p>';
    }
    $goods->close();
    $cat->close(); ?>
</div>