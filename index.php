<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";
?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <?php  
	if(isset($_REQUEST["url"])!==True){
		header("Refresh: 0; url=error.php?from=index.php&error=URL parameter not detected");
	die();
	}
	
	if(strpos($_REQUEST["url"],".")==False){
			header("Refresh: 0; url=error.php?from=index.php&error=URL parameter error");
	}
	
  ?>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="5318022020-80fbc5pcgvf52gq2el63b33tolcitkop.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
<link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
<style>

</style>
  </head>
  <body>
  <div class="ts container">

  <br>
  
  <div class="ts slate">
  <p>以下程式或網站正嘗試登入</p>
 
  <p><?php echo $_REQUEST["url"]; ?></p>
  
</div>
<br>
  <div class="ts fluid vertical buttons">
  	<a  href="main.php?url=<?php echo bin2hex($_REQUEST["url"]); ?>" class="ts negative button" id="main">Main Server</a>
    <a  href="google.php?url=<?php echo bin2hex($_REQUEST["url"]); ?>" class="ts warning button">Google</a>
    <a  href="github.php?redirect=1&url=<?php echo bin2hex($_REQUEST["url"]); ?>" class="ts primary button">Github</a>
    <a  href="imus.php?url=<?php echo bin2hex($_REQUEST["url"]); ?>" class="ts inverted button">IMUS</a>
</div>
   
</div>


  </body>
</html>