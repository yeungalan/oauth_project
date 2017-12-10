<!DOCTYPE html>
<?php
include "config.php";

  session_start();
	if(isset($_SESSION["current"])!==True || $_SESSION["current"] !== 2){
		header("Refresh: 0; url=error.php?from=2FA.php&error=Forbidden Skipping");
	die();
	}else{
		$_SESSION["current"] = 3;
	}
	
	$_SESSION["acceptauth"] = true;
?>
<html>
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="5318022020-80fbc5pcgvf52gq2el63b33tolcitkop.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
 
<style>
#outer
{
    width:100%;
    text-align: center;
}
.inner
{
    display: inline-block;
}
</style>
  </head>
  <body>
  <div class="ts container">
<br><br><br>

<div id="select">
<center>
<p><?php echo $lang['fa_authmethod']; ?></p>
</center>
<table>
<tr>
<td><img class="ts fluid image" id="tgimg" src="./img/tg.png"></td>
<td><img  class="ts fluid image" id="gauthimg" src="./img/g_auth.png"></td>
</tr>
</table>
 </div>
 
 
<div id="tg">
<center>
<?php echo $lang['fa_tg']; ?>
<br>
<div class="ts active inline massive loader"></div>
<br>
<?php echo $lang['fa_waitconfirm']; ?>
<br>
<?php echo $lang['fa_redirwait']; ?>
</center>
</div>


<div class="alert alert-dismissible alert-danger" id="gauth_f">
  <strong><?php echo $lang['fa_err']; ?></strong><?php ' '.$lang['fa_invaildcode']?>
</div>

<div id="gauth">
<center>
<?php echo $lang['fa_gauth']; ?>
<br>
<p><?php echo $lang['fa_gauth6']; ?></p>
<p><?php echo $lang['fa_gauth30']; ?></p>
<div class="form-group">
  <label class="control-label" for="inputLarge"><?php echo $lang['fa_code']; ?></label>
  <input class="form-control input-lg" type="text" id="gauthcode">
</div>

</center>
</div>





<div id="success">
<center>
<?php echo $lang["fa_title"]; ?>
<br>
<br>
<br>
<?php echo $lang["fa_complete"]; ?>
<br>
<?php echo $lang["fa_red"]; ?>
</center>
</div>

<div id="fail">
<center>
<?php echo $lang["fa_title"]; ?>
<br>
<br>
<br>
<?php echo $lang["fa_fail"]; ?>
<br>
<?php echo $lang["fa_retry"]; ?>
</center>
</div>


   </div>
   <?php
   $str = file_get_contents($user_json_name);
$user = json_decode($str, true);
  if(isset($user[hex2bin($_GET["id"])])==false){
	  header('Location: newuser.php?id='.$_GET["id"]."&url=".hex2bin($_GET["url"]));
  }
   ?>
   <script type='text/javascript'>
<!--AJAX  -->
$(document).ready(function(){
	 $("#tg").hide();
	  $("#success").hide();
	  $("#fail").hide();
	  $("#gauth").hide();
	  $("#gauth_f").hide();
});


	   	$("#gauthimg").click(function(){
		 $("#gauth").show(); 
		 $("#select").hide();
	   });
   
   
	$("#tgimg").click(function(){
		 $("#tg").show(); 
		 $("#select").hide();
		 tg();
	   });
	   
	   $("#gauthcode").keyup(function(event){
    if(event.keyCode == 13){
        g_auth();
    }
});
	   

</script>
<?php $ran = rand(100000, 999999); ?>
        <script>
         var tg=function(){
           
		$.get("https://api.telegram.org/bot".concat("<?php echo $telegram_bot_id; ?>","/sendMessage"),
    {
        chat_id: "<?php echo $user[hex2bin($_GET["id"])]["telegram"]; ?>",
		text: "<?php echo $lang["fa_tg1"].$_SERVER['REMOTE_ADDR'].$lang["fa_tg2"]; ?>",
		reply_markup: '{"keyboard":[["<?php echo $lang["fa_tgcon"]."(".$ran.")"; ?>","<?php echo $lang["fa_tgrej"]."(".$ran.")"; ?>"]],"one_time_keyboard":true}'
    },
    function(data, status){
        console.log(status);
    });
	
	setInterval(function(){ 
	$.get("https://api.telegram.org/bot".concat("<?php echo $telegram_bot_id; ?>","/getUpdates"),
    function(data, status){
		if(JSON.stringify(data).replace("", "").indexOf("<?php echo $lang["fa_tgconunicode"]."(".$ran; ?>)") >= 0){
			$("#tg").hide(); 
			$("#success").show(); 
					
				$.ajax({
  method: "GET",
  url: "authentication.php",
  data: {hash : "<?php echo $_GET["id"]; ?>",auth : "telegram",name : "<?php echo $_GET["name"]; ?>",img : "<?php echo $_GET["img"]; ?>"}			
})
  .done(function( data ) {
    console.log("Finish");
	console.log(data);
	setTimeout(function(){
    	window.location = "redirect.php?url=<?php echo $_GET["url"]; ?>";
}, 1000);

	
  });
  
		}else{
			  console.log("false");
		};
		if(JSON.stringify(data).replace("", "").indexOf("<?php echo $lang["fa_tgregunicode"]."(".$ran; ?>)") >= 0){
			$("#tg").hide(); 
			$("#fail").show(); 
		};
		

		
		
    }); }, 3000);
        };
        </script>
		
		
        <script>
         var g_auth=function(){
           
		$.get("./lib/g_auth.php",
    {
        code: $('#gauthcode').val(),
		user: "<?php echo $_GET["id"]; ?>",
    },
    function(data, status){
        console.log(status);
		console.log(data);
		if(data=="true"){
			$("#gauth").hide(); 
			$("#gauth_f").hide();
			$("#success").show(); 
			
			
	$.ajax({
  method: "GET",
  url: "authentication.php",
  data: {hash : "<?php echo $_GET["id"]; ?>",auth : "g_auth",name : "<?php echo $_GET["name"]; ?>",img : "<?php echo $_GET["img"]; ?>"}			
})
  .done(function( data ) {
    console.log(data);
		setTimeout(function(){
    	window.location = "redirect.php?url=<?php echo $_GET["url"]; ?>";
}, 1000);
  });
  
		}else{
			$("#gauth_f").show();
		}
    });
	

        };
        </script>	
		
  </body>
</html>