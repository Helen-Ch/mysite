<?php
include './modules/allpages.php';

if(isset($_SESSION['user']['id'])) {
	User::$id = $_SESSION['user']['id'];
	User::$role = $_SESSION['user']['role'];
}
