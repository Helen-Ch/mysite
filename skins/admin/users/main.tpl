<div class="users_list">
    <form action="" method="post" onsubmit="return del();">
        <?php if($users->num_rows) { ?>
            <p>Пользователей на сайте <?php echo $users->num_rows ?></p>
            <?php while($row = $users->fetch_assoc()){ ?>
                <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
                     <a class="title" href="/admin/users/edit/<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['login']); ?></a>
                </div>
            <?php }
        } else {
            echo '<p>Пользователи отсутствуют</p>';
        } ?>
        <input type="submit" name="delete" value="Удалить отмеченных пользователей" class="button_users">
    </form>
</div>
<div class="seek">
    <form action="" method="post">
        <p><input type="text" name="search" class="search" value=""><input type="submit" name="find" value="" class="find"></p>
    </form>
</div>
<div class="users_text">
    <?php if(isset($info)) { ?>
        <h1><?php echo $info; ?></h1>
        <hr>
    <?php } ?>
    <p><span>Панель управления пользователями<span></span></p>
    <p>Каждый пользователь принадлежит к конкретной группе и настраивается при редактировании пользователя.<br>Группа отвечает за права доступа к разделам и их частям.</p>
    <p>Права делятся на 4 типа:</p>
    <ul>
        <li>0 - Нет прав. Пользователь не видит раздела и не имеет доступа к его частям</li>
        <li>1 - Чтение + возможность оставлять комментарии на сайте</li>
        <li>5 - Полные права</li>
        <li>2 - Пользователь забанен</li>
   </ul>
</div>
<div class="clear"></div>