<?php
session_start();
if($_SESSION["login"]==bin2hex($_SESSION["userid"].":".$_SESSION["authentication"])){
	if(hex2bin($_GET["url"])=="api/ok.html"){
		$_SESSION["api"]="true";
	}else{
		$_SESSION["api"]="false";
	}
	header("Refresh: 0; url=".hex2bin($_GET["url"])."?userid=".$_SESSION["authentication"]."&method=".$_SESSION["userid"]."&id=".$_SESSION["id"]."&img=".$_SESSION["img"]."&displayname=".$_SESSION["name"]."&twofamethod=".$_SESSION["twofamethod"]);
	$_SESSION["login"]="invaild";
	die();
}else{
	header("Refresh: 0; url=error.php?from=redirect.php&error=Forbidden Access");
};

?>