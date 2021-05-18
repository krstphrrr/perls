<?php    
/*
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Copyright (C) 2007 Cro-Cec, Inc. dba Digital Solutions.
// A complete description of Digital Solutions (c) copyright notice can be found online at:
// https://www.digitalsolutionslc.com/copyright_notice.php
//
// Digital Solutions is a premier marketing and web development company in Las Cruces, New Mexico.
// We offer professional web design including flash and database web sites, graphic design, marketing materials,
// and video production.
//
// If you enjoyed this website and are looking for custom web development, give us a call at (505) 523-7661.
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

include("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$query_lat_long 		= "SELECT * FROM sites ORDER BY site_id ASC";
$result_lat_long 		= mysql_query($query_lat_long); 
$num_results_lat_long 	= mysql_num_rows($result_lat_long);  
 
for ($i_lat_long = 0; $i_lat_long < $num_results_lat_long; $i_lat_long++)
{
	$site_id 	= mysql_result($result_lat_long,$i_lat_long,"site_id"); 
	$site_lat 	= mysql_result($result_lat_long,$i_lat_long,"site_lat");
	$site_long 	= mysql_result($result_lat_long,$i_lat_long,"site_long"); 
	$site_name 	= mysql_result($result_lat_long,$i_lat_long,"site_name"); 
	echo"$site_name - $site_lat - $site_long <br>"; 
	$query_update_site = "UPDATE p2erls_sites SET
		site_lat	= '".$site_lat."',
		site_long	= '".$site_long."'
	WHERE site_id 	= '$site_id'";
	
	mysql_query($query_update_site); 
}  
?>