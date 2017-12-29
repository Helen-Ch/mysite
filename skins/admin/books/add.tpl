<div class="goods">
    <p class="hg">Добавить книгу</p>
    <a href="/admin/books/authors">Добавить/Редактировать автора</a>
    <div>
        <?php if(!isset($_SESSION['info'])){ ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="formtable">
                    <tr>
                        <td>Название книги* </td>
                        <td><input type="text" name="title" size="70" value="<?php if(isset($_POST['title'])) {echo hscAll($_POST['title']);} ?>"></td>
                        <td><?php if(isset($errors['title'])) {echo $errors['title'];} ?></td>
                    </tr>
                    <tr>
                        <td>Автор* ***</td>
                        <td><select name="author[]" multiple="multiple" size="10">
                                <?php if($author3->num_rows){
                                while ($row = $author3->fetch_assoc()){ ?>
                                <option value="<?php echo hscAll($row['id']); ?>"
                                    <?php if(isset($_POST['author'])){
                                        foreach ($_POST['author'] as $ky => $arr) {
                                            if($arr == hscAll($row['id'])) { ?>
                                                selected
                                            <?php }
                                        }
                                    } ?> >
                                    <?php echo hscAll($row['author']); ?>
                                </option>
                                <?php } } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['author'])) {echo $errors['author'];} ?></td>
                    </tr>
                    <tr>
                        <td>Цена* **</td>
                        <td><input type="text" name="price" value="<?php if(isset($_POST['price'])) {echo hscAll($_POST['price']);} ?>"></td>
                        <td><?php if(isset($errors['price'])) {echo $errors['price'];} ?></td>
                    </tr>
                    <tr>
                        <td>Описание* </td>
                        <td><textarea name="description" cols="70" rows="6"><?php if(isset($_POST['description'])) {echo hscAll($_POST['description']);} ?></textarea></td>
                        <td><?php if(isset($errors['description'])) {echo $errors['description'];} ?></td>
                    </tr>
                    <tr>
                        <td>Добавить изображение* </td>
                        <td><input type="file" name="file"></td>
                        <td><?php if(isset($errors['file'])) {echo $errors['file'];} ?></td>
                    </tr>
                </table>
                <p class="note">* - обязательные для заполнения поля</p>
                <p class="note">** - цену необходимо указывать с копейками без запятой</p>
                <p class="note">*** - для выбора нескольких авторов зажмите Ctrl или Shift</p>
                <input type="submit" name="add" value="добавить" class="button-hello send">
            </form>
        <?php } ?>
    </div>
</div>