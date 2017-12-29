<div class="goods">
    <a href="/admin/news/add">добавить новость</a><br>
    <hr>
    <form action="" method="post" onsubmit="return del();">
        <?php if($news->num_rows) { ?>
            <p>Всего выбрано новостей <?php echo $news->num_rows; ?></p>
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
                    <p><span><?php echo nl2br(htmlspecialchars($row['full_text'])); ?></span></p>
                </div>
                <div class="clear"></div>
                <hr>

            <?php }
        } else {
            echo '<p>Новостей нет</p>';
        }
        $news->close(); ?>
        <input type="submit" name="delete" value="Удалить отмеченную новость" class="button_goods">
    </form>
</div>