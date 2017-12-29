<?php
function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

function q($query, $key = 0){
    $res = DB::_($key)->query($query);
    if ($res === false){
        $info = debug_backtrace();
        // wtf ($info);
        $error = date("Y m d H:i:s")."<br>\n".
            "QUERY: " . $query . "<br>\n" .
            DB::_($key)->error."<br>\n".
            "in file: ".$info[0]['file']." at line ".$info[0]['line'];

        file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
        echo $error;
        exit();
    } else {
        return $res;
    }
}

function es($el, $key = 0){
	return DB::_($key)->real_escape_string($el);
}

function hc($el){
	if(!is_array($el)){
		$el = htmlspecialchars($el);
	} else {
		$el  = array_map('hscAll',$el);
	}
	return $el;
}

/*
function q($query){
    global $link1;
    $res = mysqli_query($link1,$query);
    if ($res === false){
        $info = debug_backtrace();
       // wtf ($info);
        $error = date("Y m d H:i:s")."<br>\n".
                 "QUERY: " . $query . "<br>\n" .
                 mysqli_error($link1)."<br>\n".
                 "in file: ".$info[0]['file']." at line ".$info[0]['line'];
        file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
        echo $error;
        exit();
    } else {
        return $res;
    }
}
*/
function trimAll($el){
    if(!is_array($el)){
        $el = trim($el);
    } else {
        $el  = array_map('trimAll',$el);
    }
    return $el;
}

function mresAll($el, $key = 0){
    return DB::_($key)->real_escape_string($el);
}
/*
function mresAll($el){
    global $link1;
    if(!is_array($el)){
        $el = mysqli_real_escape_string($link1,$el);
    } else {
        $el  = array_map('mresAll',$el);
    }
    return $el;
}
*/
function intAll($el){
    if(!is_array($el)){
        $el = int($el);
    } else {
        $el  = array_map('intAll',$el);
    }
    return $el;
}

function floatAll($el){
    if(!is_array($el)){
        $el = float($el);
    } else {
        $el  = array_map('floatAll',$el);
    }
    return $el;
}

function hscAll($el){
    if(!is_array($el)){
        $el = htmlspecialchars($el);
    } else {
        $el  = array_map('hscAll',$el);
    }
    return $el;
}

function __autoload($class){//автоподключение классов, без include
    include './libs/class_'.$class.'.php';
}

function myHash($var){
    $salt = 'ASD';
    $salt2 = 'LKJ';
    $var = crypt(md5($var.$salt),$salt2);
    return $var;
}

    //2-й способ выхода без переадресации и include
/*function myExit(){
    setcookie('autoauthhash','', time()-3600, '/');
    setcookie('autoauthid','', time()-3600, '/');
    session_unset();
    session_destroy();
    header("Location: /");
    exit();

}*/



define ("EMOTICONS_DIR", "/skins/employment/images/");

function BBCode2Html($text) {
	$text = trim($text);

	// BBCode [code]
	if (!function_exists('escape')) {
		function escape($s) {
			global $text;
			$text = strip_tags($text);
			$code = $s[1];
			$code = htmlspecialchars($code);
			$code = str_replace("[", "&#91;", $code);
			$code = str_replace("]", "&#93;", $code);
			return '<pre><code>'.$code.'</code></pre>';
		}
	}
	$text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ms', "escape", $text);

	// Smileys to find...
	$in = array( 	 ':)',
		':D',
		':o',
		':p',
		':(',
		';)'
	);
	// And replace them by...
	$out = array(	 '<img alt=":)" src="'.EMOTICONS_DIR.'emoticon-happy.png" />',
		'<img alt=":D" src="'.EMOTICONS_DIR.'emoticon-smile.png" />',
		'<img alt=":o" src="'.EMOTICONS_DIR.'emoticon-surprised.png" />',
		'<img alt=":p" src="'.EMOTICONS_DIR.'emoticon-tongue.png" />',
		'<img alt=":(" src="'.EMOTICONS_DIR.'emoticon-unhappy.png" />',
		'<img alt=";)" src="'.EMOTICONS_DIR.'emoticon-wink.png" />'
	);
	$text = str_replace($in, $out, $text);

	// BBCode to find...
	$in = array(
		//'/\[(\/?)(b|i|u|s)\s*\]/',
		'/\[b\](.*?)\[\/b\]/ms',
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
		//"<$1$2>",
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
	$text = preg_replace($in, $out, $text);

	// paragraphs
	$text = str_replace("\r", "", $text);
	$text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
	$text = nl2br($text);

	// clean some tags to remain strict
	if (!function_exists('removeBr')) {
		function removeBr($s) {
			return str_replace("<br />", "", $s[0]);
		}
	}
	$text = preg_replace_callback('/<pre>(.*?)<\/pre>/ms', "removeBr", $text);
	$text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);

	$text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "removeBr", $text);
	$text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);

	return $text;
}