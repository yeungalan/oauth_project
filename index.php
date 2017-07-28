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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
<style>

</style>
  </head>
  <body>
  <div class="ts container">

  <br>
  <?php
    if($requireauthenction=="true"){
		if($authenctionkey==$_REQUEST["key"]){
		}else{
			header("Refresh: 0; url=error.php?from=index.php&error=Access Key Invaild");
		}
	}else{
	}
  
  if($announcement=="" || $announcementgrade==""){
  }else{
	  echo '<div class="alert alert-'.$announcementgrade.'" role="alert"><i class="fa fa-asterisk fa-2" aria-hidden="true"></i> '.$announcement.'</div>';
  }
  ?>
  	<?php
	$json = file_get_contents("developer.json");
	$obj = json_decode($json);
	if(isset($_REQUEST["dev_key"])){
		$dev = $_REQUEST["dev_key"];
	}else{
		$dev = "null";
	}
	?>
  <br>
  
 <div class="ts heading vertically padded slate">
  <p>以下程式或網站正嘗試登入</p>
 

  <details class="ts accordion" open>
    <summary>
        <i class="dropdown icon"></i>  
		<?php 
		$domain = parse_url($_REQUEST["url"]);
  if(strpos($_REQUEST["url"],"127.0.0.1")===False){
  echo $domain["host"];
  }else{
  echo "本地端應用程式";
  
  }
  ?>
  		<?php 
		
		if($obj->{$dev}->{"verified"} == "true"){
			if($domain["host"] == $obj->{$dev}->{"usualdomain"} || $domain["host"] == "127.0.0.1"  || $domain["host"] == "localhost")
			echo '<i class="fa fa-shield" aria-hidden="true" ></i>';
		}
		?>
    </summary>
    <div class="content">
        <p>開發者 : <?php echo $obj->{$dev}->{"author"}; ?></p>
		<p>作者網頁 : <?php echo $obj->{$dev}->{"web"}; ?></p>
		<p>認證日期 : <?php echo $obj->{$dev}->{"date"}; ?></p>
    </div>
</details>
</div>
<br>
  <div class="ts fluid vertical buttons">
  <?php 
    $disable=0;
  if(strpos($_REQUEST["disable"],"M")===False){
  echo '<a  href="main.php?url='.bin2hex($_REQUEST["url"]).'" class="ts negative button" id="main">Main Server</a>';
  $disable =  $disable +1;
  }
  if(strpos($_REQUEST["disable"],"G")===False){
  echo '<a  href="google.php?url='.bin2hex($_REQUEST["url"]).'" class="ts warning button">Google</a>';
    $disable =  $disable +1;
  }
  if(strpos($_REQUEST["disable"],"T")===False){
  echo '<a  href="github.php?url='.bin2hex($_REQUEST["url"]).'" class="ts primary button">Github</a>';
    $disable =  $disable +1;
  }
  if(strpos($_REQUEST["disable"],"I")===False){
  echo '<a  href="imus.php?url='.bin2hex($_REQUEST["url"]).'" class="ts inverted button">IMUS</a>';
    $disable =  $disable +1;
  }	
  
  if($disable ==0){
 header("Refresh: 0; url=error.php?from=index.php&error=No Login Method Available");
  }	
  ?>
  	
</div>
   
</div>


  </body>
</html>