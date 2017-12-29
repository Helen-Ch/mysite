<?php
//1-й способ выхода через include
setcookie('autoauthhash','', time()-3600, '/');
setcookie('autoauthid','', time()-3600, '/');
session_unset();
session_destroy();
header("Location: /");
exit();