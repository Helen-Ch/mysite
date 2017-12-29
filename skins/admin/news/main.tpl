<div class="goods">
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php } ?>
    <a href="/admin/news/add" class="cat">добавить новость</a>
    <a href="/admin/news/category" class="cat">изменить категорию</a>
    <div class="clear"></div>
    <hr>
    <?php  if($cat->num_rows) { ?>
        <p>Всего категорий новостей на сайте <?php echo $cat->num_rows;?></p>
        <?php while($row2 = $cat->fetch_assoc()){ ?>
            <a class="title cat" href="/admin/news/cat_news/<?php echo $row2['name']; ?>"><?php echo htmlspecialchars($row2['name']); ?></a>
        <?php } } ?>
    <div class="clear"></div>
    <hr>
    <?php if($news->num_rows) { ?>
        <p>Всего новостей <?php echo $posts[0];?> (<?php echo $news->num_rows;?> на странице )</p>
        <form action="" method="post" onsubmit="return del();">
            <?php while($row = $news->fetch_assoc()){ ?>
                <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
                    <a href="/admin/news/edit?id=<?php echo $row['id']; ?>">Редактировать</a>
                    <a href="/admin/news?action=delete&id=<?php echo $row['id']; ?>" onclick="return del();">Удалить</a>
                    <p><a class="title" href="/admin/news/edit?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                        <span><?php echo $row['date']; ?></span>
                    </p>
                </div>
                <div class="goods_image">
                    <a href="/admin/news/image/<?php echo $row['id']; ?>"><img src="<?php echo hscAll($row['image']); ?>" alt="image"></a>
                </div>
                <div class="category">
                    <p>Категория:  <span><?php echo htmlspecialchars($row['category']); ?></span></p>
                    <p><span><?php echo nl2br(htmlspecialchars($row['short_text'])); ?></span></p>
                    <p><a class="title" href="/admin/news/readMore/<?php echo $row['id']; ?>">Читать далее >></a>
                </div>
                <div class="clear"></div>
                <hr>
            <?php } ?>
            <input type="submit" name="delete" value="Удалить отмеченные новости" class="button_goods">
        </form>
    <?php } else {
        echo '<p>Новостей нет</p>';
    } ?>
    <div class="pag">
        <?php foreach($show_pages as $p){
           echo $p;
        } ?>
    </div>
</div>