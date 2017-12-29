<div class="content container clearfix">
	<?php if (isset($row)) { ?>
	<p class="preview"><span class="label label-danger">Предпросмотр!</span></p>
	<form action="" method="post">
		<div class="row">
			<p class="col-xs-6">Убедитесь, что все в по&shy;рядке и на&shy;жми&shy;те "Опу&shy;бли&shy;ко&shy;вать!"</p>
			<div class="col-xs-6">
				<button type="submit" name="publishOk" class="btn btn-primary active"><span
							class="glyphicon glyphicon-ok"
							aria-hidden="true"></span>Опубликовать!
				</button>
			</div>
		</div>
		<div class="story_content">
			<h2><a href="#"><?php echo hc($row['header']); ?></a></h2>
			<div class="info">
				<?php echo $row['date']; ?> | Автор: <?php echo $row['author_name']; ?>
			</div>
			<p><?php echo BBCode2Html($row['short_text']); ?></p>
			<p><?php echo BBCode2Html($row['text']); ?></p>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<button type="submit" name="publishOk" class="btn btn-primary active"><span
							class="glyphicon glyphicon-ok"
							aria-hidden="true"></span>Опубликовать!
				</button>
				<a class="btn btn-info" role="button" href="/employment/stories/addStory/<?php echo $row['id']; ?>"><span
							class="glyphicon glyphicon-pencil"></span>Назад к форме</a>
			</div>
		</div>
	</form>
	<?php } else{ ?>
	<h3>Такой истории не существует!</h3>
	<?php } ?>

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<p>Вы действительно хотите закрыть страницу?</br>Несохраненные данные будут потеряны!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

