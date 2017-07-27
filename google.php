<!DOCTYPE html>
<html>
  <head>
  <?php
include "config.php";
?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="<?php echo $google_api_url?>">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<style>

</style>
  </head>
  <body>
  <div class="ts container">
  
  <br>
   <br>
   
   <div class="ts left aligned slate" id="info">
   <table>
   <tr>
   <td rowspan="2"><span class="description"><div id="gimg"></div></span></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="header"><div id="gname"></div></span></td>
	</tr>
	<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="description"><div id="gemail"></div></span></td>
	</tr>
	</table>
	
	<br>
	<div style="display:inline-block; vertical-align: middle;">
	<div class="g-signin2" data-onsuccess="onSignIn" style="display:inline-block; vertical-align: middle;"></div>&nbsp;&nbsp;&nbsp;&nbsp;
	<button id="logout" class="ts negative basic button" onclick="signOut();" >登出</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="ts basic button" href="<?php echo $_REQUEST["url"]; ?>" id="ok">確定</a>
	</div>

	</div>

  

    <script>
	var userid = "";
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
		
		document.getElementById("gname").innerHTML = profile.getName();
		document.getElementById("gemail").innerHTML = profile.getEmail();
        document.getElementById("gimg").innerHTML = "".concat('<img src="',profile.getImageUrl(),'"></img>');
		
		 document.getElementById('logout').style.visibility = 'visible';
		document.getElementById('ok').style.visibility = 'visible';
		
		userid = profile.getId();
		email = profile.getEmail();
		
        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
		
		authentication();
		
		document.getElementById("ok").href = "".concat("2FA.php?url=","<?php echo $_GET["url"]; ?>","&id=","google:".concat(profile.getEmail()).hexEncode(),"&name=",profile.getName().hexEncode(),"&img=","".concat(profile.getImageUrl()).hexEncode());
		
      };
	  
	  
	  
	  
	  
	  
	  window.onload = function() {
	  document.getElementById('logout').style.visibility = 'hidden';
	   document.getElementById('ok').style.visibility = 'hidden';
      };
	  
	  		String.prototype.hexEncode = function(){
    var hex, i;

    var result = "";
    for (i=0; i<this.length; i++) {
        hex = this.charCodeAt(i).toString(16);
        result += (""+hex).slice(-4);
    }

    return result
}
    </script>
	
        <script>
         var authentication=function(){
           
		$.get("authentication.php",
    {
        userid: userid,
		authentication: "google"
    },
    function(data, status){
        console.log(status);
    });
            
        }
        </script>
	
	
	
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
	  
	  document.getElementById("gname").innerHTML = "";
	  document.getElementById("gemail").innerHTML ="";
      document.getElementById("gimg").innerHTML = "";
	  document.getElementById('logout').style.visibility = 'hidden';
	  document.getElementById('ok').style.visibility = 'hidden';
    });
  }
</script>

</div>
  </body>
</html>