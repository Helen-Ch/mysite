<?php
/**
 * Created by PhpStorm.
 * User: Olena
 * Date: 17.04.2018
 * Time: 21:12
 */
if (!isset($_SESSION['user'])) { ?>
    <div><a href="<?php echo $path; ?>" class="fb_link"><img src="/skins/default/img/facebook-pencil6.png"></a></div>

<?php } ?>
