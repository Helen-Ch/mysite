<div class="goods">
    <?php if($news->num_rows) {
        while($row = $news->fetch_assoc()){ ?>
            <p class="img"><a href="/news"><img src="<?php echo hscAll($row['big_img']); ?>" alt="image"></a></p>
    <?php }} ?>
</div>