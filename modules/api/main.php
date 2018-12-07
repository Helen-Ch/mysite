<?php
Core::$JS[] = '<script src="/skins/default/js/scripts_v4.js"></script>';
if (isset($_SESSION['user']['id'])) {
  $socials = q("
  SELECT `socials`.* FROM `socials`
  LEFT JOIN `user2social` ON `user2social`.`social_id` = `socials`.`id`
  LEFT JOIN `users` ON `users`.`id` = `user2social`.`user_id`
    WHERE `users`.`id` = " . (int)$_SESSION['user']['id'] . "     
  ");
} elseif (isset($_SESSION['user']['hash'])) {
  $socials = q("
  SELECT `socials`.* FROM `socials`
  LEFT JOIN `user2social` ON `user2social`.`social_id` = `socials`.`id`
  LEFT JOIN `users` ON `users`.`id` = `user2social`.`user_id`
    WHERE `users`.`hash` = '" . $_SESSION['user']['hash'] . "'
");
} else {
  $socials = q("
  SELECT `id`, `name` FROM `socials`
");
}