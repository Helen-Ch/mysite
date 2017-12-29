<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo hc(Core::$META['title']); ?></title>
    <meta name="apple-mobile-web-app-title" content="Заголовок без SEO">
    <meta name="description" content="Описание страницы">
    <meta name="keywords" content="Ключевые слова для некоторых поисковиков">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/touch-icon-ipad-retina.png">

	<script src="/skins/employment/vendor/public/jquery/dist/jquery.min.js"></script>
	<script src="/skins/employment/vendor/public/jquery-ui/ui/i18n/datepicker-uk.js"></script>
	<link rel="stylesheet" href="/skins/employment/vendor/public/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/skins/employment/vendor/public/bootstrap/dist/css/bootstrap-theme.min.css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/skins/employment/vendor/public/jquery/dist/style.css">
	<link rel="stylesheet" href="/skins/employment/vendor/public/jquery/dist/bbcode/style.css">
	<link rel="stylesheet" href="/skins/employment/style/style-story.css">
	<script src="/skins/employment/vendor/public/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/skins/employment/vendor/public/jquery/dist/bbcode/jquery.markitup.js"></script>
	<script src="/skins/employment/vendor/public/jquery/dist/bbcode/set.js"></script>
	<?php if (count(Core::$JS)){echo implode("\n",Core::$JS);} ?>
	<script language="javascript">
        $(document).ready(function()	{
            $('textarea').markItUp(myBbcodeSettings);

            $('#emoticons a').click(function() {
                emoticon = $(this).attr("title");
                $.markItUp( { replaceWith:emoticon } );
            });
        });
	</script>
	<script src="/skins/employment/js/scripts.js"></script>
</head>
<body>
<div class="wrapper">
	<header>

		<nav>

		</nav>
	</header>
	<main>
		<!-- Роутер-->
		<?php echo $content; ?>
	</main>
	<footer>
		<div class="footer">&#169;
			<?php
			$date = date('Y');
			if (Core::$CREATED == $date) {
				echo Core::$CREATED;
			} else {
				echo(Core::$CREATED . '-' . $date);
			}
			?>
		</div>
		<div> Подвал сайта, Копирайты</div>
	</footer>
</div>
</body>
</html>