<?php
//error_reporting(E_ALL);
//header('Content-Type: text/html; charset=utf-8');

/**
 *	Задачник. После каждого $array мы ОБЯЗАНЫ написать прям тут нужный нам код. Прогнать массив $array через foreach и обработать по заданию из $q.
 *	$q - массивы, то есть могут содержать несколько заданий, каждый из которых будет работать с имеющимся массивом
 *	Если у нас в задаче замена, но мы производим замену и выводим: $text = preg_replace('что','на что',$text),
 *	Если у нас в задаче поиск, то производим проверку через if-else и выводим: строку 
 *	echo 'В такой-то строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО или НЕ УСПЕШНО (подставить в if-else)';
 *	и если у нас поиск, то дополнительно вывести весь массив $matches, И нужную найденную строку, если нам надо её получить echo $matches[0][1] <- пример
 *  Задачки подготовил Inpost специально для курсов. Дата: 5 января 2012 года
 *	skype: imbalance_hero , пишите :)
 */

/**
 *	Подсказки:
 *	^ - начало строки, если указали, то проверка идёт от начала!
 *	$ - конец строки
 *	\s - пробел
 *	\t - табуляция
 *	* - {0,}
 *	+ - {1,}
 *	. - любой символ!
 *	Модификаторы:
 *	u - работаем в кодировке UTF-8
 *	i - регистронезависимый текст
 *	U - отмена жадного поиска
 *	Общие данные:
 *	[] - область допустимых символов в КОНКРЕТНОМ символе. [a-z]{3} <- 3 символа любых из a-z, вплоть даже до 3-х повторяющихся
 *	{} - количество символов, если не стоит, значит 1 символ! Если записано одно число, то РОВНОЕ значение, если 2, то min,max
 *	() - логические скобки И/ИЛИ карман, куда попадают данные
 */

                echo '<div style="width: 70%;margin: 100px auto; font-size: 16px;"><p style="text-align: center; font-size:24px;">1-е задание</p>';
$array = array(
    'Ваш логин: Inpost. Добро пожаловать',
    'Ваш логин: Николай. Добро пожаловать',
    'Ваш логин: Анна Семинович. Добро пожаловать',
    'Ваш логин: Борис_Бурда-2. Добро пожаловать',
    'Ваш логин: ??????. Добро пожаловать',
);

$q = 'Поиском достать логин. 
      Особенности: логин стоит после двухиточия, может представлять из себя рус и англ символы, пробелы, тире и подчеркивание. 
	  Для для того, чтобы достать чистый логин, воспользуемся карманом (скобками)';


