<?php
require ("../Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);


$site_num = $_GET["num"];
if($site_num != ""){
$query = "SELECT * FROM p2erls_sites WHERE site_id = '$site_num'";
//echo "$query";
$result = mysql_query($query);
$num_results = mysql_num_rows($result); 
 
for ($i = 0; $i <$num_results; $i++)
  	{
	$site_flyer					= mysql_result($result,$i,'site_flyer');
	}	

$image = imagecreatefromjpeg("../../flyers/$site_num/$site_flyer.jpg");
header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);
}
?>
