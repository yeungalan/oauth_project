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
<link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
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
<p>請選擇您的驗證方法</p>
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
Telegram :
<br>
<div class="ts active inline massive loader"></div>
<br>
等待確認中
<br>
請勿關閉本頁面，系統會在驗證完成後自動重定向。
</center>
</div>


<div class="alert alert-dismissible alert-danger" id="gauth_f">
  <strong>錯誤</strong> 代碼不正確
</div>

<div id="gauth">
<center>
兩步驟驗證(Google Authenticator) :
<br>
<p>請開啟Google Authenticator並輸入所見的六位數字代碼</p>
<p>請注意：相關代碼只於30秒內有效，請儘快輸入</p>
<div class="form-group">
  <label class="control-label" for="inputLarge">六位數字代碼</label>
  <input class="form-control input-lg" type="text" id="gauthcode">
</div>

</center>
</div>





<div id="success">
<center>
二步驟登入驗證
<br>
<br>
<br>
確認完成
<br>
請勿關閉本頁面，系統將會自動重定向。
</center>
</div>

<div id="fail">
<center>
二步驟登入驗證
<br>
<br>
<br>
失敗
<br>
請再試一次
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
		text: "二步驟登入，IP<?php echo $_SERVER['REMOTE_ADDR']; ?>正在登入，如果你確認相關登入是閣下所發出，請按確認，否則請按拒絕",
		reply_markup: '{"keyboard":[["確認(<?php echo $ran; ?>)","拒絕(<?php echo $ran; ?>)"]],"one_time_keyboard":true}'
    },
    function(data, status){
        console.log(status);
    });
	
	setInterval(function(){ 
	$.get("https://api.telegram.org/bot".concat("<?php echo $telegram_bot_id; ?>","/getUpdates"),
    function(data, status){
		if(JSON.stringify(data).replace("", "").indexOf("\u78ba\u8a8d(<?php echo $ran; ?>)") >= 0){
			$("#tg").hide(); 
			$("#success").show(); 
			$.get("authentication.php", {hash : "<?php echo $_GET["id"]; ?>",auth : "telegram",name : "<?php echo $_GET["name"]; ?>",img : "<?php echo $_GET["img"]; ?>"},function( data ) {
			 console.log(data);
			});
			window.location = "redirect.php?url=<?php echo $_GET["url"]; ?>";
		}else{
			  console.log("false");
		};
		if(JSON.stringify(data).replace("", "").indexOf("\u62d2\u7d55(<?php echo $ran; ?>)") >= 0){
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
			$.get("authentication.php", {hash : "<?php echo $_GET["id"]; ?>",auth : "g_auth",name : "<?php echo $_GET["name"]; ?>",img : "<?php echo $_GET["img"]; ?>"},function( data ) {
			 console.log(data);
			});
			window.location = "redirect.php?url=<?php echo $_GET["url"]; ?>";
		}else{
			$("#gauth_f").show();
		}
    });
	

        };
        </script>	
		
  </body>
</html>