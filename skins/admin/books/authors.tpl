<div class="goods">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
    <?php }
    if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) && !isset($_SESSION['info'])){
        if($author->num_rows) { ?>
            <p>Всего авторов на сайте <?php echo $author->num_rows;?></p>
    <?php } ?>
    <form action="" method="post">
        <table class="formtable">
            <tr>
                <td>Добавить автора</td>
                <td><input type="text" name="author" size="45" value="<?php if(isset($_POST['author'])) {echo hscAll($_POST['author']);} ?>"></td>
                <td><?php if(isset($errors['author'])) {echo $errors['author'];} ?></td>
            </tr>
        </table>
        <input type="submit" name="add" value="добавить" class="button-hello send">
    </form>
    <hr>
    <form action="" method="post" onsubmit="return del();">
        <?php while($row = $author->fetch_assoc()){ ?>
            <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
                <a href="/admin/books/edit_author?id=<?php echo $row['id']; ?>">Редактировать</a>
                <a href="/admin/books/authors?action=delete&id=<?php echo $row['id']; ?>" onclick="return del();">Удалить</a>
                <p><a class="title" href="/admin/books/edit_author?id=<?php echo $row['id']; ?>"><?php echo hscAll($row['author']); ?></a></p>
            </div>
            <hr>
        <?php }  ?>
        <input type="submit" name="delete" value="Удалить отмеченных авторов" class="button_goods">
    </form>
    <?php } else {
        echo '<p>Авторов нет</p>';
    } ?>
</div>