<div class="goods">
    <p class="hg">Редактировать данные о книге</p>
        <?php if(!isset($_SESSION['info'])){ ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="formtable">
                    <tr>
                        <td>Название книги </td>
                        <td><input type="text" name="title" size="100" value="<?php if(isset($_POST['title'])) {echo hscAll($_POST['title']);} else{echo hscAll($row['title']);} ?>"></td>
                        <td><?php if(isset($errors['title'])) {echo $errors['title'];} ?></td>
                    </tr>
                    <tr>
                        <td>Цена </td>
                        <td><input type="text" name="price" value="<?php if(isset($_POST['price'])) {echo hscAll($_POST['price']);} else {echo hscAll($row['price']);} ?>"></td>
                        <td><?php if(isset($errors['price'])) {echo $errors['price'];} ?></td>
                    </tr>
                    <tr>
                        <td>Описание </td>
                        <td><textarea name="description" cols="100" rows="6"><?php if(isset($_POST['description'])) {echo hscAll($_POST['description']);} else {echo hscAll($row['description']);} ?></textarea></td>
                        <td><?php if(isset($errors['description'])) {echo $errors['description'];} ?></td>
                    </tr>
                    <tr>
                        <td>Изображение </td>
                        <td><img src="<?php echo hscAll($row['image']); ?>" alt="image"></td>

                    </tr>
                    <tr>
                        <td>Изменить изображение </td>
                        <td><input type="file" name="file"></td>
                        <td><?php if(isset($errors['file'])) {echo $errors['file'];} ?></td>
                    </tr>
                    <?php if(!empty($row['image'])){  ?>
                    <tr>
                        <td>Удалить изображение </td>
                        <td><input type="checkbox" name="delete_image" value="<?php echo $row['image']; ?>" onclick="return del();"></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Удалить автора </td>
                        <td><?php if($author->num_rows){
                            while ($row = $author->fetch_assoc()){ ?>
                            <input type="checkbox" name="delete_author[]" value="<?php echo $row['id']; ?>" onclick="return del();"><?php echo hscAll($row['author']); ?>
                            <?php } } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Добавить автора *</td>
                        <td><select name="add_author[]" multiple="multiple" size="7">
                                <?php if($author1->num_rows){
                                while ($row1 = $author1->fetch_assoc()){ ?>
                                <option value="<?php echo hscAll($row1['id']); ?>"><?php echo hscAll($row1['author']); ?></option>
                                <?php } } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['author'])) {echo $errors['author'];} ?></td>
                    </tr>
                </table>
                <p class="note">* - для выбора нескольких авторов зажмите Ctrl или Shift</p>
                <input type="submit" name="edit" value="редактировать" class="button-hello send">
            </form>
        <?php }
        $book->close(); ?>
</div>