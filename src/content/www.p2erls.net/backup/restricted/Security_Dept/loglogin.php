<?php

//open the file
$file = fopen("log.php",  "a");

//require config.php file
require('config.php');

//set the date and time
$time=gmdate("d M Y H:i", time() + $zone);

//write the date and time to the file
fwrite( $file, "<b>When:</b> $time<br/>" );

//if the IP the user is coming from isn't NULL
if( $REMOTE_ADDR != null)
{
	//write the IP address to the file
	fwrite( $file, "<b>IP Address:</b> $REMOTE_ADDR <br/>");
}

//write the username to the file
fwrite( $file, "<b>User:</b> $_SESSION[username]<br/><br/>");

//close the file
fclose($file);

?>