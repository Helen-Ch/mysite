<?php
if(isset ($_POST['text'])) {
    $errors = array();
    if (empty ($_POST['text'])) {
        $errors['text'] = 'Введите сообщение!';
    }
    if (!count($errors)) {
        q("
          INSERT INTO `chat` SET
          `text`  = '" . mresAll($_POST['text']) . "',
          `login` =  '" . mresAll($_SESSION['user']['login']) . "'             
        ");
    }
    $_SESSION['addId'] =  DB::_()->insert_id;
}
echo $_SESSION['addId'];
exit();