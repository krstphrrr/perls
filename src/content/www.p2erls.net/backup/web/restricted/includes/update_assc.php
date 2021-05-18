<?php
session_start();

require ("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$curr_session_acct=$_SESSION["p2erls_account_num"];
$access_level=$_SESSION["p2erls_access_level"];
$account_num=$_GET["account_num"];
$table_name=$_GET["table_name"];
$pkey=$_GET["pkey"];
$pkey_value=$_GET["pkey_value"];
$assc_pkey=$_GET["assc_pkey"];
$assc_pkey_value=$_GET["assc_pkey_value"];
$turn=$_GET["turn"];

if ($account_num == '') { $account_num = 0; }
$db_date = date("Y-m-d H:i:s");

//echo "access_level = $access_level<br>";
//echo "turn = $turn<br>";
//echo "account_num = $account_num<br>";
//echo "curr_session_acct = $curr_session_acct<br>";

if ($turn == 'On')
{
	if ($access_level == 1)
	{
		$query_pending_no="INSERT INTO $table_name VALUES (
		'".$pkey_value."', 
		'".$assc_pkey_value."',		
		'No',
		'',
		'',
		'',
		'".$db_date."')";					 
		mysql_query($query_pending_no);		
		$response = "1,";
		//echo "query_pending_no = $query_pending_no<br>";
	}
	else
	{
		if ($curr_session_acct != $account_num && $account_num == 0)
		{
			$query_pending_yes="INSERT INTO $table_name VALUES (
			'".$pkey_value."', 
			'".$assc_pkey_value."',			
			'Yes',
			'No',
			'".$curr_session_acct."',
			'".$db_date."',
			'')";					 
			mysql_query($query_pending_yes);		
			$response = "2,$curr_session_acct";
			//echo "query_pending_yes = $query_pending_yes<br>";
		}
		else
		{
			
			$query_delete_removal_request="DELETE FROM $table_name WHERE delete_assc='Yes' AND pending_change='Yes' AND account_num='".$account_num."' AND $pkey='".$pkey_value."' AND $assc_pkey='".$assc_pkey_value."'";
			mysql_query($query_delete_removal_request);
			$response = "3,";
			//echo "query_delete_removal_request = $query_delete_removal_request<br>";
		}
	}
}

if ($turn == 'Off')
{
	if ($access_level == 1)
	{
		$query_pending_no="DELETE FROM $table_name WHERE $pkey='".$pkey_value."' AND $assc_pkey='".$assc_pkey_value."'";
		mysql_query($query_pending_no);		
		$response = "4,";
		//echo "query_pending_no = $query_pending_no<br>";
	}
	else
	{
		if ($curr_session_acct != $account_num && $account_num == 0)
		{
			$query_pending_yes="INSERT INTO $table_name VALUES (
			'".$pkey_value."', 
			'".$assc_pkey_value."',
			'Yes',
			'Yes',
			'".$curr_session_acct."',
			'".$db_date."',
			'')";
			mysql_query($query_pending_yes);			
			$response = "5,$curr_session_acct";
			//echo "query_pending_yes = $query_pending_yes<br>";
		}
		else
		{
			$query_delete_approval_request="DELETE FROM $table_name WHERE delete_assc='No' AND pending_change='Yes' AND account_num='".$account_num."' AND $pkey='".$pkey_value."' AND $assc_pkey='".$assc_pkey_value."'";
			mysql_query($query_delete_approval_request);
			$response = "6,";
			//echo "query_delete_approval_request = $query_delete_approval_request<br>";
		}
	}
}

echo "$response";
?>