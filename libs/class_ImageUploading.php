<?php
    class ImageUploading
    {
        static public $name = '';
        static public $errors = '';

        static function upload($file)
        {
            $array = array('image/gif', 'image/jpeg', 'image/png');
            $array2 = array('jpg', 'jpeg', 'gif', 'png');
            if ($file['size'] < 5000 || $file['size'] > 50000000) {
                self::$errors = 'Размер файла не подходит! ';
            } else {
                preg_match('#\.([a-z]+)#iu', $file['name'], $matches);
                if (isset($matches[1])) {
                    $matches[1] = mb_strtolower($matches[1]);
                    $temp = getimagesize($file['tmp_name']);
                    // wtf($temp,1);
                    if ($temp['mime'] == 'image/jpeg') {
                        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.jpg';
                    } elseif ($temp['mime'] == 'image/png') {
                        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.png';
                    } elseif ($temp['mime'] == 'image/gif') {
                        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.gif';
                    }
                    if (!in_array($matches[1], $array2)) {
                        self::$errors = 'Неправильное расширение файла!';
                    } elseif (!in_array($temp['mime'], $array)) {
                        self::$errors = 'Не подходит тип файла, можно загружать только изображения!';
                    } elseif (!move_uploaded_file($file['tmp_name'], '.' . self::$name)) {
                        self::$errors = 'Изображение не загружено!';
                    } else {
                        return true;// echo 'Изображение загружено верно!';
                    }
                } else {
                    self::$errors = 'Данный файл не является картинкой. Принимаемые файлы: jpg, gif, png.';
                }
            }
            if (isset(self::$errors)) {
                return false;
            } /*else {
                return true;
            }*/
        }

static function add_WM ($file)
{
    $temp = getimagesize($file);
    //wtf($temp, 1);
    if ($temp['mime'] == 'image/jpeg') {
        $source = imagecreatefromjpeg($file);
        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.jpg';
    } elseif ($temp['mime'] == 'image/png') {
        $source = imagecreatefrompng($file);
        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.png';
    } elseif ($temp['mime'] == 'image/gif') {
        $source = imagecreatefromgif($file);
        self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.gif';
    } else {
        return false;
    }

// Сначала создаем наше изображение штампа вручную с помощью GD
    $stamp_w = $temp[0]*0.2;
    $stamp_h = $temp[1]*0.1;
    $stamp = imagecreatetruecolor($stamp_w, $stamp_h);
    imagestring($stamp, 5, 40, 15, 'Delicatos', 0x00FFFFFF);
    $black = imagecolorallocate($stamp, 0, 0, 0);
    imagecolortransparent($stamp, $black);
    imagefill($stamp, 0, 0, $black);

// Установка полей для штампа и получение высоты/ширины штампа
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

// Слияние штампа с фотографией. Прозрачность 50%
    //imagecopymerge($source, $stamp, (imagesx($source) - $sx)/2, (imagesy($source) - $sy)/2, 0, 0, imagesx($stamp), imagesy($stamp), 15);
    imagecopymerge($source, $stamp, imagesx($source) - $sx - $marge_right, imagesy($source) - $sy - $marge_bottom, 0, 0, $sx, $sy,35);
// Сохранение фотографии в файл и освобождение памяти
   if ($temp['mime'] == 'image/jpeg') {
        imagejpeg($source, '.' . self::$name, 100);
    } elseif ($temp['mime'] == 'image/png') {
        imagepng($source, '.' . self::$name);
    } elseif ($temp['mime'] == 'image/gif') {
        imagegif($source, '.' . self::$name);
    }

    imagedestroy($source);

    return self::$name;
}

        static function resize($file, $newwidth, $newheight)
        {
            $temp = getimagesize($file);
                //wtf($temp, 1);
            if ($temp['mime'] == 'image/jpeg') {
                $source = imagecreatefromjpeg($file);
                self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.jpg';
            } elseif ($temp['mime'] == 'image/png') {
                $source = imagecreatefrompng($file);
                self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.png';
            } elseif ($temp['mime'] == 'image/gif') {
                $source = imagecreatefromgif($file);
                self::$name = '/uploaded/' . date('Y_m_d_H_i_s') . 'img' . rand(10000, 99999) . '.gif';
            } else {
                return false;
            }
            $ratio_orig = $temp[0] / $temp[1];
            if ($newwidth / $newheight > $ratio_orig) {
                $newwidth = round($newheight * $ratio_orig);
            } else {
                $newheight = round($newwidth / $ratio_orig);
            }

            $tmp = imagecreatetruecolor($newwidth, $newheight);

            if ($temp['mime'] == 'image/png') {
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
            } elseif ($temp['mime'] == 'image/gif') {
                    //Получаем прозрачный цвет
                $transparent_source_index = imagecolortransparent($source);
                    //Проверяем наличие прозрачности
                if ($transparent_source_index !== -1) {
                    $transparent_color = imagecolorsforindex($source, $transparent_source_index);
                       //Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
                    $transparent_destination_index = imagecolorallocate($tmp, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                    imagecolortransparent($tmp, $transparent_destination_index);
                        //На всякий случай заливаем фон этим цветом
                    imagefill($tmp, 0, 0, $transparent_destination_index);
                }
            }

            imagecopyresampled($tmp, $source, 0, 0, 0, 0, $newwidth, $newheight, $temp[0], $temp[1]);



            if ($temp['mime'] == 'image/jpeg') {
                imagejpeg($tmp, '.' . self::$name, 100);
            } elseif ($temp['mime'] == 'image/png') {
                imagepng($tmp, '.' . self::$name);
            } elseif ($temp['mime'] == 'image/gif') {
                imagegif($tmp, '.' . self::$name);
            }
            // освобождение памяти
            imagedestroy($source);
            return self::$name;
        }

      /*  static function add_WM($im){
            // Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
            $stamp = imagecreatefrompng('./skins/default/img/logo.png');
            $im = imagecreatefromjpeg('.'.self::$name);

// Установка полей для штампа и получение высоты/ширины штампа
            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

// Копирование изображения штампа на фотографию с помощью смещения края
// и ширины фотографии для расчета позиционирования штампа.
            imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Вывод и освобождение памяти
            header('Content-type: image/png');
            imagepng($im);
            imagedestroy($im);

        }*/
    }