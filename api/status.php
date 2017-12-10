<?php

// Cross-Origin Resource Sharing Header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
session_start();
if($_SESSION["api"]=="true"){
$data[] = array('method'=>$_SESSION["userid"], 'name'=>$_SESSION["authentication"],'timestamp'=>$_SESSION["logintime"],'id'=>$_SESSION["id"],'img'=>$_SESSION["img"],'displayname'=>$_SESSION["name"],'two_factor_method'=>$_SESSION["twofamethod"]);
}else{
	$data[] = array('error'=>403, 'name'=>'Incorrect API Usage', 'value'=>'You using wrong function calling or nothing returned');
	}

$json = json_encode($data);
echo $json;

?>