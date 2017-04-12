<?php
include '../config.php';
$jsonstr = file_get_contents('../'.$user_json_name);
$json = json_decode($jsonstr, true);

if(isset($json[hex2bin($_GET["id"])])==true){
	die("Base On Your Information,You Are Registered Our System Already.");
}

$arr = array_merge($json,array(hex2bin($_GET["id"]) => array('id' => uniqid(),'google_secret' => $_GET["google"],'telegram'=> $_GET["telegram"])));
echo json_encode($arr);

file_put_contents('../'.$user_json_name,"");
file_put_contents('../'.$user_json_name,json_encode($arr));
?>
