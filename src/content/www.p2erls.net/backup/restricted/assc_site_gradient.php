<?php  
	require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

		 
$site_id=$_GET["site_id"]; 
$gradient_id=$_GET["gradient_id"]; 
$value=$_GET["v"]; 
if($value=='true'){
$query="INSERT INTO p2erls_site_gradient VALUES(
'$site_id', 
'$gradient_id'
			)";
			 
			mysql_query($query);
			//echo"$query";
			}
if($value!='true'){ 

			$var_site_id=$_GET["site_id"];
			$var_gradient_id=$_GET["gradient_id"];
			$query="DELETE FROM p2erls_site_gradient where site_id='$var_site_id' and gradient_id='$var_gradient_id'";
			mysql_query($query); 
			//echo"$query";
			}
		 ?> 
