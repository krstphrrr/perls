<?php  
	require ("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$site_id=$_GET["site_id"]; 
$landowner_id=$_GET["landowner_id"];
$value=$_GET["v"];   
if($value=='true'){
$query="INSERT INTO p2erls_site_landowner VALUES(
'$site_id', 
'$landowner_id'
			)";
			 
			mysql_query($query);
			}
if($value!='true'){ 

			$var_site_id=$_GET["site_id"];
			$var_landowner_id=$_GET["landowner_id"];
			$query="DELETE FROM p2erls_site_landowner where site_id='$var_site_id' and landowner_id='$var_landowner_id'";
			mysql_query($query); 
			
			}
		 ?> 
