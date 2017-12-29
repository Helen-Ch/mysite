<div class="cabinet">
	<?php if(!isset($_SESSION['regok'])){ ?>
		<h3>Введите данные для регистрации на сайте</h3>
		<form action="" method="POST">
			<p><label>Логин: <input type="text" name="login" value=""></label><?php if(isset($errors['login'])) {echo $errors['login'];} ?></p>
  			<p><label>Пароль: <input type="password" name="password" value=""></label><?php if(isset($errors['password'])) {echo $errors['password'];} ?></p>
  			<p><label>E-mail: <input type="email" name="email" value=""><?php if(isset($errors['email'])) {echo $errors['email'];} ?></label></p>
  			<p><input type="submit" name="submit" value="Зарегистрироваться"></p>
		</form>
	<?php } else{ unset($_SESSION['regok']); ?>
	<div>Вы успешно зарегистрировались на сайте!<br>
		 на Ваш e-mail было отправлено письмо, содержащее ссылку для активации Вашего аккаунта!
	</div>
	<?php  } ?>
</div>