<div class="goods">
    <?php if($goods->num_rows) { ?>
        <p>Товаров на сайте <?php echo $goods->num_rows ?></p>
        <hr>
        <?php while($row = $goods->fetch_assoc()){ ?>
            <p><a class="title" href="/goods"><?php echo htmlspecialchars($row['title']); ?></a>
            <span><?php echo $row['date']; ?></span>
            </p>
            <div class="goods_image">
                <a href="/goods/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']);?>" alt="image"></a>
            </div>
            <div class="category">
                <p>Категория товара:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                <p>Код:               <span><?php echo htmlspecialchars($row['code']); ?></span></p>
                <p>Описание товара:   <span><?php echo nl2br(htmlspecialchars($row['description'])); ?></span></p>
                <p>Цена:              <span><?php echo number_format(htmlspecialchars($row['price'])/100,2,',',' '); ?> грн.</span></p>
                <p>Наличие на складе: <span><?php if($row['availability'] == 0){echo 'товар временно отсутствует';}else {echo 'да';} ?></span></p>
            </div>
            <div class="clear"></div>
            <hr>
        <?php }
            $goods->close();
    } else {
        echo '<p>Товары отсутствуют</p>';
    } ?>
</div>