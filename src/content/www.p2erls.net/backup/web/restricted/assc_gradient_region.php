<?php  
	require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$gradient_id=$_GET["gradient_id"]; 
$region_id=$_GET["region_id"]; 
$value=$_GET["v"]; 

			 //echo"$value";
if($value=='true'){
$query="INSERT INTO p2erls_gradient_region VALUES(
'$gradient_id', 
'$region_id'
			)";
			 
			mysql_query($query);
			  //echo"$query";
			}
if($value!='true'){ 
			
			$gradient_id=$_GET["gradient_id"]; 
			$region_id=$_GET["region_id"];
			 
			$query="DELETE FROM p2erls_gradient_region where gradient_id='$gradient_id' and region_id='$region_id'";
			mysql_query($query); 
			  //echo"$query";
			}
		 ?> 
