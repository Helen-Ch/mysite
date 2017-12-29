<?php
    class Mail{
        static $subject = 'По умолчанию';
        static $from    = 'admin@katrin.school-php.com';//'lena_fatyanova@delicatos.esy.es';правильный отправитель, когда после @ указывается домен сайта,с которого отправляется письмо
        static $to      = 'l.fatyan@gmail.com';
        static $text    = 'Шаблонное письмо';
        static $headers = '';

        static function send(){
            //правильная кодировка:
            self::$subject = '=?utf-8?b?'.base64_encode(self::$subject) .'?=';
            self::$headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
            self::$headers .= "From: ".self::$from."\r\n";
            self::$headers .= "MIME-Version: 1.0\r\n";
            self::$headers .= "Date: ".date('D ,d M Y h:i:s O') ."\r\n";
            self::$headers .= "Precedence: bulk \r\n";//это не единичное письмо, а рассылка

            return(mail(self::$to, self::$subject, self::$text, self::$headers));
        }

        static function testSend(){
            if(mail(self::$to,'English words','English words')){
                echo 'Письмо отправилось!';
            }else{
                echo 'Письмо не отправилось!';
            }
            exit();
        }//Проверить отправку писем на gmail.com в папке спам

    }


    //отправка конкретному человеку
/*Mail::$to = 'vasya@mail.ru';
Mail::$subject = 'Вы успешно зарегистрировались!';
Mail::$text = 'наш текст';
Mail::send();*/

/*class Test
{
    public $x = 1;
    static $y = 2;
}
$t1 = new Test;
$t2 = new Test(2);
$t1->x = 3;
$t2->x2 = 3;
$t2->z = 5;
echo ($t1->x + $t2->x).'<br>';//выведет 4
Test::$y = 5;
echo ($t1->x + Test::$y); //віведет 8
//$t2->y = 5; //Strict Standards: Accessing static property Test::$y as non static in N:\home\html.loc\www\modules\goods\main.php on line 48 нельзя переназначитю статик как паблик
//echo ($t1->x + $t2->y); //Strict Standards: Accessing static property Test::$y as non static in N:\home\html.loc\www\modules\goods\main.php on line 49
/*Notice: Undefined property: Test::$y in N:\home\html.loc\www\modules\goods\main.php on line 49
[Денвер: показать возможную причину ошибки]3 нельзя вывести статик как паблик, выведет только 3


var_dump($t2);

exit();*/