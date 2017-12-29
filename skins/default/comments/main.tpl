<div id="adcom" class="added">
    <?php
        if($res->num_rows) {
            echo '<p class="amount">Комментарии на странице '.mysqli_num_rows($res).'</p>';
            while($row = $res->fetch_assoc()){
           	    echo '<p><span>'.htmlspecialchars($row['name']).' '.$row['date'].'</span><br>'.nl2br(htmlspecialchars($row['text'])).'</p>';
            }
        } else {
            echo '<p>Ваш комментарий будет первым</p>';
        }
        $res->close();
    ?>
</div>
<div class="added">
    <p><span id="un"></span></p>
    <p id="ct"></p>
</div>
<div class="comments">
    <div class="services-01"></div>
    <div class="underline02"></div>
    <div id="resp" class="headline"></div>
    <div id="req" class="comform">
        <?php if(isset($_SESSION['user'])){
            if(!isset($_SESSION['commentok'])){ ?>
                <p class="headline">Оставьте свой комментарий</p>
                <form  action="" method="post" onsubmit="return commentsAjax();">
                    <table class="formtable">
                        <tr>
                        <td>Имя *</td>
                        <td><input id="name" type="text" name="name" size="30" value="<?php echo @htmlspecialchars($_POST['name']); ?>"></td><!--  @ для примера -->
                        <td><?=@$errors['name']; ?></td><!-- и здесь для примера-->
                        </tr>
                    <tr>
                        <td>E-mail *</td>
                        <td><input id="mail" type="email" name="email" size="30" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']);} ?>"></td>
                        <td><?php if(isset($errors['email'])) {echo $errors['email'];} ?></td>
                    </tr>
                    <tr>
                        <td>Введите свой комментарий *</td>
                        <td><textarea id="text" name="text" cols="31" rows="6" value="<?php if(isset($_POST['text'])) {echo htmlspecialchars($_POST['text']);} ?>"></textarea></td>
                        <td><?php if(isset($errors['text'])) {echo $errors['text'];} ?></td>
                    </tr>
                    </table>
                    <p class="note">* - обязательные для заполнения поля</p>
                    <input type="submit" name="sendcomment" value="Отправить" class="button-hello send">
                </form>
            <?php } else{
                unset($_SESSION['commentok']);
            }
        } else { ?>
        <p> Чтобы добавить свой комментарий Вам необходимо авторизироваться на сайте <a href="#" onclick="hideShow('log'); hideShow('af'); hideShow('x');">Вход</a></p>
        <?php } ?>
    </div>
</div>