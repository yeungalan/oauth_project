<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";
?>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <div class="title"><?php echo $lang['newuser_google']; ?></div>
            <div class="description"><?php echo $lang['newuser_googledec']; ?></div>
        </div>
    </div>
    <div class="active step">
       　 <i class="info icon"></i>
        <div class="content">
            <div class="title"><?php echo $lang['newuser_telegram']; ?></div>
            <div class="description"><?php echo $lang['newuser_telegramdec']; ?></div>
        </div>
    </div>
    <div class="disabled step">
        <i class="info icon"></i>
        <div class="content">
            <div class="title"><?php echo $lang['newuser_confirm']; ?></div>
        </div>
    </div>
</div>
<div class="ts inverted primary segment">
    <p><?php echo $lang['newuser_newuser']; ?></p>
</div>
<table>
<td>
<?php $ran = rand(100000, 999999); ?>
<?php
$json = file_get_contents('https://api.telegram.org/bot'.$telegram_bot_id.'/getMe');
$obj = json_decode($json);
?>
<a href="https://telegram.me/<?php echo $obj->{"result"}->{"username"}; ?>"><?php echo $lang['newuser_lanuch']; ?>@<?php echo $obj->{"result"}->{"first_name"}; ?></a>
<p><?php echo $lang['newuser_enter']; ?><input class="form-control input" type="text" value="/start <?php echo $ran; ?>"></p>
<p><?php echo $lang['newuser_enterdes']; ?></p>
<a href="newuser_final.php?data=<?php echo $_GET["data"]?>&id=<?php echo $_GET["id"]?>&url=<?php echo $_GET["url"]?>"><?php echo $lang['newuser_skip']; ?></a>
</td>

</table>
</div>	

        <script>
         var tg=function(){
	setInterval(function(){ 
	$.get("./lib/tg_reg.php?text=/start <?php echo $ran; ?>",
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
