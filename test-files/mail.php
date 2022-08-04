<?php

$to = "juhde.1997@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: supplydohcaraga@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

if(mail($to,$subject,$txt,$headers)){
	echo "sent";
}else{
	echo "not sent";
}

?>