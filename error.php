<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
</head>
<body>
<div class="ts container">
<br>
<div class="ts inverted negative card">
    <div class="content">
        <div class="header">哦不！ 發生錯誤 :(</div>
        <div class="description">
		<p>錯誤描述 : <?php echo $_GET["error"]; ?></p>
		<p>錯誤URL : <?php echo $_GET["from"]; ?></p>
		
        </div>
    </div>
	</div>

	<p> oauth.alanyeung.co 錯誤 </p>	
</div>
</body>
</html>