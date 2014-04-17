<?php
if($_SERVER["HTTP_X_FORWARDED_FOR"] != ""){
   $IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
   $proxy = $_SERVER["REMOTE_ADDR"];
   $host_name = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
}else{
   $IP = $_SERVER["REMOTE_ADDR"];
   $proxy = "No proxy detected";
   $host_name = @gethostbyaddr($_SERVER["REMOTE_ADDR"]);
}
?>
