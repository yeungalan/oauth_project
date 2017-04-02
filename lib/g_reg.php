<?php
//call api
require_once 'g_auth_lib.php';

$ga = new PHPGangsta_GoogleAuthenticator();

//verfiy code
$checkResult = $ga->verifyCode($_GET["user"], $_GET["code"], 2);    // 2 = 2*30sec clock tolerance
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