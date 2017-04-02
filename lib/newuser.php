<?php
$jsonstr = file_get_contents('./user.json');
$json = json_decode($jsonstr, true);

if(isset($json[hex2bin($_GET["id"])])==false){
	die("Base On Your Information,You Are Registered Our System Already.");
}

$arr = array_merge($json,array(hex2bin($_GET["id"]) => array('id' => uniqid(),'google_secret' => $_GET["google"],'telegram'=> $_GET["telegram"])));
echo json_encode($arr);

?>
