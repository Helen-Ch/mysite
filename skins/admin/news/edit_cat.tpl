<div class="goods">
    <div>
        <?php if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) && !isset($_SESSION['info'])){ ?>
            <p class="hg">Редактировать категорию</p>
            <form action="" method="post">
                <table class="formtable">
                    <tr>
                        <td>Категория</td>
                        <td><input type="text" name="name" size="45" value="<?php if(isset($_POST['name'])) {echo htmlspecialchars($_POST['name']);} else{echo htmlspecialchars($row['name']);} ?>"></td>
                        <td><?php if(isset($errors['name'])) {echo $errors['name'];} ?></td>
                    </tr>
                </table>
            <input type="submit" name="edit" value="редактировать" class="button-hello send">
            </form>
        <?php }  else { ?>
            <p class="hg">Вам необходимо авторизироваться на сайте <a href="/cabinet/authorization">Вход</a></p>
        <?php } ?>
    </div>
</div>