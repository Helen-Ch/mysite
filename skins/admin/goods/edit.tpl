<div class="goods">
    <p class="hg">Редактировать данные о товаре</p>
    <div>
        <?php if(!isset($_SESSION['info'])){ ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="formtable">
                    <tr>
                        <td>Название товара</td>
                        <td><input type="text" name="title" size="100" value="<?php if(isset($_POST['title'])) {echo htmlspecialchars($_POST['title']);} else{echo htmlspecialchars($row['title']);} ?>"></td>
                        <td><?php if(isset($errors['title'])) {echo $errors['title'];} ?></td>
                    </tr>
                    <tr>
                        <td>Код товара</td>
                        <td><input type="number" name="code" value="<?php if(isset($_POST['code'])) {echo htmlspecialchars($_POST['code']);} else {echo htmlspecialchars($row['code']);} ?>"></td>
                        <td><?php if(isset($errors['code'])) {echo $errors['code'];} ?></td>
                    </tr>

                    <tr>
                        <td>Категория</td>
                        <td><select name="category">
                            <?php if($cat->num_rows){
                                while ($row2 = $cat->fetch_assoc()){ ?>
                                    <option value="<?php echo hscAll($row2['id']); ?>" <?php if(isset($row['category']) && $row['category'] == $row2['name']){ ?> selected <?php } ?> ><?php echo hscAll($row2['name']); ?></option>
                                <?php } } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['category'])) {echo $errors['category'];} ?></td>
                    </tr>
                    <tr>
                        <td>Наличие на складе</td>
                        <td><label><input type="radio" name="availability" value="1" <?php if($row['availability'] == 1){ ?> checked <?php } ?>>Да</label>
                            <label><input type="radio" name="availability" value="0" <?php if($row['availability'] == 0){ ?> checked <?php } ?>>Нет</label>
                        </td>

                    </tr>
                    <tr>
                        <td>Цена</td>
                        <td><input type="text" name="price" value="<?php if(isset($_POST['price'])) {echo htmlspecialchars($_POST['price']);} else {echo htmlspecialchars($row['price']);} ?>"></td>
                        <td><?php if(isset($errors['price'])) {echo $errors['price'];} ?></td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td><textarea name="description" cols="100" rows="6"><?php if(isset($_POST['description'])) {echo htmlspecialchars($_POST['description']);} else {echo htmlspecialchars($row['description']);} ?></textarea></td>
                        <td><?php if(isset($errors['description'])) {echo $errors['description'];} ?></td>
                    </tr>
                    <tr>
                        <td>Краткое описание</td>
                        <td><textarea name="short_text" cols="100" rows="6"><?php if(isset($_POST['short_text'])) {echo htmlspecialchars($_POST['short_text']);} else {echo htmlspecialchars($row['short_text']);} ?></textarea></td>
                        <td><?php if(isset($errors['short_text'])) {echo $errors['short_text'];} ?></td>
                    </tr>
                    <tr>
                        <td>Количество</td>
                        <td><input type="number" name="amount" value="<?php if(isset($_POST['amount'])) {echo htmlspecialchars($_POST['amount']);} else {echo htmlspecialchars($row['amount']);} ?>"></td>
                        <td><?php if(isset($errors['amount'])) {echo $errors['amount'];} ?></td>
                    </tr>
                    <tr>
                        <td>Изображение</td>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="image"></td>

                    </tr>
                    <tr>
                        <td>Изменить изображение</td>
                        <td><input type="file" name="file"></td>
                        <td><?php if(isset($errors['file'])) {echo $errors['file'];} ?></td>
                    </tr>
                    <?php if(!empty($row['image'])){  ?>
                    <tr>
                        <td>Удалить изображение</td>
                        <td><input type="checkbox" name="delete_image" onclick="return del();" value="<?php echo $row['image']; ?>"></td>
                    </tr>
                    <?php  } ?>
                </table>
                <input type="submit" name="edit" value="редактировать" class="button-hello send">
            </form>
        <?php } ?>
    </div>
</div>