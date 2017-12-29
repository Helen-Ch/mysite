<?php
class Pagination
{
    static public $limit = 3;//кол-во записей на странице
    static public $view_limit = 2;//кол-во страниц(ссылок) до и после активной страницы

    static function pages($posts, $page)
    {   $pages = array();
        // Находим общее число страниц
        $total = ceil($posts[0] / self::$limit);
        if($total > 1) {
            if ($page > $total) {
                $page = 1;
            }
            $before_limit = $page - self::$view_limit;
            if ($before_limit < 1) {
                $before_limit = 1;
            }
            $after_limit = $page + self::$view_limit;
            if ($after_limit > $total) {
                $after_limit = $total;
            }
            // Проверяем нужны ли стрелки назад
            if ($page > 1) {
                $pages[] = '<a href="?num=1" class="page">&laquo;</a>&nbsp;<a href="?num=' . ($page - 1) . '" class="page">&lsaquo;</a>&nbsp;';
            }
            for ($j = 1; $j <= $total; $j++) {
                if ($j >= $before_limit && $j <= $after_limit) {
                    if ($j == $page) {
                        $pages[] = '<a href="?num=' . $j . '" class="active_page">' . $j . '</a>&nbsp;';

                    } else {
                        $pages[] = '<a href="?num=' . $j . '" class="page">' . $j . '</a>&nbsp;';
                    }
                }
            }
            // Проверяем нужны ли стрелки вперед
            if ($page < $total) {
                $pages[] = '<a href="?num=' . ($page + 1) . '" class="page">&rsaquo;</a>&nbsp;<a href="?num=' . $total . '" class="page">&raquo;</a>';
            }
        }
        return $pages;
    }
}

   /* class Pagination
    {
        static public $page = '';
        static public $limit = 3;//кол-во записей на странице
        static public $count = '';
        static public $view_limit = 2;//кол-во страниц до и после активной страницы
        static public $table = 'news';
        static public $total = '';
        static public $posts = '';//всего записей в таблице

       static function limit ()
        {
            self::$page =(isset($_GET['num']) ? (int)$_GET['num'] : 1);
            if(self::$page < 1) {
                self::$page = 1;
            }
            self::$count = self::$page*self::$limit-self::$limit;
            return self::$count;
        }

        static function pages()
        {   // Определяем общее число сообщений в базе данных
            $result = q("SELECT * FROM " . self::$table . "");
            self::$posts = $result->num_rows;
            // Находим общее число страниц
            self::$total = ceil(self::$posts / self::$limit);
            if (self::$total > 1) {
                if (self::$page > self::$total) {
                    self::$page = 1;
                }
                $before_limit = self::$page - self::$view_limit;
                if ($before_limit < 1) {
                    $before_limit = 1;
                }
                $after_limit = self::$page + self::$view_limit;
                if ($after_limit > self::$total) {
                    $after_limit = self::$total;
                }
                $pages = array();
                // Проверяем нужны ли стрелки назад
                if (self::$page > 1) {
                    $pages[] ='<a href= ?num=1><< </a><a href=?num=' . (self::$page - 1) . '>< </a>';

                }
                for ($j = 1; $j <= self::$total; $j++) {
                    if ($j >= $before_limit && $j <= $after_limit) {
                        if ($j == self::$page) {
                            $pages[] = '<b style="color:#FF556C;">' . $j . ' </b>&nbsp;';

                        } else {
                            $pages[] = '<a href="?num=' . $j . '">' . $j . '</a>&nbsp;';
                        }
                    }
                }

                // Проверяем нужны ли стрелки вперед
                if (self::$page < self::$total) {
                     $pages[] ='<a href=?num=' . (self::$page + 1) . '> ></a><a href=?num=' . self::$total . '> >></a>';
                }
            }
            return $pages;
        }
    }

*/