<div class="goods">
    <div>
        <?php if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) && !isset($_SESSION['info'])){ ?>
            <p class="hg">Добавить новость</p>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="formtable">
                    <tr>
                        <td>Заголовок новости* </td>
                        <td><input type="text" name="title" size="70" value="<?php if(isset($_POST['title'])) {echo htmlspecialchars($_POST['title']);} ?>"></td>
                        <td><?php if(isset($errors['title'])) {echo $errors['title'];} ?></td>
                    </tr>
                    <tr>
                        <td>Категория* </td>
                        <td><select name="category">
                            <?php if($cat->num_rows){
                                while ($row2 = $cat->fetch_assoc()){ ?>
                                    <option value="<?php echo hscAll($row2['name']); ?>" <?php if(isset($_POST['category']) && $_POST['category'] == $row2['name']){ ?> selected <?php } ?> >
                                    <?php echo hscAll($row2['name']); ?>
                                    </option>
                                <?php } } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['category'])) {echo $errors['category'];} ?></td>
                    </tr>
                    <tr>
                        <td>Содержание новости* </td>
                        <td><textarea name="full_text" cols="70" rows="6"><?php if(isset($_POST['full_text'])) {echo htmlspecialchars($_POST['full_text']);} ?></textarea></td>
                        <td><?php if(isset($errors['full_text'])) {echo $errors['full_text'];} ?></td>
                    </tr>
                    <tr>
                        <td>Краткое описание* </td>
                        <td><textarea name="short_text" cols="70" rows="6"><?php if(isset($_POST['short_text'])) {echo htmlspecialchars($_POST['short_text']);} ?></textarea></td>
                        <td><?php if(isset($errors['short_text'])) {echo $errors['short_text'];} ?></td>
                    </tr>
                    <tr>
                        <td>Добавить изображение* </td>
                        <td><input type="file" name="file"></td>
                        <td><?php if(isset($errors['file'])) {echo $errors['file'];} ?></td>
                    </tr>
                </table>
                <p class="note">* - обязательные для заполнения поля</p>
                <input type="submit" name="add" value="добавить" class="button-hello send">
            </form>
        <?php } else{ ?>
            <p class="hg">Извините, у Вас нет доступа к данной странице!</p>
        <?php } ?>
    </div>
</div>