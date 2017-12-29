<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
    <?php }
    if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) && !isset($_SESSION['info'])){
        if($cat->num_rows) { ?>
            <p>Всего категорий новостей на сайте <?php echo $cat->num_rows;?></p>
        <?php } ?>
        <form action="" method="post" >
            <table class="formtable">
                <tr>
                    <td>Добавить категорию</td>
                    <td><input type="text" name="name" size="45" value="<?php if(isset($_POST['name'])) {echo htmlspecialchars($_POST['name']);} ?>"></td>
                    <td><?php if(isset($errors['name'])) {echo $errors['name'];} ?></td>
                </tr>
            </table>
            <input type="submit" name="add" value="добавить" class="button-hello send">
        </form>
        <hr>
        <form action="" method="post" onsubmit="return del();">
        <?php while($row = $cat->fetch_assoc()){ ?>
            <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
                <a href="/admin/news/edit_cat?id=<?php echo $row['id']; ?>">Редактировать</a>
                <a href="/admin/news/category?action=delete&id=<?php echo $row['id']; ?>" onclick="return del();">Удалить</a>
                <p><a class="title" href="/admin/news/edit_cat?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></a></p>
            </div>
            <hr>
        <?php }  ?>
        <input type="submit" name="delete" value="Удалить отмеченные категории" class="button_goods">
    </form>
    <?php } else {
        echo '<p>Категорий нет</p>';
    } ?>
</div>