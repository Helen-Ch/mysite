<?php
error_reporting(-1);
ini_set('display_errors','On');
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('Europe/Kiev');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <link href="/style/style.css" rel="stylesheet">
    <script>
        $("window").load(function() {
            $("body").removeAttr("class");
        });
    </script>
</head>
<body class="preload">
<header></header>
<main>
    <div>
    <h4>Sign up!</h4>
    <form  action="" method="post" name="reg_form">
        <p>логин*</p>
        <input type="text" required name="name" autocomplete="on" placeholder="Your login" autofocus="autofocus"><br>
        <p>пароль*</p>
        <input type="password" required name="pass" placeholder="Password"><br>
        <p>e-mail*</p>
        <input type="email" required name="email" placeholder="E-mail"><br>
        <p>номер телефона в формате ххх-ххх-хх-хх</p>
        <input type="tel"  name="tel" placeholder="Phone" pattern="[\d]{3}-[\d]{3}-[\d]{2}-[\d]{2}"><br>
        <p>адрес сайта в формате http(s)://yoursiteaddress.com</p>
        <input type="url"  name="url" placeholder="Site" pattern="(http|https)://\w+(\.\w+){1,2}"><br>
        <input type="submit" name="reg" value="Sign Up!" class="btn">
    </form>
    </div>
</main>
<footer></footer>
</body>
</html>