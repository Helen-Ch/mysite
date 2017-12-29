<?php
error_reporting(-1);
ini_set('display_errors', 'On');
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('Europe/Kiev');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders</title>
	<script src="/vendor/public/jquery/dist/jquery.min.js"></script>
	<script src="/vendor/public/jquery-ui/jquery-ui.min.js"></script>
	<script src="/vendor/public/jquery-ui/ui/i18n/datepicker-uk.js"></script>
	<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/vendor/public/jquery-ui/themes/sunny/jquery-ui.min.css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/style/style-bootstrap.css">
	<script src="/vendor/public/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/js/scripts1.js" defer></script>
</head>
<body>
<header>
	<div class="logo">
		<div class="container clearfix">
			<a href="/"><img src="/images/logoD.png" alt="logo"></a>
			<div class="mini-menu" onclick="$('#menu').toggle('slow');"><span class="glyphicon glyphicon-menu-hamburger"
																			  aria-hidden="true"></span></div>
		</div>
	</div>
	<nav id="menu" class="clearfix">
		<ul class="container nav nav-pills">
			<li role="presentation" class="active"><a href="/">home</a></li>
			<li role="presentation"><a href="#">заказы<span class="badge">3</span></a></li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
				   aria-expanded="false">
					каталог товаров<span class="caret"></span>
					<ul class="dropdown-menu">
						<li role="presentation"><a href="#">категории товаров</a></li>
						<li role="presentation"><a href="#">список товаров</a></li>
						<li role="presentation"><a href="#">типы цен</a></li>
						<li role="presentation"><a href="#">бренды</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">наборы товаров</a></li>
					</ul>
				</a>
			</li>
			<li role="presentation"><a href="#">пользователи</a></li>
			<li role="presentation"><a href="#">страницы</a></li>
			<li role="presentation"><a href="#">статистика</a></li>
			<li role="presentation"><a href="#">настройки</a></li>
		</ul>
	</nav>
</header>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-lg-7">Список заказов</div>
		<div class="col-xs-12 col-sm-8 col-lg-5">
			<a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-pencil"
																	aria-hidden="true"></span>Изменить статус</a>
			<a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="#myModal"><span
						class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>Удалить</a>
			<a href="#" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign"
																	aria-hidden="true"></span>Создать заказ</a>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-hover">
			<tr class="active">
				<th><input type="checkbox" name="total" value=""></th>
				<th>id</th>
				<th><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></th>
				<th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
				<th>Статус</th>
				<th>Заказчик</th>
				<th>Товары</th>
				<th>Общая стоимость</th>
				<th>Статус оплаты</th>
			</tr>

			<tr>
				<td><input type="checkbox" name="ids[]" value=""></td>
				<td><a href="#">1</a></td>
				<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				</td>
				<td><a href="#" class="remove" data-toggle="modal" data-target="#myModal"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
				<td><span class="label label-success">Новый</span></td>
				<td><a href="#">Admin</a></td>
				<td>5</td>
				<td>100 $</td>
				<td><span class="label label-default">Неоплачен</span></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="ids[]" value=""></td>
				<td><a href="#">2</a></td>
				<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				</td>
				<td><a href="#" class="remove" data-toggle="modal" data-target="#myModal"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
				<td><span class="label label-info">Доставлен</span></td>
				<td><a href="#">Vasya</a></td>
				<td>8</td>
				<td>352 $</td>
				<td><span class="label label-info">Оплачен</span></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="ids[]" value=""></td>
				<td><a href="#">3</a></td>
				<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				</td>
				<td><a href="#" class="glyphicon glyphicon-remove" aria-hidden="true" data-toggle="modal" data-target="#myModal"></a></td>
				<td><span class="label label-danger">Оплачен бонусом</span></td>
				<td><a href="#">Petya</a></td>
				<td>13</td>
				<td>750 $</td>
				<td><span class="label label-info">Оплачен</span></td>
			</tr>
		</table>
	</div>
<!--	<main>
		<form action="" method="post" name="orders">
			<table class="table table-bordered table-hover">
				<tr class="active">
					<th><input type="checkbox" name="total" value=""></th>
					<th>id</th>
					<th><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</th>
					<th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</th>
					<th>Статус</th>
					<th>Дата</th>
					<th>Заказчик</th>
					<th>Товары</th>
					<th>Общая стоимость</th>
					<th>Статус оплаты</th>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" size="1"></td>
					<td></td>
					<td></td>
					<td><select name="status">
							<option disabled selected value="">Все</option>
							<option value="">Новый</option>
							<option value="">Доставлен</option>
							<option value="">Оплачен бонусом</option>
						</select>
					</td>
					<td>
						<input type="text" size="6" placeholder="от" class="datepicker">
						<input type="text" size="6" placeholder="до" class="datepicker">
					</td>
					<td><input type="text" name="" value="" size="10"></td>
					<td><input type="text" name="" value="" size="2"></td>
					<td><input type="text" placeholder="от" name="" value="" size="2">
						<input type="text" placeholder="до" name="" value="" size="2">
					</td>
					<td>
						<select name="paid">
							<option disabled selected value="">Все</option>
							<option value="">Неоплачен</option>
							<option value="">Оплачен</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="ids[]" value=""></td>
					<td><a href="#">1</a></td>
					<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</a>
					</td>
					<td><a href="#" class="remove" data-toggle="modal" data-target="#myModal"><span
									class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a></td>
					<td><span class="label label-success">Новый</span></td>
					<td>01-06-2017</td>
					<td><a href="#">Admin</a></td>
					<td>5</td>
					<td>100 $</td>
					<td><span class="label label-default">Неоплачен</span></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="ids[]" value=""></td>
					<td><a href="#">2</a></td>
					<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</a>
					</td>
					<td><a href="#" class="remove" data-toggle="modal" data-target="#myModal"><span
									class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a></td>
					<td><span class="label label-info">Доставлен</span></td>
					<td>05-06-2017</td>
					<td><a href="#">Vasya</a></td>
					<td>8</td>
					<td>352 $</td>
					<td><span class="label label-info">Оплачен</span></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="ids[]" value=""></td>
					<td><a href="#">3</a></td>
					<td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</a>
					</td>
					<td><a href="#" class="remove" data-toggle="modal" data-target="#myModal"><span
									class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a></td>
					<td><span class="label label-danger">Оплачен бонусом</span></td>
					<td>10-06-2017</td>
					<td><a href="#">Petya</a></td>
					<td>13</td>
					<td>750 $</td>
					<td><span class="label label-info">Оплачен</span></td>
				</tr>
			</table>
		</form>
	</main>-->

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Удаление записи</h4>
				</div>
				<div class="modal-body">
					Вы действительно хотите удалить данные?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
					<button type="button" class="btn btn-primary">Удалить</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="/images/slide-1.jpg" alt="slide">
			</div>
			<div class="item">
				<img src="/images/slide-2.jpg" alt="slide">
			</div>
			<div class="item">
				<img src="/images/slide.jpg" alt="slide">
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
</body>
</html>