<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";
header("Refresh: 0; url=error.php?from=location.php&error=Not Implemented Function");
?>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="5318022020-80fbc5pcgvf52gq2el63b33tolcitkop.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
<style>

</style>
  </head>
  <body>
  <div class="ts container">
<center>
  <br>
<p style="font-size:20px;"><?php echo $lang["location_title"]; ?></p>
<p style="font-size:15px;"><?php echo $lang["location_des"]; ?></p>
<br>
   <i style="font-size:400px;text-align:center" class="fa fa-location-arrow fa-6" aria-hidden="true"></i>
   </center>
</div>


  </body>
</html>