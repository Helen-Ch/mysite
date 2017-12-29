<div class="addStory">
	<p class="hp">Редактировать историю</p>
	<div>
		<?php if (!empty(User::$id) && !empty(User::$role) && !empty(User::$ftp_login) && !isset($_SESSION['info'])) { ?>
			<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="inputName" class="col-sm-offset-1 col-sm-2 control-label">Ваше имя</label>
					<div class="col-sm-8">
						<input required type="text" id="inputName" name="author_name" class="form-control"
							   placeholder="Имя"
							   value="<?php if (isset($_POST['author_name'])) {
								   echo hc($_POST['author_name']);
							   } else {
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
							<label class="radio-inline  main-tooltip" data-toggle="tooltip" data-placement="top"
								   title="Tooltip on top">
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
					<label for="inputHeader" class="col-sm-offset-1 col-sm-2 control-label">Заголовок</label>
					<div class="col-sm-8">
						<input required type="text" id="inputHeader" name="header" class="form-control"
							   placeholder="Заголовок"
							   value="<?php if (isset($_POST['header'])) {
								   echo hc($_POST['header']);
							   } else {
								   echo hc($row['header']);
							   } ?>">
						<p class="error"><?php if (isset($errors['header'])) {
								echo $errors['header'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
						<label for="inputShortText">Краткое описание</label>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
					<textarea required id="inputShortText" name="short_text" rows="5" class="form-control"
							  placeholder="Началось все с того, что&hellip;">
						<?php if (isset($_POST['short_text'])) {
							echo hc($_POST['short_text']);
						} else {
							echo hc($row['short_text']);
						} ?>
					</textarea>
						<p class="error"><?php if (isset($errors['short_text'])) {
								echo $errors['short_text'];
							} ?></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
						<label for="inputText" class="">Описание</label>
					</div>
					<div class="col-sm-offset-1 col-sm-10">
					<textarea required id="inputText" name="text" rows="8" class="form-control"
							  placeholder="А потом&hellip;">
						<?php if (isset($_POST['text'])) {
							echo hc($_POST['text']);
						} else {
							echo hc($row['text']);
						} ?>
					</textarea>
						<p class="error"><?php if (isset($errors['text'])) {
								echo $errors['text'];
							} ?></p>
					</div>
				</div>
				<input type="submit" value="Редактировать!" name="edit" class="col-sm-offset-1 btn btn-info">
				<input type="submit" value="Удалить!" name="delete" class="btn btn-danger" onclick="return del();">
			</form>
		<?php } else { ?>
			<p class="">Вам необходимо авторизироваться на сайте <a href="#">Вход</a></p>
		<?php } ?>
	</div>
</div>