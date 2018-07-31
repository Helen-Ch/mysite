<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo hscAll(Core::$META['title']); ?></title>
	<meta name="description" content="<?php echo hscAll(Core::$META['description']); ?>">
	<meta name="keywords" content="<?php echo hscAll(Core::$META['keywords']); ?>">
	<link href="/skins/default/css/styledelicatos.css" rel="stylesheet" type="text/css">
	<?php if (count(Core::$CSS)){echo implode("\n",Core::$CSS);} ?>
	<?php if (count(Core::$JS)){echo implode("\n",Core::$JS);} ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Подключение jquery через google, ненадежно -->
	<!--<script src="/skins/default/js/jQuery.js"></script>-->
	<!-- Подключение jqurey, скачанного с сайта  - больше нагрузка, медленнее работа, но надежно-->
	<script>
		var name = '<?php if(isset($name)){ echo $name; } ?>';
    	var access = '<?php if(isset($access)){ echo $access; } ?>';
	</script>
</head>
<body>
<div class="wrapper">
	<div id="af" class="afterfon"></div>
	<!-- Фиксируемый при прокрутке header -->
	<div class="headerFixed">
		<a href="/" class="logo"><img src="/skins/default/img/logo.png" alt="logo"></a>
		<div class="information">
			<div class="navigation">
				<a href="/static/main" class="active">home</a>
				<a href="/static/about" class="nav">about</a>
				<a href="/static/services" class="nav">services</a>
				<a href="/static/gallery" class="nav">gallery</a>
				<a href="/static/contact" class="nav">contact</a>
				<a href="/game" class="nav">game</a>
				<a href="/news" class="nav">news</a>
				<a href="/goods" class="nav">catalog</a>
				<a href="/books" class="nav">books</a>
				<a href="/comments" class="nav">comments</a>
				<a href="/file_manager" class="nav">fManager</a>
				<a href="/form_calc.php" class="nav">calculator</a>
				<a href="/chat" class="nav">chat</a>
                <a href="/vatel" class="nav">Vatel</a>
				<a href="/socials" class="nav">Socials</a>
				<!--<a href="/cabinet/registration" class="nav">reg</a>
                    <a href="/cabinet/authorization" class="nav">auth</a> without JS-->
				<?php if (isset($_SESSION['user']) ){ ?>
					<!--<a href="/chat" class="nav">chat</a>-->
					<?php if(!empty($_SESSION['user']['access']) && $_SESSION['user']['access'] == 5){ ?>
						<a href="/admin" class="nav">admin</a>
				<?php } } ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- обычный header -->
   	<div class="header">			
		<div class="blue">
			<a href="#">Contact us!</a>	
			<a href="#" class="arrow"></a>
			<div class="clear"></div>							
		</div> 
		<a href="#" class="red"></a>
       	<a href="/" class="logo"><img src="/skins/default/img/logo.png" alt="logo"></a>
		<div class="information">
			<a href="#" class="address">8901 Marmora Road, Glasgow, D04</a>
			<a href="#" class="phone">800 555 7744</a>
			<?php if(!isset($_SESSION['user'])){ ?>
				<div id="come" class="enreg" onclick="slide('log'); hideShow('af'); slide('x');">Войти | Регистрация</div>
			<?php  }else { ?>
				<div id="in" class="enreg log" onclick="slide('user'); slide('x');"><?php echo hscAll($_SESSION['user']['login']); ?></div>
					<div class="usprof" id="user">
						<a href="/static/user_profile" class="" id="prof">Профиль</a>
						<a href="/cabinet/exit" class="" id="ex">Выход</a>
						<div id="x" class="cross" onclick="slide('user'); slide('x');"></div>
					</div>
			<?php  } ?>
			<div class="clear"></div>
			<div class="navigation">
				<a href="/static/main" class="active">home</a>
				<a href="/static/about" class="nav">about</a>
				<a href="/static/services" class="nav">services</a>
				<a href="/static/gallery" class="nav">gallery</a>
				<a href="/static/contact" class="nav">contact</a>
				<a href="/game" class="nav">game</a>
				<a href="/news" class="nav">news</a>
				<a href="/goods" class="nav">catalog</a>
				<a href="/books" class="nav">books</a>
				<a href="/comments" class="nav">comments</a>
				<a href="/file_manager" class="nav">fManager</a>
				<a href="/form_calc.php" class="nav">calculator</a>
				<a href="/chat" class="nav">chat</a>
                <a href="/vatel" class="nav">Vatel</a>
				<a href="/socials" class="nav">Socials</a>
			<!--<a href="/cabinet/registration" class="nav">reg</a>
				<a href="/cabinet/authorization" class="nav">auth</a> without JS-->
				<?php if (isset($_SESSION['user']) ){ ?>
					<!--<a href="/chat" class="nav">chat</a>-->
					<?php if(!empty($_SESSION['user']['access']) && $_SESSION['user']['access'] == 5){ ?>
					<a href="/admin" class="nav">admin</a>
				<?php } } ?>
				<div class="clear"></div>                
			</div>				
		</div>
		<div class="clear"></div>
		<!-- модальное окно авторизации/регистрации -->
		<div class="cabbb" id="log">
			<div class="cabmain">
				<form action="/cabinet/authorization" method="POST" onsubmit="return myAjax();">
					<p class="regerror" id="erroruser"></p>
					<p><input type="text" name="login" placeholder="Login" onfocus="placeholder=''" id="alog"></p>
					<p class="regerror" id="alogerror"></p>
					<p><input type="password" name="password" placeholder="Password" onfocus="placeholder=''" id="apass"></p>
					<p class="regerror" id="apasserror"></p>
					<p><label><input type="checkbox" name="rememberMe" value="" id="check">Запомнить меня</label></p>
					<p><input type="submit" name="submit" value="Авторизоваться"></p>
					<p><a href="#" onclick="hideShow('log'); hideShow('reg'); hideShow('x'); hideShow('xr');">Зарегистрироваться</a></p>
				</form>
			</div>
			<div id="x" class="cross" onclick="slide('log'); hideShow('af'); slide('x');"></div>
		</div>
		<div class="cabbb" id="reg">
			<form  action="/cabinet/registration" method="POST" onsubmit="return checkFormReg();">
				<p><input type="text" name="login" placeholder="Login" onfocus="placeholder=''" id="login"></p>
				<p class="regerror" id="logerror"></p>
				<p><input type="password" name="password"  placeholder="Password" onfocus="placeholder=''" id="pass"></p>
				<p class="regerror" id="passerror"></p>
				<p><input type="email" name="email" value="" placeholder="e-mail" onfocus="placeholder=''" id="email"></p>
				<p class="regerror" id="mailerror"></p>
				<p><input type="submit" name="submit" value="Зарегистрироваться"></p>
				<p><a href="#" onclick="hideShow('reg'); hideShow('log'); hideShow('x'); hideShow('xr');">Авторизация</a></p>
			</form>
			<div id="xr" class="cross" onclick="slide('reg'); hideShow('af'); slide('xr');"></div>
		</div>
		<div class="clear"></div>
	</div>
    <!-- Роутер-->
    <?php echo $content; ?>
    			<!-- FOOTER -->
    <div class="footer">delicatos &#169;
		<?php
			$date = date('Y');
			if(Core::$CREATED == $date) {
				echo Core::$CREATED;
			} else {
				echo (Core::$CREATED.'-'.$date);
			}
		?>
		<a href="#">privacy policy</a>
		<p class="foot">On the materials  of <a href="https://www.templatemonster.com/demo/57803.html">www.templatemonster.com</a></p>
	</div>
		<!-- MAP -->
	<?php
	if (($_GET['module'] == 'static' && $_GET['page'] == 'main') || $_GET['page'] == 'contact') { ?>
		<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d25227.943312040577!2d-73.99127078451116!3d40.644144079339384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1suk!2sua!4v1467386166811"
					allowfullscreen></iframe>
		</div>
	<?php } ?>
</div>
</body>
</html>