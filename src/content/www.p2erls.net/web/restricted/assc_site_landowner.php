<?php  
require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
		 
$site_id=$_GET["site_id"];
$landowner_id=$_GET["landowner_id"];
//$checkbox_condition=$_GET["checkbox_condition"];
$turn=$_GET["turn"];
$access_level=$_GET["access_level"];
$db_date = date("Y-m-d H:i:s");

//echo "turn = $turn<br>";

if ($turn == 'On')
{
	if ($access_level == 1)
	{
		$query_pending_no="INSERT INTO p2erls_site_landowner VALUES (
		'".$site_id."', 
		'".$landowner_id."',
		'',
		'No',
		'',
		'',
		'".$db_date."')";					 
		mysql_query($query_pending_no);
		
		$response = 1;
	}
	else
	{
		$query_pending_yes="INSERT INTO p2erls_site_landowner VALUES (
		'".$site_id."', 
		'".$landowner_id."',
		'No',
		'Yes',
		'".$_SESSION["p2erls_account_num"]."',
		'".$db_date."',
		'')";					 
		mysql_query($query_pending_yes);
		
		$response = 2;
	}
}

if ($turn == 'Off')
{
	if ($access_level == 1)
	{
		$query_pending_no="DELETE FROM p2erls_site_landowner WHERE site_id='".$site_id."' AND landowner_id='".$landowner_id."'";
		mysql_query($query_pending_no); 
		
		$response = 3;
		
		/*
		$query_pending_no="INSERT INTO p2erls_site_landowner VALUES (
		'".$site_id."', 
		'".$landowner_id."',
		'',
		'No',
		'',
		'',
		'".$db_date."')";					 
		mysql_query($query_pending_no);
		echo"t";
		*/
	}
	else
	{
		$query_pending_yes="INSERT INTO p2erls_site_landowner VALUES (
		'".$site_id."', 
		'".$landowner_id."',
		'Yes',
		'Yes',
		'".$_SESSION["p2erls_account_num"]."',
		'".$db_date."',
		'')";					 
		mysql_query($query_pending_yes);
		
		$response = 4;
	}
}
/*
if ($checkbox_condition != true)
{ 

			$var_site_id=$_GET["site_id"];
			$var_landowner_id=$_GET["landowner_id"];
			$query="DELETE FROM p2erls_site_landowner where site_id='$var_site_id' and landowner_id='$var_landowner_id'";
			mysql_query($query); 
			echo"f";
}
*/			
//echo "query_pending_no = $query_pending_no<br>";
//echo "query_pending_yes = $query_pending_yes<br>";
echo "$response";
?>