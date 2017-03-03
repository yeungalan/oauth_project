<?php
session_start();
if($_SESSION["login"]==md5($_SESSION["userid"].$_SESSION["authentication"])){
	header("Refresh: 0; url=".$_GET["url"]);
	$_SESSION["login"]="invaild";
	die();
}else{
	header("Refresh: 0; url=error.php?from=redirect.php&error=Forbidden Access".$GET["url"]);
};

?>