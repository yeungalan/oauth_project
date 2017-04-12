<?php
$json = file_get_contents("https://api.telegram.org/bot300531451:AAHNEgy9O0tZ2z5kKkIJt8TOGLDfzPN16Wk/getUpdates");
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