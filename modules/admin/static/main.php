<?php
Core::$META['title'] = 'Admin';
 if(!isset($_SESSION['user']) || $_SESSION['user']['access'] !=5){
    include './modules/cabinet/authorization.php';
}
