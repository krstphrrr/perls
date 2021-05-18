<?php 
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
session_unset();

$username = $_POST["username"];
$password = $_POST["password"]; 

include("config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

 
$query_login_check 			= "SELECT * FROM p2erls_accounts WHERE username = '$username' AND password = '$password' AND active_user = 'Yes' ";
$result_login_check 		= mysql_query($query_login_check);
$num_results_login_check 	= mysql_num_rows($result_login_check);
//echo"$query_login_check <br>";
//echo"$num_results_login_check <br>";
if($num_results_login_check != 0) 
{
	$account_num	= mysql_result($result_login_check,0,"account_num");
	$access_level	= mysql_result($result_login_check,0,"access_level");
	$first_name		= mysql_result($result_login_check,0,"first_name"); 
	
	$time_now		= date("Y-m-d H:i:s");	

	$query_login = "UPDATE `p2erls_accounts` SET last_login = '$time_now' WHERE account_num = '$account_num'";
	mysql_query($query_login);

 
	$_SESSION["p2erls_account_num"] 	= $account_num;
	$_SESSION["p2erls_username"] 		= $username;
	$_SESSION["p2erls_access_level"] 	= $access_level; 
	//echo "$access_level";
	 
	if($access_level == 1)
	{
		header("Location: https://www.p2erls.net/restricted/index2.php");
		exit;
	}
	else
	{
		header("Location: https://www.p2erls.net/index.php?incorrect=Y");
		exit;
	}
} 
else 
{
	header("Location: https://www.p2erls.net/index.php?incorrect=Y");
	exit;
}
 
?>