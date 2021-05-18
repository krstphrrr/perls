<?php
include("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$table_name=$_GET["table_name"];
$pkey=$_GET["pkey"];
$pkey_value=$_GET["pkey_value"];
$check_type=$_GET["check_type"];

if ($check_type == 'pending')
{
	$query_pending = "SELECT * FROM $table_name WHERE $pkey='$pkey_value' AND pending_change='Yes' AND account_num!='0'";
	$result_pending = mysql_query($query_pending);
	$num_results_pending = mysql_num_rows($result_pending);
	//echo "$query_pending<br><br>";
	//$awaiting_update= mysql_result($result_pending,0,"pending_change");
		
	//if ($awaiting_update == 'Yes') { $result = true; }
	//if ($awaiting_update == 'No') { $result = false; }
	
	if ($num_results_pending != 0) { $result = "Yes"; } else { $result = "No"; }
}

if ($check_type == 'existing')
{
	$query_existing = "SELECT * FROM $table_name WHERE $pkey='$pkey_value'";
	$result_existing = mysql_query($query_existing);
	$num_results_existing = mysql_num_rows($result_existing);
	//echo "$query_pending<br><br>";
	//$awaiting_update= mysql_result($result_pending,0,"pending_change");
		
	//if ($awaiting_update == 'Yes') { $result = true; }
	//if ($awaiting_update == 'No') { $result = false; }
	
	if ($num_results_pending != 0) { $result = "Yes"; } else { $result = "No"; }
}

echo "$result";
?>