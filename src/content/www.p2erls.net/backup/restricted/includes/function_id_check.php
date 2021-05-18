<?php
include("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$table_name=$_GET["table_name"];
$pkey=$_GET["pkey"];
$pkey_value=$_GET["pkey_value"];
$pkey_value_prev=$_GET["pkey_value_prev"];
//echo "$pkey_value_prev<br>";

if ($pkey_value_prev == '')
{
	//$query_pending = "SELECT * FROM $table_name WHERE $pkey='$pkey_value' AND pending_change='Yes' AND account_num!='0'";
	//$result_pending = mysql_query($query_pending);
	//$num_results_pending = mysql_num_rows($result_pending);
	//echo "$query_pending<br><br>";
	//echo "$num_results_pending<br><br>";
	
	$query_existing = "SELECT * FROM $table_name WHERE $pkey='$pkey_value'";
	$result_existing = mysql_query($query_existing);
	$num_results_existing = mysql_num_rows($result_existing);
	//echo "$query_existing<br><br>";
	//echo "$num_results_existing<br><br>";
	
	/*
	if ($num_results_pending != 0 && $num_results_pending == 1) {
		$result = "Yes,p";
	}
	else if ($num_results_pending == 0 && $num_results_existing > 1) {
		$result = "Yes,e";
	}
	else { $result = "No,"; }
	*/
	if ($num_results_existing > 1) { $result = "Yes,e"; } else { $result = "No,"; }
}
else
{
	if ($pkey_value != $pkey_value_prev)
	{
		$query_existing = "SELECT * FROM $table_name WHERE $pkey='$pkey_value'";
		$result_existing = mysql_query($query_existing);
		$num_results_existing = mysql_num_rows($result_existing);
		//echo "$query_existing<br><br>";
		//echo "$num_results_existing<br><br>";
		
		if ($num_results_existing != 0) { $result = "Yes,e"; } else { $result = "No,"; }
	}
	else
	{
		$query_pending = "SELECT * FROM $table_name WHERE $pkey='$pkey_value' AND pending_change='Yes' AND account_num!='0'";
		$result_pending = mysql_query($query_pending);
		$num_results_pending = mysql_num_rows($result_pending);
		//echo "$query_pending<br><br>";
		//echo "$num_results_pending<br><br>";
		
		if ($num_results_pending != 0) { $result = "Yes,p"; } else { $result = "No,"; }
	}
}

echo "$result";
?>