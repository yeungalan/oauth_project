<?php
include "config.php";
?>
<?php
session_start();
$jsonstr = file_get_contents($user_json_name);
$json = json_decode($jsonstr, true);
$_SESSION["login"]=($_GET["hash"]);
$str = hex2bin($_GET["hash"]);
$str = split(':', $str);
$_SESSION["userid"]=$str[0];
$_SESSION["authentication"]=$str[1];
$_SESSION["logintime"]=strtotime("now");
$_SESSION["id"]=$json[hex2bin($_GET["hash"])]['id'];
$_SESSION["twofamethod"]=$_GET["auth"];

$_SESSION["name"]=hex2bin($_GET["name"]);
$_SESSION["img"]=hex2bin($_GET["img"]);
?>