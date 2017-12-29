<?php if (isset($row)) { ?>
<div class="container">
	<div class="row">
		<div class="col-sm-7"><h1><?php echo hc($row['header']); ?></h1></div>
		<?php if ((User::$id == $row['author_id'] || User::$role == 'admin') && !empty(User::$ftp_login)) { ?>
			<div class="add col-sm-4">
				<a href="/employment/stories/edit/<?php echo hc($row['id']); ?>" class="btn btn-success"
				   role="button"><span
							class="glyphicon glyphicon-pencil"
							aria-hidden="true"></span>Редактировать</a>
			</div>
		<?php } ?>
	</div>
</div>
<div class="content">
	<div class="story_content">
		<div class="info">
			<?php echo $row['date']; ?>
			<p>Автор: <?php echo hc($row['author_name']); ?></p>
		</div>
		<p><?php echo BBCode2Html($row['short_text']); ?></p>
		<p><?php echo BBCode2Html($row['text']); ?></p>
	</div>
	<?php
	$stories->close();
	} else {
		echo '<p>Истории отсутствуют</p>';
	} ?>
</div>