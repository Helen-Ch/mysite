<div class="goods">
    <?php if($news->num_rows) { ?>
        <p>Всего новостей <?php echo $news->num_rows ?></p>
        <hr>
        <?php while($row = $news->fetch_assoc()){ ?>
            <p><a class="title" href="/news"><?php echo htmlspecialchars($row['title']); ?></a>
                <span><?php echo $row['date']; ?></span>
            </p>
            <div class="goods_image">
                <a href="/news/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']); ?>" alt="image"></a>
            </div>
            <div class="category">
                <p>Категория:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                <p><span><?php echo nl2br(htmlspecialchars($row['full_text'])); ?></span></p>
            </div>
            <div class="clear"></div>
            <hr>
        <?php }
    } else {
        echo '<p>Новостей нет</p>';
    }
    $news->close();
    ?>
</div>