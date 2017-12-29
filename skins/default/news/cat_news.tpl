<div class="goods">
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
    <a href="/news">все новости</a>
    <hr>
    <?php if($news->num_rows) { ?>
        <p>Новостей в категории  <?php echo $row2['name'].': '.$posts[0];?>(<?php echo $news->num_rows;?> на странице )</p>
        <hr>
        <?php while($row = $news->fetch_assoc()){ ?>
            <p><a class="title" href="/news/readMore?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a><span><?php echo $row['date']; ?></span></p>
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
    } ?>
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
</div>

