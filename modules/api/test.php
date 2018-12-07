<?php
//wtf($_POST,1);
//формируем ответ
$msg = array();
if (isset($_POST['secret_button'])) {
  if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $res = q("
        SELECT `id`,`hash` FROM `users`
        WHERE `login`  = '" . mresAll($_POST['login']) . "'        
        AND `password` = '" . mresAll(myHash($_POST['password'])) . "'
        AND `active`   = 1
        LIMIT 1    
    ");
    if ($res->num_rows) {
      $response = $res->fetch_assoc();
      $msg['status'] = 'ok';
      $msg['secret_key'] = $response['hash'];
      if (!isset($_SESSION['user'])) {
        $_SESSION['user']['id'] = $response['id'];
        $_SESSION['user']['hash'] = $response['hash'];
      }
      unset($response);
    } else {
      $msg['status'] = 'no';
      $msg['error'] = 'Нет пользователя с таким логином или паролем!';
    }
    $res->close();
  } else {
    $msg['status'] = 'no';
    $msg['error'] = 'Bad request. Missing required parametr';
  }
} elseif (isset($_POST['socials_button'])) {
  if (!empty($_POST['secret'])) {
    $hash = mresAll($_POST['secret']);
    // в хеше могут присутствовать слеши, которые экранируются, поэтому возвращаем к исходному варианту
    $search = str_replace("\\\\", "\\", $hash);
    $res = q("
      SELECT `socials`.*, `users`.`id` FROM `socials`
      LEFT JOIN `user2social` ON `user2social`.`social_id` = `socials`.`id`
      LEFT JOIN `users` ON `users`.`id` = `user2social`.`user_id`
        WHERE `users`.`hash` = '" . $search . "'           
    ");
    if ($res->num_rows) {
      $msg['status'] = 'ok';
      $msg['socials'] = '';
      while ($response = $res->fetch_assoc()) {
        $msg['socials'] .= $response['name'] . ';';
      }
      if (!isset($_SESSION['user'])) {
        $_SESSION['user']['id'] = $response['id'];
        $_SESSION['user']['hash'] = $_POST['secret'];
      }
      unset($response);
    } else {
      $msg['status'] = 'no';
      $msg['error'] = 'Нет социальных сетей для данного пользователя!';
    }
    $res->close();
  } else {
    $msg['status'] = 'no';
    $msg['error'] = 'Bad request. Missing required parametr';
  }
} elseif (isset($_POST['delete_button'])) {
  if (!empty($_POST['secret']) && !empty($_POST['social_id'])) {
    $hash = mresAll($_POST['secret']);
    // в хеше могут присутствовать слеши, которые экранируются, поэтому возвращаем к исходному варианту
    $search = str_replace("\\\\", "\\", $hash);
    $soc = q("
      SELECT `socials`.`id` FROM `socials`
      LEFT JOIN `user2social` ON `user2social`.`social_id` = `socials`.`id`
      LEFT JOIN `users` ON `users`.`id` = `user2social`.`user_id`
        WHERE `users`.`hash` = '" . $search . "'
        AND `socials`.`id` = " . (int)$_POST['social_id'] . "
        LIMIT 1            
    ");
    if ($soc->num_rows) {
      $soc_id = $soc->fetch_assoc();
      if ($soc_id['id'] == $_POST['social_id']) {
        $res = q("
        DELETE FROM `user2social`
        WHERE `user_id` = (
          SELECT `id` FROM `users`
          WHERE `hash` = '" . $search . "' 
        )
        AND `social_id` = " . (int)$_POST['social_id'] . "            
    ");
        if ($_POST['social_id'] == '1') {
          $update = q("
        UPDATE `users` SET
        `fb_user_id` = ''        
        WHERE `hash` = '" . $search . "'                
    ");
        }
        $msg['status'] = 'ok';
        $msg['delete'] = 'Соцсеть успешно удалена из Вашего профиля на сайте!';
      }
    } else {
      $msg['status'] = 'no';
      $msg['error'] = 'Данная соцсеть не привязана к Вашему профилю!';
    }
  } else {
    $msg['status'] = 'no';
    $msg['error'] = 'Bad request. Missing required parametr';
  }
}
if (!empty($_POST['format']) && $_POST['format'] == 'xml') {
  echo myXML($msg);
} else {
  echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}
exit();
