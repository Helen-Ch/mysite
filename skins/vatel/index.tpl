<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="dns-prefetch" href="http://katrin.school-php.com/vatel">
	<link rel="dns-prefetch" href="/images/vatel-logo.png">
	<link rel="dns-prefetch" href="/images/vatelSprite1.png">
	<link rel="dns-prefetch" href="/images/DPP_767_4.jpg">
	<title>Корпоратив в Москве и МО</title>
	<meta name="apple-mobile-web-app-title" content="Vatel">
	<meta name="description"
		  content="Организация и проведение корпоративов, свадеб, дней рождения в Москве и Московской области. Заказ по телефону или на сайте. Праздничное агентство Vatel - всегда только профессиональные музыканты и ведущие.">
	<meta name="keywords"
		  content="корпоратив в Москве, корпоратив в Московской области, ведущие на свадьбу в Москве, заказ музыкантов в Москве,  праздничное агентсво">
	<meta name="author" content="Чернова Елена">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<!--<meta name="robots" content="index, follow">-->
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="canonical" href="http://katrin.school-php.com/vatel">
	<meta name="google-site-verification" content="L-MzxZjyYcMkEC4BdvnbPHIzDCRX4SbrrIagWe2ELb8"/>
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<meta property="og:locale" content="ru-UA">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Праздничное агентство Vatel">
	<meta property="og:url" content="http://katrin.school-php.com/vatel">
	<meta property="og:title" content="Корпоратив в Москве и МО">
	<meta property="og:description"
		  content="Организация и проведение корпоративов, свадеб, дней рождения в Москве и Московской области.">
	<meta property="og:image" content="http://katrin.school-php.com/images/DPP_767_2.JPG">
	<meta property="og:site_name" content="katrin.school-php.com">

	<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.min.css">
	<style><?php echo file_get_contents('./style/vatel.css'); ?></style>
</head>
<body>
<header>
	<div class="wrapper" itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="name" content="Vatel">
		<meta itemprop="address" content="Россия">
		<link itemprop="url" href="http://katrin.school-php.com/vatel">
		<a href="/" class="logo vmid"><img class="img-responsive center-block" src="/images/vatel-logo.png" alt="Vatel"
										   itemprop="logo"></a>
		<div class="title vmid"><h1 itemprop="description">Ведущие на свадьбу, юбилей, корпоратив в Москве и МО</h1>
		</div>
		<div class="phone vmid">
			<a href="tel://+74957609650" title="позвонить" itemprop="telephone">+7&nbsp;(495)&nbsp;760-96-50</a>
			<a href="tel://+79265868003" title="позвонить" itemprop="telephone">+7&nbsp;(926)&nbsp;586-80-03</a>
		</div>
		<div class="button vmid">
			<button class="btn" type="button" data-toggle="modal" data-target="#myModalForm">Закажите звонок</button>
		</div>
	</div>
</header>
<main>
	<!-- Роутер-->
	<?php echo $content; ?>
</main>
<footer>
	<div class="wrapper" itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="name" content="Vatel">
		<meta itemprop="address" content="Россия">
		<p>Остались вопросы?&nbsp;Позвоните нам
			<a href="tel://+74957609650" title="позвонить" itemprop="telephone">+7&nbsp;(495)&nbsp;760-96-50,</a>
			<a href="tel:+79265868003" title="позвонить" itemprop="telephone">+7&nbsp;(926)&nbsp;586-80-03</a>
		</p>
		<p>Или <span class="callback" data-toggle="modal" data-target="#myModalForm">закажите обратный звонок</span></p>
		<h6 itemprop="description">&copy;&nbsp;Праздничное&nbsp;агентство&nbsp;&laquo;Vatel&raquo;&nbsp;&ndash;
			Музыкальный коллектив на праздник в
			Москве и МО</h6>
	</div>
</footer>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">спасибо за заявку!</h4>
			</div>
			<div class="modal-body">
				Наш менеджер перезвонит Вам в ближайшее время.
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<!-- Modal Form -->
<div class="modal fade" id="myModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Отправьте заявку и мы обязательно Вам перезвоним</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="/vatel/main.php" name="order3" class="form-horizontal">
					<div class="form-group">
						<label for="InputLogin" class="col-xs-4">Ваше имя*</label>
						<div class="col-xs-8">
							<input type="text" name="login" id="InputLogin" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label for="InputTel" class="col-xs-4">Ваш телефон*</label>
						<div class="col-xs-8">
							<input type="tel" name="tel" id="InputTel" class="form-control phone" required>
						</div>
					</div>
					<button type="submit" name="button3" class="btn">оставить заявку</button>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
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
<!--<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-105314784-1', 'auto');
    ga('send', 'pageview');

</script>-->
<!--LiveInternet counter--><!--<script type="text/javascript">
    document.write("<a href='//www.liveinternet.ru/click' "+
        "target=_blank><img src='//counter.yadro.ru/hit?t27.1;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";"+Math.random()+
        "' alt='' title='LiveInternet: показано количество просмотров и"+
        " посетителей' "+
        "border='0' width='88' height='120'><\/a>")
</script>--><!--/LiveInternet-->
<!-- Yandex.Metrika informer -->
<!--<a href="https://metrika.yandex.ru/stat/?id=45733830&amp;from=informer"
   target="_blank" rel="nofollow"><img src="https://metrika-informer.com/informer/45733830/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
									   style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="45733830" data-lang="ru" /></a>-->
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<!--<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45733830 = new Ya.Metrika({
                    id:45733830,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45733830" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
<!-- /Yandex.Metrika counter -->
<script src="/vendor/public/jquery/dist/jquery.min.js"></script>
<!--<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.min.css">-->
<!--<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap-theme.min.css">-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" defer></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" defer></script>
<![endif]-->
<!--<link rel="stylesheet" href="/style/vatel.css">-->
<script src="/vendor/public/bootstrap/dist/js/bootstrap.min.js" defer></script>
<script src="/vendor/public/jquery-maskedinput/jquery-maskedinput.min.js" defer></script>
<script type="text/javascript" src="/vendor/flowplayer/flowplayer.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="/vendor/flowplayer/skin/skin.css">
<!--подключаем  fancybox-->
<link rel="stylesheet" href="/vendor/public/fancybox/dist/jquery.fancybox.min.css">
<script src="/vendor/public/fancybox/dist/jquery.fancybox.min.js" defer></script>
<script src="/js/vatel.js" defer></script>
<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url" : "http://katrin.school-php.com/addon/vatel.html",
      "logo" : "http://katrin.school-php.com/images/vatel-logo.png",
      "name": "Vatel",
      "telephone": "+7 (495) 760-96-50"
    }
</script>
</body>
</html>