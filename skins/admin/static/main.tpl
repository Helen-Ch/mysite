<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5){
	include './skins/default/cabinet/authorization.tpl';
} else { ?>
    <div class="cabinet">
        <p>Привет, admin!</p>
        <p><img src="/skins/admin/img/girl.jpg" alt="girl" width="100%"></p>
    </div>
<?php } ?>