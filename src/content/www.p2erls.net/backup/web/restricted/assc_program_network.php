<?php  
	require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$program_id=$_GET["program_id"]; 
$network_id=$_GET["network_id"]; 
$value=$_GET["v"]; 

			 //echo"$value";
if($value=='true'){
$query="INSERT INTO p2erls_program_networks VALUES(
'$program_id', 
'$network_id'
			)";
			 
			mysql_query($query);
			  //echo"$query";
			}
if($value!='true'){ 
			
			$program_id=$_GET["program_id"]; 
			$network_id=$_GET["network_id"];
			 
			$query="DELETE FROM p2erls_program_networks where program_id='$program_id' and network_id='$network_id'";
			mysql_query($query); 
			  //echo"$query";
			}
		 ?> 
