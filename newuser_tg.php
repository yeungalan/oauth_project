<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";
?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
 
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
<div class="ts massive steps">
    <div class="step">
        <div class="content">
            <div class="title">Google</div>
            <div class="description">輸入你的Google Authenctor驗證</div>
        </div>
    </div>
    <div class="active step">
       　 <i class="info icon"></i>
        <div class="content">
            <div class="title">Telegram</div>
            <div class="description">輸入你的Telegram驗證代碼</div>
        </div>
    </div>
    <div class="disabled step">
        <i class="info icon"></i>
        <div class="content">
            <div class="title">確認</div>
        </div>
    </div>
</div>
<div class="ts inverted primary segment">
    <p>新用戶</p>
</div>
<table>
<td>
<?php $ran = rand(100000, 999999); ?>
<?php
$json = file_get_contents('https://api.telegram.org/bot'.$telegram_bot_id.'/getMe');
$obj = json_decode($json);
?>
<a href="https://telegram.me/<?php echo $obj->{"result"}->{"username"}; ?>">啟動@<?php echo $obj->{"result"}->{"first_name"}; ?></a>
<p>之後請在聊天框中輸入 : <input class="form-control input" type="text" value="/start <?php echo $ran; ?>"></p>
<p>系統會自動偵測閣下的身份，在完成後你將會重定向到完成畫面</p>
<a href="newuser_final.php?data=<?php echo $_GET["data"]?>&id=<?php echo $_GET["id"]?>&url=<?php echo $_GET["url"]?>">如果你沒有Telegram，請按此略過</a>
</td>

</table>
</div>	

        <script>
         var tg=function(){
	setInterval(function(){ 
	$.get("/lib/tg_reg.php?text=/start <?php echo $ran; ?>",
    function(data, status){
		if(data != ""){
			window.location = "newuser_final.php?url=<?php echo $_GET["url"]; ?>&data=<?php echo $_GET["data"]?>&id=<?php echo $_GET["id"]?>&tg=".concat(data);
		}else{
			  console.log("false");
		};	
    }); }, 1500);
        };
		
		window.onload = tg;
        </script>
  </body>
</html>