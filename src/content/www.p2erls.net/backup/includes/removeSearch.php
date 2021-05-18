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
 
$saved_search_num=$_GET["saved_search_num"];

include("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);


$query="DELETE FROM p2erls_saved_searches WHERE saved_search_num = '$saved_search_num'";
mysql_query($query);

echo"$query";
?>