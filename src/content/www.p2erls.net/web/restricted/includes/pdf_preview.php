<?php 
$site_id = $_GET["site_id"];
require ("../Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$query = "SELECT * FROM p2erls_sites WHERE site_id = '$site_id' ORDER BY site_id ASC";
$result = mysql_query($query);
$num_results = mysql_num_rows($result); 
  for ($i=0; $i <$num_results; $i++)
  	{
  	$site_flyer= mysql_result($result,$i,"site_flyer");
	}

exec("convert '../../flyers/$site_id/$site_flyer'[0] -colorspace RGB -geometry 200 '../../flyers/$site_id/preview.jpeg'"); 
//echo "convert '../../flyers/$site_id/$site_flyer' -colorspace RGB -geometry 200 '../../flyers/$site_id/preview.jpeg'";



?>