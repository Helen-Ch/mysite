<?php
//https://www.templatemonster.com/demo/57803.html
Core::$JS[] = '<script src="/skins/default/js/scripts_v1.js"></script>';
Core::$META['title'] = 'Test';
//wtf($_POST,1);
//phpinfo();
if(isset($_POST['submit'],$_FILES['file'])) {
    // проверяем, можно ли загружать изображение
    $upload = ImageUploading::upload($_FILES['file']);

    if($upload == true){
        // загружаем изображение на сервер

        $img = ImageUploading::resize('.'.ImageUploading::$name,  800, 600);

        $avatar = ImageUploading::resize('.'.ImageUploading::$name, 200, 200);
$logo = ImageUploading::add_WM('.'.$img);
    }
}










//wtf($_FILES,1);
/*
// RESIZE
$array = array('image/gif','image/jpeg','image/png');
$array2 = array('jpg','jpeg','gif','png');
$max_width = 200;
$max_height = 200;
function resize($file)
{
    global $name;
    global $max_width;
    global $max_height;
    $temp = getimagesize($file);
    wtf($temp, 1);
    if ($temp['mime'] == 'image/jpeg') {
        $source = imagecreatefromjpeg($file);
        $name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.jpg';
    } elseif ($temp['mime'] == 'image/png') {
        $source = imagecreatefrompng($file);
        $name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.png';
    } elseif ($temp['mime'] == 'image/gif') {
        $source = imagecreatefromgif($file);
        $name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.gif';
    }
   /* if ($temp[0] > $max_width ) {
        // Вычисление пропорций
        $ratio = $temp[0] / $max_width;
        $newwidth = round($temp[0] / $ratio);
        $newheight = round($temp[1] / $ratio);
    } elseif ($temp[1] > $max_height) {
            $ratio = $temp[1] / $max_height;
            $newheight = round($temp[1] / $ratio);
            $newwidth = round($temp[0] / $ratio);
        }*/

  /* $ratio_orig = $temp[0]/$temp[1];

    if ($max_width/$max_height > $ratio_orig) {
        $newwidth = $max_height*$ratio_orig;
        $newheight = $max_height;
    } else {
        $newheight = $max_width/$ratio_orig;
        $newwidth = $max_width;
    }

        // Создаём пустую картинку
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        // Копируем старое изображение в новое с изменением параметров
        imagecopyresampled($tmp, $source, 0, 0, 0, 0, $newwidth, $newheight, $temp[0], $temp[1]);
        // Вывод картинки и очистка памяти
        imagejpeg($tmp, '.' . $name, 100);
       // wtf($_FILES, 1);
       // echo 'Изображение загружено верно!<p><img src="'.$name.'" alt="image"></p>';
        imagedestroy($tmp);
        imagedestroy($source);
        return $name;

}

if(isset($_POST['submit'])) {
    if ($_FILES['file']['error'] != 0) {
        echo 'Вы не загрузили файл!';
    } elseif ($_FILES['file']['size'] < 5000 || $_FILES['file']['size'] > 50000000) {
        echo 'Размер файла не подходит! ';
    } else {
        preg_match('#\.([a-z]+)#iu', $_FILES['file']['name'], $matches);
        if (isset($matches[1])) {
            $matches[1] = mb_strtolower($matches[1]);
            $temp = getimagesize($_FILES['file']['tmp_name']);
            $name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.jpg';
            if (!in_array($matches[1], $array2)) {
                echo 'Неправильное расширение файла!';
            } elseif (!in_array($temp['mime'], $array)) {
                echo 'Не подходит тип файла, можно загружать только изображения!';
            }elseif($temp[0] > $max_width || $temp[1] > $max_height){
                resize($_FILES['file']['tmp_name']);
            }elseif (!move_uploaded_file($_FILES['file']['tmp_name'], '.' . $name)) {
                echo 'Изображение не загружено!';
            } else {
                echo 'Изображение загружено верно!';
            }


        }else {
             echo 'Данный файл не является картинкой. Принимаемые файлы: jpg, gif, png.';
        }
    }
//wtf($temp, 1);
//wtf($_FILES, 1);
*/
/*foreach($author1 as $m => $n) { ?>
    <a href="/admin/books/author_list/<?php echo $n['id']; ?>"><?php echo hscAll($n['author']); if($m != $last){ echo ', '; } ?></a>
<?php  }


/*if(isset($_POST['add_author'])){
    $sql = 'INSERT INTO `books2books_author` (`book_id`, `author_id`) VALUES ';
    if(isset($_POST['author'])) {
        foreach ($_POST['author'] as $array) {// Дополняем SQL запрос
            $sql .= "(" . (int)$_GET['key1'] . ", " . $array['author_id'] . "),";
        }
    }
        // Отрезаем лишнюю запятую (последнюю)
        $sql = rtrim($sql, ',');
        // Тут записываем в БД
        q("$sql");
        $_SESSION['info'] = 'Авторы добавлены к данной книге!';
        header("Location: /admin/books");
        exit();

}*/
/*//вывод пагинации
if(isset($prepage)){
    echo $prepage;
}
for ($j = 1; $j<=$total; $j++) {
    if ($j>=$before_limit && $j<=$after_limit) {
        if ($j==$page){
            echo '<b style="color:#FF556C;">'.$j.'</b>&nbsp;';
        } else {
            echo '<a href="?num='.$j.'">'.$j.'</a>&nbsp;';
        }
    }
}
if(isset($nextpage)){
    echo $nextpage;
}*/


