<?php
if(isset($_GET['link'])){
	$link = './'.$_GET['link'];	
} else{
	$link = '.';
}
$array = scandir($link);