<?php
if(isset($_POST['delete'],$_POST['id'])) {
    q("
        INSERT INTO `chat_del_id` SET
        `deleted_id` = " . (int)$_POST['id'] . ",
        `date`       = NOW() 
    ");

    q("
        UPDATE `chat` SET
        `text`     = 'Это сообщение было удалено!',
        `status`   = 1
        WHERE `id` = " . (int)$_POST['id'] . "        
    ");
    $_SESSION['delId'] = (int)$_POST['id'];
}
echo $_SESSION['delId'];
exit();