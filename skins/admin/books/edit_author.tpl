<div class="goods">
    <div>
        <?php if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) && !isset($_SESSION['info'])){ ?>
            <p class="hg">Редактировать автора</p>
            <form action="" method="post">
                <table class="formtable">
                    <tr>
                        <td>Автор</td>
                        <td><input type="text" name="author" size="45" value="<?php if(isset($_POST['author'])) {echo hscAll($_POST['author']);} else{echo hscAll($row['author']);} ?>"></td>
                        <td><?php if(isset($errors['author'])) {echo $errors['author'];} ?></td>
                    </tr>
                </table>
                <input type="submit" name="edit" value="редактировать" class="button-hello send">
            </form>
        <?php }  else { ?>
        <p class="hg">Вам необходимо авторизироваться на сайте <a href="/cabinet/authorization">Вход</a></p>
        <?php } ?>
    </div>
</div>