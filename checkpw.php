<html>
<head>
</head>
<body>
<?php
if (isset($_GET['username']) !== True){
	$errormsg = "'username' variable is missing. Unable to perform password check.";
	header("Location: apierr.php?emg=" . bin2hex($errormsg)."&es=".bin2hex(basename(__FILE__)));
	die();
}
if (isset($_GET['pw']) !== True){
	$errormsg = "'pw' variable is missing. Unable to perform password check.";
	header("Location: apierr.php?emg=" . bin2hex($errormsg)."&es=".bin2hex(basename(__FILE__)));
	die();
}

$db = "auths.db";
if ($_GET["username"] == "" || $_GET["pw"]==""){
	echo "1.False";
	return False;
}
if(strpos(file_get_contents($db),strtolower($_GET["username"])) !== false) {
        $search      = strtolower($_GET["username"]);
		$line_number = false;
		if ($handle = fopen($db, "r")) {
			$count = 0;
		while (($line = fgets($handle, 4096)) !== FALSE and !$line_number) {
			$count++;
			$line_number = (strpos($line, $search) !== FALSE) ? $count : $line_number;
		}
		fclose($handle);
		$lines = file($db);
		//echo $lines[$line_number - 1];  //Database login data , username:pw_in_md5:last_login_ip
		$dbline = $lines[$line_number - 1];
		$dbcontent = explode(":",$dbline);
		$options = ['cost' => 12,];
		$hasedmd5pw = $dbcontent[1];
		$encodedpw =  bin2hex(hash("sha256",strtolower($hasedmd5pw)));
		$llip = $dbcontent[2];
		}else{
			echo "DataBase Error";
			return Null;
		}
		if ($_GET["pw"] == $encodedpw){
			echo "True";
		}else{
			echo '2.False';
			//echo $encodedpw;
			echo strtolower($hasedmd5pw);
			return False;
		}

    } else{
		echo '3.False';
		return False;
	}
?>
</body>
</html>