<?php
/**
 * Created by PhpStorm.
 * User: Olena
 * Date: 17.04.2018
 * Time: 21:12
 */
// Facebook

$path = FB::URL_AUTH . "?" . "client_id=" . FB::CLIENT_ID . "&redirect_uri=" . urlencode(FB::REDIRECT_LOGIN) . "&auth_type=rerequest&scope=" . FB::SCOPE . "&response_type=code";
if (isset($_GET['code'])) {
  $_SESSION['user'] = FB::faceBook($_GET['code'], FB::REDIRECT_LOGIN);
  header("Location: /");
  exit();
}