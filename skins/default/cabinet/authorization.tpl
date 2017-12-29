<div class="info">
	<?php if(!isset($_SESSION['user'])|| $_SESSION['user']['access'] != 5 ){ echo '<div id="error">'.@$error.'</div>';
		if(isset($_SESSION['user'])){
			echo 'Добро пожаловать, '.hscAll($_SESSION['user']['login']).'!';
		} ?>
</div>

<div class="cabinet">
	<p>Введите данные для авторизации на сайте</p>
	<form action="" method="POST">
		<p><label>Логин: <input type="text" name="login" value=""></p>
  		<p><label>Пароль: <input type="password" name="password" value=""></p>
		<p><label><input type="checkbox" name="rememberMe" value=""</label>Запомнить меня</p>
  		<p><input type="submit" name="submit" value="Вход"></p>
	</form>
	<?php } else {
		echo 'Добро пожаловать, '.hscAll($_SESSION['user']['login']).'!';
	} ?>
</div>