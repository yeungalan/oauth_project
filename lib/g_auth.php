<?php
//call api
include "../config.php";
require_once 'g_auth_lib.php';

$ga = new PHPGangsta_GoogleAuthenticator();

$str = file_get_contents('../'.$user_json_name);
$json = json_decode($str, true);

//verfiy code
$checkResult = $ga->verifyCode($json[hex2bin($_GET["user"])]["google_secret"], $_GET["code"], 2);    // 2 = 2*30sec clock tolerance
//check if GET is null or empty

	//check result
if ($checkResult) {
	//if true
    echo 'true';
} else {
	//if false
    echo 'false';
}



?>