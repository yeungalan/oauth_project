<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
		
		<p><a onclick="ts('#modal').modal('show');">錯誤詳情</a></p>
        </div>
    </div>
	</div>

	<p> oauth.alanyeung.co 錯誤 </p>	
</div>

<div class="ts modals dimmer">
    <dialog id="modal" class="ts closable tiny modal" data-modal-initialized="true">
        <div class="content">
		<p>調試信息</p>

		<?php
		session_start();
			echo  wordwrap(bin2hex(json_encode(get_defined_vars())), 50, "\n", true);;	
	    ?>
 
    </div>
           
        </div>
       
    </dialog>
</div>
</body>
</html>