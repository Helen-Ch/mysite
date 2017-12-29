<div class="content">
	<?php if($interviews->num_rows) {
		while ($row = $interviews->fetch_assoc()) { ?>
			<div class="story_content clearfix">
				<h2>
					<a href="/employment/stories/readMore/<?php echo $row['id']; ?>"><?php echo hc($row['header']); ?></a>
				</h2>
				<div class="info">
					<?php echo $row['date']; ?> | Автор:
					<?php echo hc($row['author_name']); ?> | Количество просмотров: <?php if(!empty($row['views'])){ echo $row['views']; } ?>
				</div>
				<div>
					<p><?php echo BBCode2Html($row['short_text']); ?></p>
					<p class="title"><a
								href="/employment/stories/readMore/<?php echo $row['id']; ?>">Подробнее&hellip;</a></p>
				</div>
			</div>
			<?php } } else {
		echo '<p>Поделитесь своим опытом! Ваша история будет первой!</p>';
	} ?>
</div>
