<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";

?>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<?php
	session_start();
	
	$client_id = $github_client_id;
$url = $github_client_url;
$client_secret = $github_clint_secret;

			if (isset($_GET["url"])){
    $_SESSION["url"]=$_GET["url"];
    }
	  
	if(isset($_GET["redirect"])!==False){

		header("Refresh: 0; url=https://github.com/login/oauth/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$url."&scope=user:email");
		
			if(isset($_SESSION["current"])!==True || $_SESSION["current"] !== 1){
		header("Refresh: 0; url=error.php?from=github.php&error=Forbidden Skipping");
	die();
	}else{
		$_SESSION["current"] = 2;
	}
	die();
	}
		?>
		
		        <script>
				var userid= "";
         var authentication=function(){
           
		$.get("authentication.php",
    {
        userid: userid,
		authentication: "github"
    },
    function(data, status){
        console.log(status);
    });
            
        }
        </script>
	
<?php

$json = file_get_contents('https://github.com/login/oauth/access_token/?client_id='.$client_id.'&client_secret='.$client_secret.'&code='.$_GET["code"].'&redirect_uri='.$url.'&format=json');

$obj = json_decode($json);

echo '<script>';


if (strpos($json, 'error') !== false) {
    echo 'console.error("Error : '.$obj->{'error'}.'");';
	echo 'console.error("Description : '.$obj->{'error_description'}.'");';
	echo 'console.error("Support URi : '.$obj->{'error_uri'}.'");';
	echo 'console.error("Github Login Detected Error");';
	header("Refresh: 0; url=github.php?redirect=1");
}else{
	echo 'console.log("Access Token : '.$obj->{'access_token'}.'");';
	echo 'console.log("Token Type : '.$obj->{'token_type'}.'");';
	echo 'console.log("Scope : '.$obj->{'scope'}.'");';
	echo 'userid = "'.$obj->{'access_token'}.'";';
	echo 'authentication();';
}

echo '</script>';



$file = "https://api.github.com/user?access_token=".$obj->{'access_token'};
$user = download($file);

function download($url) {
    set_time_limit(0);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, "Awesome-Octocat-App");
    $r = curl_exec($ch);
    curl_close($ch);
    header('Expires: 0'); // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
    header('Cache-Control: private', false);
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . strlen($r)); // provide file size
    header('Connection: close');
	header('User-Agent: Awesome-Octocat-App');
    return $r;
}
$user_obj = json_decode($user);

$email = json_decode(download("https://api.github.com/user/emails?access_token=".$obj->{'access_token'}), TRUE);

echo '<script>';

echo 'console.log("username : '.$user_obj->{'login'}.'");';
echo 'console.log("id : '.$user_obj->{'id'}.'");';
echo 'console.log("profile image : '.$user_obj->{'avatar_url'}.'");';
echo 'console.log("type : '.$user_obj->{'type'}.'");';
echo 'console.log("name : '.$user_obj->{'name'}.'");';
echo 'console.log("blog : '.$user_obj->{'blog'}.'");';
echo 'console.log("email : '.$email[0]['email'].'");';
echo '</script>';

//過時
//this part is use to find the user.json information
//$str = file_get_contents('user.json');
//$user = json_decode($str, true);
//echo '<script>console.log("Wellknown as user : '.$user[$email[0]['email']]['name'].'");</script>';
?>

  </head>
  <body>
  <div class="ts container">
  
  <br>
   <br>
   
   <div class="ts left aligned slate" id="info">
   <table>
   <tr>
   <td rowspan="2"><span class="description"><div id="gimg"><?php echo '<img src="'.$user_obj->{'avatar_url'}.'" width="96" height="96"></img>'; ?></div></span></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="header"><div id="gname"><?php echo $user_obj->{'name'}; ?></div></span></td>
	</tr>
	<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="description"><div id="gemail"><?php echo  $email[0]['email']; ?></div></span></td>
	</tr>
	</table>
	
	<br>
	<div style="display:inline-block; vertical-align: middle;">
	<button id="logout" class="ts negative basic button" onclick="history.go(-1);" ><?php echo $lang['auth_logout']; ?></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="ts basic button" href="2FA.php?url=<?php echo $_SESSION["url"]."&id=".bin2hex("github:".$email[0]['email']); ?>&authentication=github&name=<?php echo bin2hex($user_obj->{'name'}); ?>&img=<?php echo bin2hex($user_obj->{'avatar_url'}); ?>" id="ok"><?php echo $lang['auth_ok']; ?></a>
	</div>

	</div>

  


</div>
  </body>
</html>
