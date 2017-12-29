<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo hscAll(Core::$META['title']); ?></title>
    <meta name="description" content="<?php echo hscAll(Core::$META['description']); ?>">
    <meta name="keywords" content="<?php echo hscAll(Core::$META['keywords']); ?>">
    <link href="/skins/admin/css/styledelicatos.css" rel="stylesheet" type="text/css">
    <?php if (count(Core::$CSS)){echo implode("\n",Core::$CSS);} ?>
    <?php if (count(Core::$JS)){echo implode("\n",Core::$JS);} ?>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <a href="#" class="red"></a>
        <a href="/" class="logo"><img src="/skins/admin/img/logo_admin.png" alt="logo"></a>
        <div class="information">
            <div class="admin">
                 <p>my admin</p>
            </div>
            <div class="navigation">
                <a href="/static/main" class="active">home</a>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 5){ ?>
                    <a href="/admin/users" class="nav">users</a>
                    <a href="/admin/news" class="nav">news</a>
                    <a href="/admin/goods" class="nav">catalog</a>
                    <a href="/admin/books" class="nav">books</a>
                    <a href="/cabinet/exit" class="nav">Выход</a>
                <?php } ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="content">
    <!-- Роутер-->
    <?php echo $content; ?>
    </div>
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
    </div>
</div>
</body>
</html>