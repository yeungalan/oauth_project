<?php
include '../config.php';
$json = file_get_contents("https://api.telegram.org/bot".$telegram_bot_id."/getUpdates");
$array = json_decode( $json, true );
$array = $array["result"];
   foreach($array as $items) { //foreach element in $arr
   if($items["message"]["text"]==$_GET["text"]){
   echo $items["message"]["from"]["id"]; //etc
   die();
   }else{
   }
	}

?>