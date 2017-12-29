<div class="file_manager">
<?php
foreach ($array as $file){
	$dir = (isset($_GET['link']) ? './'.$_GET['link'].'/'.$file : $file);
	if(is_dir($dir)){
		if($file != '..' && $file != '.') {
			echo '<a href="/file_manager/main?link=' . $dir . '"><img src="/skins/default/img/folder_red.png" alt="directory">' . $file . '</a><br>';
		}
	}else {
		echo '<img src="/skins/default/img/file-edit.jpg" alt="file">'.$file.'<br>';
	}
 } ?>
</div>