foreach ($array as $k => $v) {
    if( preg_match('#\:\s([\w-\d\s]+)#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>'.$matches[1].'<hr><br>';
       // echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else {
           echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}

                echo '<p style="text-align: center; font-size:24px;">2-е задание</p>';
$array = array(

    'main',
    'READ',
    'news%&!#/<"&\\/files',
	'../../index',
	'news',
	'kill_crash-and-destroy',
	'loveYou',
    '2',
    '../index',
    '.gffddsss',
    'kjkj.nb'
);

$q = 'Проверить допустимые имена файлов
      Важно заметить, что мы в юникс-системе будем использовать как большие, так и маленькие символы.
	  Необходимо недопустить попадания ТОЛЬКО запрещенных файловой системой имён, а так же попытки перейти между каталогами';

foreach ($array as $k => $v) {
    if( preg_match('#["\\\/:\*\?<>\|\+\#%&!]|\.{2}/|^\.#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - есть недопустимые имена файлов:<br>'.$matches[0].'<hr><br>';
      //  echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}

                  echo '<p style="text-align: center; font-size:24px;">3-е задание</p>'; // исправила 26.12.2016

$array = array(
	'file.jpg',
	'zzz.png',
	'afafaf.php',
	'quad.jpg.',
	'quad2.JPG',
	'quad3.jpg.vir',
	'gif.doc',
	'file.virus',
    'f\ile.png',
    'unix.JPEG',
    'file.jjj',
    'filejpg',
    'file.ajpg'
);

$q = 'Загрузка фотографий. Необходимо допустить ТОЛЬКО: jpg,png,gif расширения
	  Важной особенностью будет то, что поиск лучше осуществлять с конца строки $ .
	  Интересный момент, что можно попасться на ошибку Попова :)';

foreach ($array as $k => $v) {
    if( preg_match('#\.(png|gif|jpe?g)$#ui',$array[$k],$matches)){// вместо $ работает \z
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>'.$matches[1].'<hr><br>';
       //echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}

                       echo '<p style="text-align: center; font-size:24px;">4-е задание</p>';

$array = array(
	'Длинная строка. Главное, что мы научимся с ней идеально работать.  HOW do you do? Вот так и живём.Классно!',
);

$q = array(
	'Одна строка, заданий много:',
	'Получить все слова. Самая простая регулярка, поиск по всей строке, указать надо лишь допустимые символы и количество',
	'Получить все английские слова.',
	'Получить слова, которые стоят после точки. Обращаю внимание, что пробел после точки может БЫТЬ и даже не один, а может и не быть, символ пробела: \s',
	'Необходимо получить 5 символ от начала строки. Начало строки: ^ , и не забудем использовать кармашек, чтобы туда ушел нужный нам символ',
	'Получить все слова, в которых первым символ будет начинаться с большой буквы. Подсказка, необходимо использовать 2 квадратных скобки!',
);

foreach ($array as $k => $v) {
    if(preg_match('#.+#ui', $array[$k], $matches)) {
        echo $matches[0].'<hr><br>';
    }
}

foreach ($array as $k => $v) {
    if(preg_match_all('#[a-z]+#ui', $array[$k], $matches)) {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>Английские слова:<br>';
       // echo '<pre>'.print_r($matches,1).'<hr><br>';
       foreach ($matches as $i){
            foreach($i as $d){
                echo $d.'<br>';
            }
        }
    }
    echo '<hr><br>';
}

foreach ($array as $k => $v) {
    if(preg_match_all('#\.\s*(\w+)#ui', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО<br>'.$matches[1][0].'<br>'.$matches[1][1].'<br>'.$matches[1][2].'<br>';
    }
        echo '<hr><br>';
}

foreach ($array as $k => $v) {
    if(preg_match('#^.{4}(.)#ui', $array[$k], $matches)) {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>Пятый символ от начала строки: '.$matches[1].'<hr><br>';
    }
}

foreach ($array as $k => $v) {
    if(preg_match_all('#[А-ЯA-Z]\w+#u', $array[$k], $matches)) {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>';
        foreach ($matches as $i){
            foreach($i as $d){
                echo $d.'<br>';
            }
        }
        echo '<hr><br>';
    }
}

                           echo '<p style="text-align: center; font-size:24px;">5-е задание</p>';
$array = array(
	' ,1.1, 10 , 22, 2.1, 2.5, 10.10, 500.1, 77, 10.11.12.13, 55.55',
);

$q = array(
	'Достать ВСЕ дробные числа. Дробные - это числа, разделенные точкой',
);


foreach ($array as $k => $v) {
    if(preg_match_all('#(^|\s|,)(\d+\.\d+)(\s|,|$)#u', $array[$k], $matches)) {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО<br>Дробные числа: '.$matches[2][0].' '.$matches[2][1].' '.$matches[2][2].' '.$matches[2][3].' '.$matches[2][4].'<hr><br>';
    }
}
//echo '<pre>'.print_r($matches,1).'<hr><br>';



                         echo '<p style="text-align: center; font-size:24px;">6-е задание</p>';

$array = array(
	'site.ru',
	'barakuda',
	'zimbabwe_ru',
	'zimbabwe',
	'zzz-zimbabwe',
	'http://site.ru',
	'www.site.com',
	'www.zimbabwe.com',
	'zimbabwe.com.ua',
	'http://zimbabwe.ru',
);

$q = array(
	'Получить ссылки на реальные сайты (обязательно доменное имя), где имя сайта zimbabwe',
	'Немного сложная работа со строкой. Осуществить проверку каждого слова на присутствие в начале http://, и там, где его нет - дописать.
	 Для этих целей используем обход цикла foreach, и проверку preg_match. Не забываем про экранизацию при помощи preg_quote',
	'Похожее задание, но для сайтов, где не указано доменное имя - дописать .ru, это продолжение предыдущего задания, делается так же само, в одном цикле, просто 2 отдельных условия!',
);

/*echo '<a href="site.ru">site.ru</a><br>
	<a href="barakuda">barakuda</a><br>
	<a href="zimbabwe_ru">zimbabwe_ru</a><br>
	<a href="zimbabwe">zimbabwe</a><br>
	<a href="zzz-zimbabwe">zzz-zimbabwe</a><br>
	<a href="http://site.ru">http://site.ru</a><br>
	<a href="www.site.com">www.site.com</a><br>
	<a href="www.zimbabwe.com">www.zimbabwe.com</a><br>
	<a href="zimbabwe.com.ua">zimbabwe.com.ua</a><br>
	<a href="http://zimbabwe.ru">http://zimbabwe.ru</a><br>';*/


foreach ($array as $k => $v) {
    if( preg_match('#^http://zimbabwe(\.\w+){1,2}$#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - '.$matches[0].'<hr><br>';
    }
}
echo'<hr>';

foreach ($array as $k => $v) {
    if( preg_match('#^http://#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - замена не нужна  '.$matches[0].'<hr><br>';
    } else {
        $array[$k] = 'http://'.$array[$k];
        echo 'В строке произошла замена на:<br>'.$array[$k].'<hr><br>';
    }
}
unset($array[$k]);
echo'<hr>';

foreach ($array as $k => $v) {
    if ( preg_match('#\.ua|\.ru#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - замена не нужна<hr><br>';
    } else {
        $array[$k] .= '.ru';
        echo 'В строке произошла замена на:<br>' . $array[$k] . '<hr><br>';
    }
}
// with preg_replace();
/*foreach ($array as $k => $v) {
   if ( preg_match('#^[^preg_quote(http://)]#ui',$array[$k],$matches)){
       $text = preg_replace('#^#ui','http://',$array[$k]);
       if ( preg_match('#\.ua|\.ru#ui',$text,$matches)){
           // echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - замена не нужна<hr><br>';   !!!    не могу сделать через отрицание  !!!!
       } else {
           $text = preg_replace('#$#ui','.ru',$text);
       }
       echo 'В строке: '.htmlspecialchars($array[$k]).' произошла замена на:<br>'.$text.'<hr><br>';
   } else{
        echo 'В строке: '.htmlspecialchars($array[$k]).' замена не нужна!<hr><br>';
   }
}*/


                            echo '<p style="text-align: center; font-size:24px;">7.1</p>';


$array = array(
	'inpost',
	'Barabulka_ru',
	'Zimbabwe.ru',
	'Max',
    'M#x',
    'Mhhjvghfty235x',
    'Mx',
	'Yojik',
	'Иван Тарасов',
	'Ёжик',
	'Борис Николаевич Кощуновский',
	'Ооооооооооооооооооооочень длинное имя',
	'Я',
	'go->drink->die',
	'Don`t sleep',
	'<Пивасик',
	'1',
	'123456789',
	'77777',
	'7ф777я7',
);

$q = array(
	'Теперь идут операции по работе с логинами и паролями. Очень важно именно при РЕГИСТРАЦИИ:',
	'Проверка на preg_match, разрешить только числам. Подсказка: числа точно так же как и буквы, а именно 0-9 (а-я)',
	'Пропустить только строки, состоящие из цифр 7 и символов ф,я',
	'Пропустить только рус и англ символы, подчеркивание и тире, пробел(!) длиной от 4 до 15 символов',
	'Выбрать логин, который начинается на M и заканчивается на x , я говорю про Max',
);


foreach ($array as $k => $v) {
    if( preg_match('#^\d+$#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - '.$matches[0].'<hr><br>';
    } else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}

                                     echo '<p style="text-align: center; font-size:24px;">7.2</p><hr>'; // строки, в котрых есть 7, ф, я

foreach ($array as $k => $v) {
    if (preg_match('#^[7фя]+$#ui', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    }
}

  /*                  // строки, в которых только 7 или 7 и ф, и я
foreach ($array as $k => $v) {
    if (preg_match('#[7]{2,}|[ф7]+[я]#ui', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    } else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}*/
                                        echo '<p style="text-align: center; font-size:24px;">7.3</p><hr>';
foreach ($array as $k => $v) {
    if( preg_match('#^[\w-\s]{4,15}$#ui',$array[$k],$matches)){
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - '.$matches[0].'<hr><br>';
    }else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}

                                        echo '<p style="text-align: center; font-size:24px;">7.4</p><hr>';
foreach ($array as $k => $v) {
    if (preg_match('#^M.*x$#u', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    }
}



                            echo '<p style="text-align: center; font-size:24px;">8-е задание</p>';


$array = array(
	'Я тебя ооооочеень            СИЛЬНО            ЛЮБЛЮ          МОЙ                    ДругБорис! Цёми-Цёми,    Пративный!',
);

$q = array(
	'Вчера писал для себя. Заменить подряд идущие пробелы на один. Чтобы не было их так много. preg_replace',
);


foreach ($array as $k => $v) {
    $text = preg_replace('#\s{2,}#ui',' ',$array[$k]);
    echo '<pre>В строке: '.htmlspecialchars($array[$k]).'<br>произошла замена на:<br>'.$text.'<hr><br></pre>';
}



                            echo '<p style="text-align: center; font-size:24px;">9-е задание</p>';

$array = 	'[b]Заменить подряд [i]идущие[/i] пробелы на один.[/b]';
$in = array(
	'/\[b\](.*?)\[\/b\]/Ums',
	'/\[i\](.*?)\[\/i\]/ms',
	'/\[u\](.*?)\[\/u\]/ms',
	'/\[img\](.*?)\[\/img\]/ms',
	'/\[email\](.*?)\[\/email\]/ms',
	'/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms',
	'/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
	'/\[color\="?(.*?)"?\](.*?)\[\/color\]/ms',
	'/\[quote](.*?)\[\/quote\]/ms',
	'/\[list\=(.*?)\](.*?)\[\/list\]/ms',
	'/\[list\](.*?)\[\/list\]/ms',
	'/\[\*\]\s?(.*?)\n/ms'
);
// And replace them by...
$out = array(
	'<strong>\1</strong>',

	'<em>\1</em>',
	'<u>\1</u>',
	'<img src="\1" alt="\1" />',
	'<a href="mailto:\1">\1</a>',
	'<a href="\1">\2</a>',
	'<span style="font-size:\1%">\2</span>',
	'<span style="color:\1">\2</span>',
	'<blockquote>\1</blockquote>',
	'<ol start="\1">\2</ol>',
	'<ul>\1</ul>',
	'<li>\1</li>'
);
$text = preg_replace($in, $out, $array);
echo '<pre>В строке: ' . htmlspecialchars($array) . '<br>произошла замена на:<br>' . $text . '<hr><br></pre>';
foreach ($in as $k => $v) {
	if (preg_match($in[$k], $array, $matches)) {
		echo 'В строке: ' . htmlspecialchars($array) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
		echo '<pre>' . print_r($matches, 1) . '<hr><br>';
	} else {
		echo 'В строке: ' . htmlspecialchars($array) . ' регулярка прошла НЕ УСПЕШНО<hr><br>';
	}
}


















$array = array(
	'Дата публикации:27 августа 08:43. Был отличный год!',
);

$q = array(
	'Строку мы знаем, меняется лишь день,месяц,время. Необходимо достать:',
	'Время, когда опубликовали',
	'Полностью дату, а именно (27 августа 08:43), она может меняться!',
);

foreach ($array as $k => $v) {
    if (preg_match('#\d+:\d+#ui', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    }
}

foreach ($array as $k => $v) {
    if (preg_match('#\d+[\s\w]+\d+:\d+#ui', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    }
}


                                  echo '<p style="text-align: center; font-size:24px;">10-е задание</p>';

$array = array(
	'<a href="file.php">Это ссылка, и тут было классно</a>',
	'<a    href     =       "file.php"     >Это ссылка, и тут было классно</a>',
	'<a    href=file.php >Это ссылка, и тут было классно</a>',
	"<a    href='file.php' >Это ссылка, и тут было классно</a>",
    '<a href="">###</a>'
);

$q = array(
	'Используем карманы, необходимо получить путь, куда ссылается и текст внутри тега!
	 Стоит обратить внимание на момент, где символ МОЖЕТ БЫТЬ, а может и не БЫТЬ',
);

echo '<a href="file.php">Это ссылка, и тут было классно</a><br>
	<a    href     =       "file.php"     >Это ссылка, и тут было классно</a><br>
	<a    href=file.php >Это ссылка, и тут было классно</a><br>
	"<a    href=\'file.php\' >Это ссылка, и тут было классно</a>"<br>
	<a href="">###</a>';

/*
foreach ($array as $k => $v) {
    if (preg_match('#\<a\s*href\s*=["\'\s>]*(\w+\.\w{3})["\'\s>]*([\w\s,]+)\</a\>#ui', $array[$k], $matches)) {
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).' регулярка прошла УСПЕШНО - '.$matches[1].', '.$matches[0].'</pre><hr>';
       // echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else{
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО</pre><hr>';
    }
}
// my
foreach ($array as $k => $v) {
    if (preg_match('#\<a\s*href\s*=(.*)>(.+)\</a\>#ui', $array[$k], $matches)) {
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).'</pre> регулярка прошла УСПЕШНО - путь: '.$matches[1].', текст: '.$matches[2].'<hr>';
         echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else{
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО</pre><hr>';
    }
}
//Stas
foreach ($array as $k => $v) {
    if (preg_match('#href\s*=\s*("|\')?(.*?)("|\')?\s*>(.+)\</a\>#ui', $array[$k], $matches)) {
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).'</pre> регулярка прошла УСПЕШНО - путь: '.$matches[2].', текст: '.$matches[4].'<hr>';
         echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else{
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО</pre><hr>';
    }
}*/
foreach ($array as $k => $v) {
    if (preg_match('#href\s*=([^\'"\s]*.*[^\'"\s"]*)>(.+)\</a\>#ui', $array[$k], $matches)) {
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).'</pre> регулярка прошла УСПЕШНО - путь: '.$matches[1].', текст: '.$matches[2].'<hr>';
        echo '<pre>'.print_r($matches,1).'<hr><br>';
    } else{
        echo '<pre>В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО</pre><hr>';
    }
}

                              echo '<p style="text-align: center; font-size:24px;">11-е задание</p>';

$array = array(
	'text@',
	'yandex@@mega.com',
	'beer@mail.com',
	"inpost.dp.ua",
	"inpostdpua@gmail.com",
);

$q = array(
	'Проверить на валидность е-мейла. Краткая информация (ВАЖНАЯ!), емеил состоит из набора символов маленьких. 
	 Присутствует в центре собака, слева имя ящика, которое может состоять из обычных символов англ И подчеркивания И тире.
	 Справа находятся домены, отделенные точками.',
);

foreach ($array as $k => $v) {
    if (preg_match('#[\w-]+@\w+\.\w{2,3}#u', $array[$k], $matches)) {
        echo 'В строке: ' . htmlspecialchars($array[$k]) . ' регулярка прошла УСПЕШНО - ' . $matches[0] . '<hr><br>';
    }else {
        echo 'В строке: '.htmlspecialchars($array[$k]).' регулярка прошла НЕ УСПЕШНО<hr><br>';
    }
}
echo '</div>';

//echo '<pre>'.print_r($matches,1).'<hr><br>';