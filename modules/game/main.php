<?php
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = 10;
    $_SESSION['server'] = 10;
}
if (isset ($_POST['num1']) && !empty($_POST['num1']) && is_numeric($_POST['num1']) && ($_POST['num1'] >= 1 && $_POST['num1'] <= 3)) {
	$random = rand(1, 3);
	$kick = 'Удар игрока: '.$_POST['num1'].'<br>'.'Удар противника: '.$random.'<br>';
    if ($_POST['num1'] == $random) {
        $_SESSION['player'] = ($_SESSION['player'] - rand(1, 4));
        if ($_SESSION['player'] <= 0) {
            header("Location: /game/gameover");
            exit();
        }
    } else {
        $_SESSION['server'] = ($_SESSION['server'] - rand(1, 4));
        if ($_SESSION['server'] <= 0) {
            header("Location: /game/gameover");
            exit();
        }
    }
} elseif(!isset ($_POST['num1'])) {
	$kick = '';
} else{	
	$kick = 'Возможно Вы перебрали лишнего и пропустили свой ход или ввели недопустимые данные! Введите число от 1 до 3!';
}