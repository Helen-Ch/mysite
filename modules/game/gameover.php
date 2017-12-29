<?php
if(isset($_SESSION['player']) && $_SESSION['player'] <= 0){			
	$result = '<div style="text-align:center; font-size:22px;">Игра окончена, Вы проиграли!<br><img src="/skins/default/img/28.png"></div>';
	session_unset();
	session_destroy();			
} elseif (isset($_SESSION['server']) && $_SESSION['server'] <= 0) {
	$result = '<div style="text-align:center; font-size:22px;">Поздравляем, Вы выиграли!<br><img src="/skins/default/img/champagne.jpg"></div>';
	session_unset();
	session_destroy();
}