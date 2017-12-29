<?php
error_reporting(-1);
ini_set('display_errors','On');
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Калькулятор</title>
</head>
<body>
<div style="width: 30%; margin: 100px auto 0 auto;">
<?php
function calc ($num1, $num2, $action) {		
	if ($action == '-') {			
		$result = $num1.'-'.$num2.'='.($num1-$num2);		
	} elseif ($action == '+') {
		$result = $num1.'+'.$num2.'='.($num1+$num2);	  
	} elseif ($action == '*') {
		$result = $num1.'*'.$num2.'='.($num1*$num2);		
	} elseif ($action == '/') {
		if ($num2 == 0) {
			$result = 'Ошибка! На ноль делить нельзя!';
		} else {		
			$result = $num1.'/'.$num2.'='.($num1/$num2);
		}
	} else {
		$result = 'Вы ввели неправильные данные';
	}	
	return $result;	
}	
if (isset  ($_GET['num1'], $_GET['num2'], $_GET['action'])){	
	echo calc ($_GET['num1'], $_GET['num2'], $_GET['action']);
}
?>
<h1>Калькулятор</h1> 		
<form action="" method="GET">
  <p><label>Введите 1-е число<input type="number" name="num1" value=""></label></p>
  <p><label>Введите 2-е число<input type="number" name="num2" value=""></label></p>
  <p>Выберите действие:</p>
  <p><label><input type="radio" name="action" value="+">Сложить</label></p>
  <p><label><input type="radio" name="action" value="-">Вычесть</label></p>
  <p><label><input type="radio" name="action" value="*">Умножить</label></p>
  <p><label><input type="radio" name="action" value="/">Разделить</label></p>
  <p><input type="submit" value="Посчитать/Очистить"></p>      
</form>
</div>
</body>
</html>