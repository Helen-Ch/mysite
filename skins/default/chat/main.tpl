<div class="chat-box">
    <div id="users_on" class="online">
        <p>Сейчас на сайте: <span class="count_us"><?php echo $us->num_rows; ?></span></p>
        <div id="us_list">
            <?php
            if ($us->num_rows) {
                while ($row = $us->fetch_assoc()) { ?>
                    <p class="user_name"
                       onclick="privateMess('<?php echo hscAll($row['login']); ?>')"><?php echo hscAll($row['login']); ?></p>
                <?php }
            }
            $us->close(); ?>
        </div>
    </div>
    <div class="chat">
        <div id="show_msg" class="msg">
            <?php if ($mess->num_rows) {
                while ($row1 = $mess->fetch_assoc()) {
                    echo '<div id="' . $row1['id'] . '" class="full_text"><p>' . hscAll($row1['login']) . ':&nbsp;<span>' . $row1['date'] . '</span></p>
                        <p class="msg_text">' . hscAll($row1['text']) . '</p><p><span>id: ' . $row1['id'] . '</span></p>';
                    if (isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) {
                        // Если сообщение не удалено, выводим кнопку удаления
                        if ($row1['status'] != 1) { ?>
                            <div class="delete_msg" onclick="delMess(<?php echo $row1['id']; ?>);">&#10008;</div>
                        <?php }
//                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
            $mess->close();
            ?>
        </div>
        <form action="" method="post" class="chat_form" onsubmit="return chatAjax();">
            <!-- <input id="hide" type="hidden" name="appeal" value="">-->
            <?php if (isset($_SESSION['user'])) { ?>
                <textarea id="msg" name="text" cols="15" rows="2" value=""></textarea>
                <input type="submit" name="send_msg" value="Send">
            <?php } else { ?>
                <input type="text" disabled value="Для участия в чате Вам необходимо авторизироваться!">
            <?php } ?>
        </form>
    </div>
    <div class="clear"></div>
</div>