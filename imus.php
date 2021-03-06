﻿<!DOCTYPE html>
<html>
<head>
<?php
include "config.php";
?>
<title>Login Checking System</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>

</head>
<body>
  <div class="container">
  <br>
  
<?php
//start session
session_start();

//if login AJAX was executed , run from here
if(isset($_GET["chk"])){
$ch = curl_init();
$source = 'http://123.203.74.34:8080/imus/api/checkpw.php?username='.$_GET["username"].'&pw='.bin2hex(hash("sha256",hash("sha512",md5(strtolower($_GET["pw"])))));
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch);
$destination = "imus.html";
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);
$result =  str_replace("extloginhandler.php","http://imuslab.com/imus/api/extloginhandler.php",file_get_contents("imus.html"));
echo $result;
//set session id
if (strpos($result, 'True') == true) {
$_SESSION["login"] = hash("sha512",md5($_GET["username"]));
}else{ 
session_destroy();
}
//delete cache
unlink("imus.html");
die();

}else{
//if not , show pages
if (isset($_GET["url"])){
    $_SESSION["url"]=$_GET["url"];
	header("Refresh: 0; url=imus.php?#");
	die();
    }

		if(isset($_SESSION["current"])!==True || $_SESSION["current"] !== 1){
		header("Refresh: 0; url=error.php?from=imus.php&error=Forbidden Skipping");
	die();
	}else{
		$_SESSION["current"] = 2;
	}
?>

<!--Error -->
<div class="alert alert-dismissible alert-danger" id="pwerr">
<strong><?php echo $lang['imus_err']; ?></strong><?php echo "  ".$lang['imus_errd']; ?>
</div>

<!--Success -->
<div class="alert alert-dismissible alert-success" id="pwok">
<strong><?php echo $lang['imus_ok']; ?></strong><?php echo "  ".$lang['imus_okd']; ?>
</div>

 <br>
 
 
<form id="login" class="form-horizontal" action="#" method="GET">
  <fieldset>
    <legend><?php echo $lang['imus_title']; ?></legend>
    <div class="form-group">
      <label for="username" class="col-lg-2 control-label"><?php echo $lang['imus_username']; ?></label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="username" placeholder="<?php echo $lang['imus_username']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label"><?php echo $lang['imus_pwd']; ?></label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password" placeholder="<?php echo $lang['imus_pwd']; ?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default"><?php echo $lang['imus_reset']; ?></button>
        <button class="btn btn-primary" id="submit"><?php echo $lang['imus_submit']; ?></button>
      </div>
    </div>

  </fieldset>
</form>

</div>
<script type='text/javascript'>
var userid = "";
<!--Set Alert Disable on Default -->
$(document).ready(function(){
	 $("#pwerr").hide();
		$("#pwok").hide();
});

<!--AJAX post Data to imus -->
	$("#submit").click(function(){
		$("#pwerr").hide();
		$("#pwok").hide();
		$("#session").hide();
        $.get("#", { username: $('#username').val(), pw: $('#password').val() ,url : getParameterByName('url') , chk : "true" }, function(data, status){
			<!--if return true-->
			if (data.replace("<body>", "").replace("<head>", "").replace("</head>", "").replace("</body>", "").replace("<html>", "").replace("</html>", "").replace(/^\s*[\r\n]/gm, "").indexOf("True") >= 0) 
			{ $("#pwok").show(1000);setTimeout(function(){
				<!--set speftic link to main page -->
				userid = $('#username').val();
				authentication();
				
					window.location.replace("2FA.php?url=".concat('<?php echo $_SESSION["url"]; ?>',"&id=","imus:".concat(userid).hexEncode(),"&name=",userid.hexEncode(),"&img=","https://".concat(window.location.host,"/img/imus.jpg").hexEncode()));
				
				}, 2000);}
				<!--else action -->
			else {  $("#pwerr").show(1000); }
	   });
    });
	
			String.prototype.hexEncode = function(){
    var hex, i;

    var result = "";
    for (i=0; i<this.length; i++) {
        hex = this.charCodeAt(i).toString(16);
        result += (""+hex).slice(-4);
    }

    return result
}
</script>
        <script>
         var authentication=function(){
           
		$.get("authentication.php",
    {
        userid: userid,
		authentication: "imus"
    },
    function(data, status){
        console.log(status);
    });
            
        }
        </script>
<Script>
function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>
</body>
</html>
<?php } ?>