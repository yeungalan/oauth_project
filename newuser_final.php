<!DOCTYPE html>
<html>
  <head>
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
            <div class="title">Google</div>
            <div class="description">輸入你的Google Authenctor驗證</div>
        </div>
    </div>
    <div class="step">
       　 <i class="info icon"></i>
        <div class="content">
            <div class="title">Telegram</div>
            <div class="description">輸入你的Telegram驗證代碼</div>
        </div>
    </div>
    <div class="active step">
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
<p>請確保下列資料正確，之後按確定</p>
<p>Telegram : <?php echo $_GET["tg"]; ?></p>
<p>Google Secret : <?php echo $_GET["data"]; ?></p>
<button class="btn btn-block btn-lg btn-primary" onclick="g_auth();">確定</button>
</td>

</table>
        <script>
         var g_auth=function(){
           
		$.get("./lib/newuser.php",
    {
        google: "<?php echo $_GET["data"]; ?>",
		id: "<?php echo $_GET["id"]; ?>",
		telegram: "<?php echo $_GET["tg"]; ?>",
    },
    function(data, status){
        console.log(status);
    });
	
window.location = "index.php?url=<?php echo $_GET["url"]; ?>";
        };
        </script>	
  </body>
</html>