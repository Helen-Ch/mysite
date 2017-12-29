<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php } ?>
    <a href="/goods">все товары</a>
    <hr>
    <?php if($goods->num_rows) { ?>
        <p>Товаров категории <?php echo $row2['name'].': '.$goods->num_rows;?></p>
        <hr>
        <?php while($row = $goods->fetch_assoc()){ ?>
            <div>
                <p><a class="title" href="/goods"><?php echo htmlspecialchars($row['title']); ?></a><span><?php echo $row['date']; ?></span>
                </p>
            </div>
            <div class="goods_image">
                <a href="/goods/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']); ?>" alt="image"></a>
            </div>
            <div class="category">
                <p>Категория товара:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                <p>Код:               <span><?php echo htmlspecialchars($row['code']); ?></span></p>
                <p>Описание товара:   <span><?php echo nl2br(htmlspecialchars($row['short_text'])); ?></span></p>
                <p>Цена:              <span><?php echo number_format(htmlspecialchars($row['price'])/100,2,',',' '); ?> грн.</span></p>
                <p>Наличие на складе: <span><?php if($row['availability'] == 0){echo 'товар временно отсутствует';}else {echo 'да';} ?></span></p>
                <p><a class="title" href="/goods/readMore?id=<?php echo $row['id']; ?>">Полное описание >></a>
            </div>
            <div class="clear"></div>
            <hr>
        <?php } ?>
    <?php } else {
        echo '<p>Товары отсутствуют</p>';
    }
    $goods->close();
    $cat->close(); ?>
</div>