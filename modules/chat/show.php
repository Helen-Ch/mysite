<?php
Core::$META['title'] = 'Chat';
//удаляем из базы сообщения, добавленные ранее 30 минут назад
$res = q("
     SELECT *
     FROM `chat`       
     WHERE `date` < NOW() - INTERVAL 30 MINUTE    
     ORDER BY `id` DESC      
");
if($res->num_rows){
    $list2 = array();
    while ($row_res = $res->fetch_assoc()) {
        $list2[] = $row_res['id'];
    }
    q("
        DELETE 
        FROM `chat`
        WHERE `id` IN (".implode(",",$list2).")
    ");
}
$res->close();
//удаляем из базы id удаленных сообщений, добавленные ранее 30 минут назад
$res = q("
     SELECT *
     FROM `chat_del_id`       
     WHERE `date` < NOW() - INTERVAL 30 MINUTE     
     ORDER BY `id` DESC      
");
if($res->num_rows){
    $list3 = array();
    while ($row_res3 = $res->fetch_assoc()) {
        $list3[] = $row_res3['id'];
    }
    q("
        DELETE 
        FROM `chat_del_id`
        WHERE `id` IN (".implode(",",$list3).")
    ");
}
$res->close();
////////////////////////////////

// получаем список пользователей онлайн
    $us = q("
    SELECT  `id`, `login`
    FROM `users`
    WHERE `last_date` > NOW() - INTERVAL 3 MINUTE    
    ORDER BY `login`
");

//формируем ответ
$msg = array();

// 1) если есть новые сообщения
//  получаем новые сообщения по id
if (isset($_POST['last'])) {// если это пришло из JS
    $res = q("
      SELECT *
      FROM `chat`       
      WHERE `id` > " . (int)$_POST['last'] . "
        AND `login` <> '" . mresAll($_SESSION['user']['login']) . "' /*кроме автора, чтобы не дублировать вывод, т.к. автору текст сразу выводит JS*/
      ORDER BY `id`      
    ");
    if ($res->num_rows) {
        $msg['new'] = array();
        while ($row = $res->fetch_assoc()) {
            $msg['new'][$row['id']] = $row;
            if (isset($_SESSION['user'])) {
            // проверяем, есть ли личное обращение в сообщении
                $pos1 = stripos($row['text'], $_SESSION['user']['login']);
                if ($pos1 !== false) {
                    $msg['new'][$row['id']]['appeal'] = 1;
                }
            }
            // записываем id последнего переданного сообщения
            $msg['lastId'] = $row['id'];
        }
    // если нет новых сообщений, просто возвращаем id последнего переданного сообщения
    } else {
        $msg['lastId'] = $_POST['last'];
    }
// передаем последний id в JS после добавления нового сообщения
} else {
    $mid = q("
      SELECT `id`
      FROM `chat`
      ORDER BY `id` DESC 
      LIMIT 1
    ");
    if ($mid->num_rows) {
        while ($row5 = $mid->fetch_assoc()) {
            $msg['lastId'] = $row5['id'];
        }
    }
}

// 2) если есть удаленные id,
//  получаем id удаленных сообщений
if (isset($_POST['lastDel'])) {
    $res2 = q("
      SELECT *
      FROM `chat_del_id` 
      WHERE `deleted_id` > " . (int)$_POST['lastDel'] . "
      ORDER BY `deleted_id`                    
    ");
    if ($res2->num_rows) {
        while ($row_res2 = $res2->fetch_assoc()) {
            // записываем id последнего удаленного сообщения
            $msg['lastDelId'] = $row_res2['deleted_id'];
            // создаем массив id-в удаленных сообщений для всех, кроме модератора, ему выводит JS
             if($_SESSION['user']['access'] != 5) {
                 $msg['del'][$row_res2['id']] = $row_res2;
             }
        }
    // если нет новых  удаленных сообщений, просто возврвщаем id последнего удаленного сообщения
    } else {
        $msg['lastDelId'] = $_POST['lastDel'];
    }
} else {
    $did = q("
      SELECT *
      FROM `chat_del_id`
      ORDER BY `deleted_id` DESC 
      LIMIT 1
    ");
    if ($did->num_rows) {
        while ($row6 = $did->fetch_assoc()) {
            $msg['lastDelId'] = $row6['deleted_id'];
        }
    }
}
// 3) получаем список пользователей онлайн
if ($us->num_rows) {
    while ($row4 = $us->fetch_assoc()) {
        $msg['countUs'] = $us->num_rows;
        $msg['users'][] = $row4;
    }
}
echo json_encode($msg);
exit();