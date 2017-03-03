<?php
session_start();
$_SESSION["login"]=md5($_GET["userid"].$_GET["authentication"]);
$_SESSION["userid"]=$_GET["userid"];
$_SESSION["authentication"]=$_GET["authentication"];
?>