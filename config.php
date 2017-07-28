<?php
$user_json_name = "1nbfa.json"; //使用者儲存位置
$github_client_id = "0982c21b9c3db83c40b9"; //Github OAuth Api Key
$github_clint_secret = "e618aee8256aa36feba9aa02e71777f25ebb3eb9"; //Github OAuth Api Keys
$github_client_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/github.php";
$google_api_url = "5318022020-80fbc5pcgvf52gq2el63b33tolcitkop.apps.googleusercontent.com"; //Google OAuth Api Key
$telegram_bot_id = "300531451:AAHNEgy9O0tZ2z5kKkIJt8TOGLDfzPN16Wk"; //Telegram Bot ID (Format : xxxxxxx:xxxxxxxxxxxxxx)

$announcement = "Hello World!";
$announcementgrade = "info"; //success , info , warning , danger or keep "" for not displaying

$requireauthenction = "false"; //false = allow all internet user use this services , true = require key for using this system
$authenctionkey = "" //authenction password
?>
