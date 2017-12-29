<div class="user_edit">
    <?php if(isset($info)) { ?>
        <h3><?php echo $info; ?></h3>
        <hr>
    <?php } ?>
    <?php if(!isset($_SESSION['info'])){ ?>
        <div class="goods_image">
            <p><img src="<?php echo hscAll($row['image']); ?>" alt="image"></p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="formtable">
                <tr>
                    <td>Логин</td>
                    <td><input type="text" name="login"  value="<?php if(isset($_POST['login'])) {echo hscAll($_POST['login']);} else{echo hscAll($row['login']);} ?>"></td>
                    <td><?php if(isset($errors['login'])) {echo $errors['login'];} ?></td>
                </tr>
                <tr>
                    <td>Пароль</td>
                    <td><input type="password" name="password"  value=""></td>
                    <td><?php if(isset($errors['password'])) {echo $errors['password'];} ?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><input type="email" name="email" value="<?php if(isset($_POST['email'])) {echo hscAll($_POST['email']);} else {echo hscAll($row['email']);} ?>"></td>
                    <td><?php if(isset($errors['email'])) {echo $errors['email'];} ?></td>
                </tr>
                <tr>
                    <td>Изменить/Добавить фото</td>
                    <td><input type="file" name="file"></td>
                    <td><?php if(isset($errors['file'])) {echo $errors['file'];} ?></td>
                </tr>
                <?php if(!empty($row['image'])){  ?>
                <tr>
                    <td>Удалить фото</td>
                    <td><input type="submit" name="delete_image" value="удалить изображение" onclick="return del();"></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3">Дополнительная информация</td>
                </tr>
                <tr>
                    <td>Создан: </td>
                    <td><?php echo hscAll($row['date']); ?></td>

                </tr>
                <tr>
                    <td>Последняя активность: </td>
                    <td><?php echo hscAll($row['last_date']); ?></td>

                </tr>
            </table>
            <p><input type="submit" name="edit" value="редактировать" class="button-user"><input type="submit" name="delete" value="удалить" class="button-user" onclick="return del();"></p>
        </form>
        <div class="clear"></div>
    <?php } ?>
</div>