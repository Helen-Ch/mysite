<div class="goods">
    <?php if($goods->num_rows) {
        while($row = $goods->fetch_assoc()){ ?>
            <p class="img"><a href="/goods/main"><img src="<?php echo hscAll($row['big_img']); ?>" alt="image"></a></p>
        <?php }
        $goods->close();
    } ?>
</div>