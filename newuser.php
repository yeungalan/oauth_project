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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
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
    <div class="active step">
        <div class="content">
            <div class="title"><?php echo $lang['newuser_google']; ?></div>
            <div class="description"><?php echo $lang['newuser_googledec']; ?></div>
        </div>
    </div>
    <div class="step">
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
<?php
require_once './lib/g_auth_lib.php';
$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();
//print serect
echo "<p>Secret is: ".$secret."\r\n<p>";
//print QR-Code
$qrCodeUrl = $ga->getQRCodeGoogleUrl('OTP', $secret);
echo '<p>Secret QR-Code <p><img src="'.$qrCodeUrl.'">';
?>
</td>
<td>
<div class="form-group">
  <label class="control-label" for="inputLarge"><?php echo $lang['newuser_6code']; ?></label>
  <input class="form-control input-lg" type="text" id="gauthcode">
</div>
</td>
</table>
</div>	

<script>
	   $("#gauthcode").keyup(function(event){
    if(event.keyCode == 13){
        g_auth();
    }
});
	</script>
	        <script>
         var g_auth=function(){
           
		$.get("./lib/g_reg.php",
    {
        code: $('#gauthcode').val(),
		user: "<?php echo $secret; ?>",
    },
    function(data, status){
        console.log(status);
		console.log(data);
		if(data=="true"){
			alert("<?php echo $lang['newuser_keepcode']; ?>");
			window.location.replace("newuser_tg.php?data=<?php echo $secret;?>&id=<?php echo $_GET["id"]?>&url=<?php echo $_GET["url"]; ?>");
		}
    });
	

        };
        </script>	
  </body>
</html>