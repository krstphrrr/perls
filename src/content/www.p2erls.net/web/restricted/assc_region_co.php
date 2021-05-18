<?php  
	require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$region_id=$_GET["region_id"]; 
$co_id=$_GET["co_id"]; 
$value=$_GET["v"]; 

			// echo"$value";
if($value=='true'){
$query="INSERT INTO p2erls_region_co VALUES(
'$region_id', 
'$co_id'
			)";
			 
			mysql_query($query);
			 //echo"$query";
			}
if($value!='true'){ 
			
			$region_id=$_GET["region_id"]; 
			$co_id=$_GET["co_id"];
			 
			$query="DELETE FROM p2erls_region_co where region_id='$region_id' and co_id='$co_id'";
			mysql_query($query); 
			 //echo"$query";
			}
		 ?> 
