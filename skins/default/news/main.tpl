<div class="goods">
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php }
    if($cat->num_rows) { ?>
        <p>Всего категорий новостей на сайте <?php echo $cat->num_rows;?></p>
        <?php while($row2 = $cat->fetch_assoc()){ ?>
            <a class="title cat" href="/news/cat_news/<?php echo $row2['name']; ?>"><?php echo htmlspecialchars($row2['name']); ?></a>
        <?php } } ?>
        <div class="clear"></div>
        <hr>
    <?php if($news->num_rows) { ?>
        <p>Всего новостей <?php echo $posts[0];?> (<?php echo $news->num_rows;?> на странице )</p>
        <hr>
        <?php while($row = mysqli_fetch_assoc($news)){ ?>
            <p><a class="title" href="/news/readMore?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                <span><?php echo $row['date']; ?></span>
            </p>
            <div class="goods_image">
                <a href="/news/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']); ?>" alt="image"></a>
            </div>
            <div class="category">
                <p>Категория:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                <p><span><?php echo nl2br(htmlspecialchars($row['short_text'])); ?></span></p>
                <p><a class="title" href="/news/readMore?id=<?php echo $row['id']; ?>">Читать далее >></a>
            </div>
            <div class="clear"></div>
            <hr>
        <?php }
    } else {
        echo '<p>Новостей нет</p>';
    }
    $news->close();
    ?>
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
</div>