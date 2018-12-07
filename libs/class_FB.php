<?php
/**
 * Created by PhpStorm.
 * User: Olena
 * Date: 30.06.2018
 * Time: 17:23
 */

class FB
{
  const URL_AUTH = "https://www.Facebook.com/dialog/oauth";
  const CLIENT_ID = "2183531048542304";
  const SECRET = "d90eb7809b757acf518ad72e1642a424";
  const REDIRECT_LOGIN = "https://katrin.school-php.com/socials";
  const REDIRECT_PROFILE = "https://katrin.school-php.com/static/user_profile";
  const TOKEN = "https://graph.Facebook.com/oauth/access_token";
  const GET_DATA = "https://graph.Facebook.com/";
  const SCOPE = "email";

  static public function getToken($code, $redirect)
  {
    $ku = curl_init();
    $query = "client_id=" . self::CLIENT_ID . "&redirect_uri=" . urlencode($redirect) . "&client_secret=" . self::SECRET . "&code=" . $code;
    curl_setopt($ku, CURLOPT_URL, self::TOKEN . "?" . $query);
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ku);
    if (!$result) {
      exit(curl_error($ku));
    } else {
      $token = json_decode($result, true);
      return $token;
    }
  }

  static public function getUserInfo($token)
  {
    $ku = curl_init();
    $query = "access_token=" . $token;
    curl_setopt($ku, CURLOPT_URL, self::GET_DATA . "me?" . $query);
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ku);
    if (!$result) {
      exit(curl_error($ku));
    } else {
      $userinfo = json_decode($result, true);
      return $userinfo;
    }
  }

  static public function getUserEmail($token, $uid)
  {
    $ku = curl_init();
    $query = "access_token=" . $token;
    curl_setopt($ku, CURLOPT_URL, self::GET_DATA . $uid . "?" . $query."&fields=email");
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, TRUE);
    $result_em = curl_exec($ku);
    if (!$result_em) {
      exit(curl_error($ku));
    } else {
      $email = json_decode($result_em, true);
      return $email;
    }
  }

  static public function logIn($token, $uid, $uname)
  {
    $res = q("
      SELECT `id`, `login`, `hash` FROM `users`
      WHERE `fb_user_id` = '" . mresAll($uid) . "'                     
        AND `active`     = 1
        LIMIT 1    
    ");
    // если есть пользователь с таким fb_user_id, авторизируем его на сайте под логином из БД
    if ($res->num_rows) {
      $user = $res->fetch_assoc();
    } else {
    // если не нашли, пытаемся получить почту
      $result_add = self::getUserEmail($token, $uid);
      if (array_key_exists('email', $result_add)) {
        $res_email = q("
          SELECT `id`, `login`, `hash`, `email` FROM `users`
          WHERE `email` = '" . mresAll($result_add['email']) . "'                               
            AND `active`   = 1
            LIMIT 1    
        ");
        // если  получили от ФБ почту и есть пользователь с такой почтой (так как у нас не может быть несколько пользователей с одинаковой почтой), авторизируем его на сайте под логином из БД и сохраняем fb_user_id для данного пользователя
        if ($res_email->num_rows) {
          $user = $res_email->fetch_assoc();
          q("
            UPDATE `users` SET
            `fb_user_id`  = '" . mresAll($uid) . "'                 
            WHERE `id`    = " . (int)$user['id'] . "
              AND `email` = '" . mresAll($result_add['email']) . "'                     
              AND `active`   = 1
          ");
          q("
            INSERT INTO `user2social` SET
            `user_id`   = " . (int)$user['id'] . ",
            `social_id` = 1
          ");
        } else {
          // если нет пользователя ни с таким fb_user_id, ни с таким email, авторизируем его на сайте под логином из ФБ и добавляем нового пользователя в БД
          $user['login'] = $uname;
          q("
            INSERT INTO `users` SET
            `login`    = '" . mresAll($uname) . "',
            `fb_user_id`      = '" . mresAll($uid) . "',                           
            `email`    = '" . $result_add['email'] . "',
            `date`     = NOW(),                  
            `hash`     = '" . mresAll(myHash($uname . $result_add['email'].$uid)) . "',
            `active`   = 1            
          ");
          $id = DB::_()->insert_id;
          $user['id'] = $id;
          q("
            INSERT INTO `user2social` SET
            `user_id`   = " . (int)$user['id'] . ",
            `social_id` = 1
          ");
        }
      } else {
        // если нет пользователя с таким fb_user_id и не получили email, авторизируем его на сайте под логином из ФБ и добавляем нового пользователя в БД
        $user['login'] = $uname;
        q("
          INSERT INTO `users` SET
          `login`    = '" . mresAll($uname) . "',
          `fb_user_id`      = '" . mresAll($uid) . "',                 
          `date`     = NOW(),
          `hash`     = '" . mresAll(myHash($uname .$uid)) . "',          
          `active`   = 1          
        ");
        $id = DB::_()->insert_id;
        $user['id'] = $id;
        q("
            INSERT INTO `user2social` SET
            `user_id`   = " . (int)$user['id'] . ",
            `social_id` = 1
          ");
      }
    }
    return $user;
  }

  static public function faceBook($code, $redirect)
  {
    $token = self::getToken($code, $redirect);
    if (isset($token['access_token'])) {
      $userinfo = self::getUserInfo($token['access_token']);
      $user = self::logIn($token['access_token'], $userinfo['id'], $userinfo['name']);
    }
    return $user;
  }
}