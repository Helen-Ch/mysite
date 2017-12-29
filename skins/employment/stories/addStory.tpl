<div class="addStory">
	<p class="hp">Добавьте свою историю о прохождении собеседования или выполнении тестового задания для
		трудоустройства!!!</p>
	<div>
		<?php if (!empty(User::$id) && !empty(User::$role) && !empty(User::$ftp_login)) { ?>
			<form action="" method="post" enctype="multipart/form-data"
				  class="form-horizontal">
				<div class="form-group">
					<label for="inputName" class="col-sm-offset-1 col-sm-2 control-label">Ваше имя*</label>
					<div class="col-sm-8">
						<input required type="text" id="inputName" name="author_name" class="form-control"
							   placeholder="Имя"
							   value="<?php if (isset($_POST['author_name'])) {
								   echo hc($_POST['author_name']);
							   } elseif (isset($row['author_name'])) {
								   echo hc($row['author_name']);
							   } ?>">
						<p class="error"><?php if (isset($errors['author_name'])) {
								echo $errors['author_name'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-offset-1 col-sm-2 control-label">Выберите категорию*</label>
					<div class="col-sm-8">
						<div class="radio">
						<label>
							<input required type="radio" name="category"
								   value="interview" <?php if (isset($_POST['category']) || (isset($row['category']) && $row['category'] == 'interview')) { ?> checked <?php } ?>>
							Собеседование
						</label>
						</div>
						<div class="radio">
						<label class="radio-inline  main-tooltip" data-toggle="tooltip" title="Удаленное тестовое задание - задание, которое выполняют прерд собеседованием в течение 1 или более дней дома">
							<input type="radio" name="category"
								   value="test" <?php if (isset($_POST['category']) || (isset($row['category']) && $row['category'] == 'test')) { ?> checked <?php } ?>>
							Удаленное тестовое задание
						</label>
						</div>
						<p class="error"><?php if (isset($errors['category'])) {
								echo $errors['category'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="inputHeader" class="col-sm-offset-1 col-sm-2 control-label">Заголовок*</label>
					<div class="col-sm-8">
						<input required type="text" id="inputHeader" name="header" class="form-control"
							   placeholder="Заголовок"
							   value="<?php if (isset($_POST['header'])) {
								   echo hc($_POST['header']);
							   } elseif (isset($row['header'])) {
								   echo hc($row['header']);
							   } ?>">
						<p class="error"><?php if (isset($errors['header'])) {
								echo $errors['header'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
						<label for="inputShortText">Краткое описание*</label>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
						<div id="emoticons">
							<a href="#" title=":)"><img src="/skins/employment/images/emoticon-happy.png" /></a>
							<a href="#" title=":("><img src="/skins/employment/images/emoticon-unhappy.png" /></a>
							<a href="#" title=":o"><img src="/skins/employment/images/emoticon-surprised.png" /></a>
							<a href="#" title=":p"><img src="/skins/employment/images/emoticon-tongue.png" /></a>
							<a href="#" title=";)"><img src="/skins/employment/images/emoticon-wink.png" /></a>
							<a href="#" title=":D"><img src="/skins/employment/images/emoticon-smile.png" /></a>
						</div>
								<textarea required id="inputShortText" name="short_text" rows="5" class="form-control"
										  placeholder="Началось все с того, что&hellip;"><?php if (isset($_POST['short_text'])) {
										echo hc($_POST['short_text']);
									} elseif (isset($row['short_text'])) {
										echo hc($row['short_text']);
									} ?></textarea>
						<p class="error"><?php if (isset($errors['short_text'])) {
								echo $errors['short_text'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
						<label for="inputText" class="">Описание*</label>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
						<textarea required id="inputText" name="text" rows="8" class="form-control"
								  placeholder="А потом&hellip;"><?php if (isset($_POST['text'])) {
								echo hc($_POST['text']);
							} elseif (isset($row['text'])) {
								echo hc($row['text']);
							} ?></textarea>
						<p class="error"><?php if (isset($errors['text'])) {
								echo $errors['text'];
							} ?></p>
					</div>
				</div>
				<p class=" col-sm-offset-1 note">* - обязательные для заполнения поля</p>
				<input type="submit" value="Опубликовать!" name="publish" class="col-sm-offset-1 btn btn-info">
			</form>
		<?php } else { ?>
			<p class="">Вам необходимо авторизироваться на сайте <a href="#">Вход</a></p>
		<?php } ?>
	</div>
</div>