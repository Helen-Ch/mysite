<?php
class DB{

    static public $mysqli = array();
    static public $connect = array();

    static public function _($key = 0)
    { // єто функция соединения с БД, 0 - чтобы не передавать $link в запросах
        if (!isset(self::$mysqli[$key])) {// если не сущ-т соединение с БД
            if (!isset(self::$connect['server']))
                self::$connect['server'] = Core::$DB_HOST;
            if (!isset(self::$connect['user']))
                self::$connect['user'] = Core::$DB_LOGIN;
            if (!isset(self::$connect['pass']))
                self::$connect['pass'] = Core::$DB_PASS;
            if (!isset(self::$connect['db']))
                self::$connect['db'] = Core::$DB_NAME;

            self::$mysqli[$key] = @new mysqli(self::$connect['server'], self::$connect['user'], self::$connect['pass'], self::$connect['db']);// @, чтобы поглотить WARNING в случае ошибки при подключении к БД и не выводить сообщение пользователям

            if(mysqli_connect_errno()){
                echo 'Не удалось подключиться к Базе Данных!';
                exit;
            }

            //printf("Текущий набор символов: %s\n", self::$mysqli[$key]->character_set_name());
            if(!self::$mysqli[$key]->set_charset("utf8")){
                echo'Ошибка при загрузке набора символов utf-8:'.self::$mysqli[$key]->error;
               // exit;
            }
        }
        return self::$mysqli[$key];
    }

    static public function close($key = 0)
    {// закрытие соединения с БД
        self::$mysqli[$key]->close();
        unset(self::$mysqli[$key]);
    }
}


//DB::_()->query(); одновременное создание соединения с БД и запроса вместо DB::_(); -соединение DB::$mysqli[]->query(); - запрос, т. е. соединение с БД создается только при первом запросе!