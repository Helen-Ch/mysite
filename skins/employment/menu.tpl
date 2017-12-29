<div class="container">
	<div class="row">
		<nav id="menu" class="col-sm-7">
			<ul class="breadcrumb">
				<li role="presentation"><a href="/">Главная</a></li>
				<li role="presentation" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
															href="/employment/stories" role="button"
															aria-haspopup="true"
															aria-expanded="false">Истории<span class="caret"></span>
						<ul class="dropdown-menu">
							<li role="presentation"><a href="/employment/stories">Все</a></li>
							<li role="presentation"><a href="/employment/stories/tests">Тестовые задания</a></li>
							<li role="presentation"><a href="/employment/stories/interview">Собеседование</a></li>
						</ul>
					</a>
				</li>
				<?php if ($thisPage == 'allStory') {
					echo '<li role="presentation" class="active">Все</li>';
				} elseif ($thisPage == 'tests') {
					echo '<li role="presentation" class="active">Тестовые задания</li>';
				} elseif ($thisPage == 'interview') {
					echo '<li role="presentation" class="active">Собеседование</li>';
				} ?>

			</ul>
		</nav>
		<?php if(!empty(User::$id) && !empty(User::$role) && !empty(User::$ftp_login)){ ?>
		<div class="add col-sm-5">
			<a href="/employment/stories/addStory" class="btn btn-success" role="button"><span
						class="glyphicon glyphicon-plus-sign"
						aria-hidden="true"></span>Добавить историю</a>
		</div>
		<?php } ?>
	</div>

</div>
