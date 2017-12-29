<div class="content">
	<?php if (isset($info)) { ?>
		<h3><?php echo $info; ?></h3>
		<hr>
	<?php }
	if ($all_stories->num_rows) {
		while ($row = $all_stories->fetch_assoc()) { ?>
			<div class="story_content clearfix">
				<h2>
					<a href="/employment/stories/readMore/<?php echo $row['id']; ?>"><?php echo hc($row['header']); ?></a>
				</h2>
				<div class="info">
					<?php echo $row['date']; ?> | Автор:
					<?php echo hc($row['author_name']); ?> | Количество просмотров: <?php if(!empty($row['views'])){ echo $row['views']; } ?>
				</div>
					<p><?php echo BBCode2Html($row['short_text']); ?></p>
					<p class="title"><a
								href="/employment/stories/readMore/<?php echo $row['id']; ?>">Подробнее&hellip;</a></p>
			</div>
		<?php }
	} else {
		echo '<p>Поделитесь своим опытом! Ваша история будет первой!</p>';
	}
	if(isset($row_un)){ ?>
	<div id="unpubModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<p>У Вас есть неопубликованная запись!<br>Проверьте и опубликуйте!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<a role="button" class="btn btn-primary" href="/employment/stories/preview/<?php echo $row_un['id']; ?>">Проверить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
	<?php }?>
</div>