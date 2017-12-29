<?php
error_reporting(-1);
ini_set('display_errors', 'On');
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('Europe/Kiev');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AGROLUX</title>
	<link href="/style/style-a2.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script>
		document.createElement("header");
		document.createElement("footer");
		document.createElement("section");
		document.createElement("aside");
		document.createElement("nav");
		document.createElement("article");
		document.createElement("hgroup");
		document.createElement("time");
	</script>
	<noscript>
		<strong>Warning !</strong>
		Because your browser does not support HTML5, some elements are created using JavaScript.
		Unfortunately your browser has disabled scripting. Please enable it in order to display this page.
	</noscript>
	<![endif]-->
</head>
<body>
<div class="wrapper">
	<header>
		<div class="clearfix">
			<a class="logo" href="/"><img src="/images/logo.png" alt="logo"></a>
			<div class="mini-menu" onclick="$('#menu').toggle('slow');">
				<hr>
			</div>
			<div class="sign">have an account? <a href="#">sign in</a> or <a href="#">sign up</a></div>
		</div>
		<nav id="menu">
			<ul class="clearfix">
				<li class="navL"><a href="#">home</a></li>
				<li><p onclick="$('#menu1').toggle('slow');"><span class="arrow">&or;</span>about <span>&or;</span></p>
					<!-- первый уровень выпадающего списка -->
					<ul id="menu1" class="clearfix">
						<li><a href="#">history</a></li>
						<li><p>news <span>&gt;</span></p>
							<!-- второй уровень выпадающего списка -->
							<ul>
								<li><a href="#">latest</a></li>
								<li><a href="#">archive</a></li>
							</ul>
						</li>
						<li><a href="">testimonials</a></li>
					</ul>
				</li>
				<li><a href="#">products</a></li>
				<li><a href="#">services</a></li>
				<li><a href="#">blog</a></li>
				<li class="navR"><a href="#">contacts</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<p class="sunflower"><img src="/images/central.jpg" alt="central image"></p>
		<section class="clearfix">
			<div class="advantages">
				<img src="/images/page-img.png" alt="pageimage">
				<h2>new<br>technologies</h2>
				<p>At vero eos et accusamus et iusto ssimos ducimus qui blanditiistes es praesentiumvoluptatum
					delenitimos.</p>
				<p><a href="#" class="button1"></a></p>
			</div>
			<div class="advantages central">
				<img src="/images/page-img-1.png" alt="page image1">
				<h2>frost<br>protection</h2>
				<p>At vero eos et accusamus et iusto ssimos ducimus qui blanditiistes es praesentiumvoluptatum
					delenitimos.</p>
				<p><a href="#" class="button1"></a></p>
			</div>
			<div class="advantages">
				<img src="/images/page-img-2.png" alt="page image2">
				<h2>eco<br>solutions</h2>
				<p>At vero eos et accusamus et iusto ssimos ducimus qui blanditiistes es praesentiumvoluptatum
					delenitimos.</p>
				<p><a href="#" class="button1"></a></p>
			</div>
		</section>
		<p class="divider"></p>
		<section class="clearfix">
			<div class="text">
				<p class="greeting">welcome!</p>
				<div class="oneseed">
					<img src="/images/page-img-3.png" alt="page image 3">
					<p>Ut vero eos et accusamus et iusto odio dignissimos ducimus qui voluptatum deleniti atque corrupti
						quos dolores et quasmolestias exceptu.</p>
					<a href="#" class="button2"> </a>
				</div>
			</div>
			<div class="text central">
				<p class="greeting">our mission</p>
				<div class="oneseed">
					<h3>lorem ipsum dolore massa as laoreet manga aliqua</h3>
					<h6>Ut vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesent.</h6>
					<p>Eluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
						cupiditate
						non provident similique
						<a href="#">sunt in culpa qui</a> officia deserunt mollitia animi, id est laborum et dolorum
						fuga.Et
						harum quidem rerum facilis est
						et expedita distinctio.Nam libero tempore, cum soluta nobis est eligendi opticumque
					</p>
					<a href="#" class="button2"> </a>
				</div>
			</div>
			<div class="text">
				<div class="veget">
					<div class="tdimage">01.</div>
					<h2>vegetable<br>seeds</h2>

					<p>Lorem ipsum dolor sit ctetueradipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet
						dolorese magna aiqu.</p>
				</div>
				<div class="agricult">
					<div class="tdimage">02.</div>
					<h2>agricultural<br>seeds</h2>

					<p>Lorem ipsum dolor sit ctetueradipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet
						dolorese magna aiqu.</p>
				</div>
				<a href="#" class="button2"> </a>
			</div>
		</section>
	</main>
	<footer class="clearfix">
		<div class="social">
			<p>folow us</p>
			<div>
				<a href="#" class="facebook"></a>
				<a href="#" class="twitter"></a>
				<a href="#" class="google"></a>
				<a href="#" class="rss"></a>
			</div>
		</div>
		<div class="central"><p>address</p>9870 st vincent place, glasgow,&nbsp;dc&nbsp;45&nbsp;fr&nbsp;45.</div>
		<div><p>copyright</p>© 2013| <a href="#">privacy policy</a></div>
	</footer>
</div>
</body>
</html>