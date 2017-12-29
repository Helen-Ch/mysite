<div class="game">
	<h1>Добро пожаловать на битву алкоголиков!</h1>
    <p><img src="/skins/default/img/beer.jpg"></p>
    <p class="gameP">Если Ваш удар совпадет с ударом противника, Ваши жизни уменьшатся и наоборот. Победит тот, укого останутся жизни. Удачи!</p>

	<p>Количество жизней игрока:<?php echo $_SESSION['player']; ?></p>
	<p>Количество жизней противника:<?php  echo $_SESSION['server']; ?></p>

	<form action="" method="POST">
   		<p><label>Нанесите свой удар (введите число от 1 до 3):<input type="text" name="num1" value="" size="1" maxlenth="1"></label></p>
		<p><input type="image" src="/skins/default/img/smile.png" name="submit" value=""></p>
	</form>
<?php echo $kick; ?>
</div>
