<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
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
<?php
$json = file_get_contents('https://api.telegram.org/bot300531451:AAHNEgy9O0tZ2z5kKkIJt8TOGLDfzPN16Wk/getMe');
$obj = json_decode($json);
?>
<a href="https://telegram.me/<?php echo $obj->{"result"}->{"username"}; ?>">啟動@<?php echo $obj->{"result"}->{"first_name"}; ?></a>
<p>之後請在聊天框中輸入 : /start 876540@1</p>
<p>系統會自動偵測閣下的身份，在完成後你將會重定向到完成畫面</p>
</td>

</table>
</div>	

<script>
	   $("#gauthcode").keyup(function(event){
    if(event.keyCode == 13){
        tg();
    }
});
	</script>
	        <script>
         var tg=function(){
           
		$.get("./lib/g_reg.php",
    {
        code: $('#gauthcode').val(),
		user: "<?php echo $secret; ?>",
    },
    function(data, status){
        console.log(status);
		console.log(data);
		if(data=="true"){
			alert("成功");
			window.location.replace("index.php");
		}
    });
	

        };
        </script>	
  </body>
</html>