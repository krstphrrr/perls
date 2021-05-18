<?php  
	require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$network_id=$_GET["network_id"]; 
$site_id=$_GET["site_id"]; 
$value=$_GET["v"]; 

			 //echo"$value";
if($value=='true'){
$query="INSERT INTO p2erls_network_sites VALUES(
'$network_id', 
'$site_id'
			)";
			 
			mysql_query($query);
			  //echo"$query";
			}
if($value!='true'){ 
			
			$network_id=$_GET["network_id"]; 
			$site_id=$_GET["site_id"];
			 
			$query="DELETE FROM p2erls_network_sites where network_id='$network_id' and site_id='$site_id'";
			mysql_query($query); 
			  //echo"$query";
			}
		 ?> 
