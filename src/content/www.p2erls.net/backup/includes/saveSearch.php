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
 
$select_multiple_programs=$_GET["select_multiple_programs"];
$select_multiple_networks=$_GET["select_multiple_networks"];
$select_multiple_gradients=$_GET["select_multiple_gradients"];
$select_multiple_regions=$_GET["select_multiple_regions"];
$select_multiple_ecosystems=$_GET["select_multiple_ecosystems"];
$site_elevlow_min=$_GET["site_elevlow_min"];
$site_elevlow_max=$_GET["site_elevlow_max"];
$site_elevhigh_min=$_GET["site_elevhigh_min"];
$site_elevhigh_max=$_GET["site_elevhigh_max"];
$site_temp_min=$_GET["site_temp_min"];
$site_temp_max=$_GET["site_temp_max"];
$site_precip_min=$_GET["site_precip_min"];
$site_precip_max=$_GET["site_precip_max"];
$account_num=$_GET["account_num"];
$search_name=$_GET["search_name"];
$date_saved=date('Y-m-d H:i:s');

$query = "INSERT INTO `p2erls_saved_searches` 
		VALUES (
			'".$saved_search_num."', 
			'".$account_num."', 
			'".$date_saved."', 
			'".$search_name."', 
			'".$select_multiple_programs."', 
			'".$select_multiple_networks."', 
			'".$select_multiple_gradients."',
			'".$select_multiple_regions."', 
			'".$select_multiple_ecosystems."', 
			'".$site_elevlow_min."', 
			'".$site_elevlow_max."', 
			'".$site_elevhigh_min."', 
			'".$site_elevhigh_max."', 
			'".$site_temp_min."', 
			'".$site_temp_max."', 
			'".$site_precip_min."',
			'".$site_precip_max."'
		)";
		
		mysql_query($query);
		
echo"$query";
?>