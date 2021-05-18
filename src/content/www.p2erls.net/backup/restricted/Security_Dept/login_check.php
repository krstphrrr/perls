<?php 

$username=$_GET["username"];
$password=$_GET["password"]; 

include("config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

 
$query_username_check = "SELECT username FROM p2erls_accounts WHERE username='$username'";
$result_username_check = mysql_query($query_username_check);
$num_results_username_check = mysql_num_rows($result_username_check);
 
if($num_results_username_check!=0) 
{
	$query_login_check = "SELECT * FROM p2erls_accounts WHERE username='$username' AND password='$password' AND active_user='Yes' ";
	$result_login_check = mysql_query($query_login_check);
	$num_results_login_check = mysql_num_rows($result_login_check);
 	
	if($num_results_login_check != 0) 
	{
		$account_num	= mysql_result($result_login_check,0,"account_num");
		$access_level	= mysql_result($result_login_check,0,"access_level");
		$first_name		= mysql_result($result_login_check,0,"first_name"); 
		
		$time_now		= date("Y-m-d H:i:s");	

		$query_login = "UPDATE `p2erls_accounts` SET last_login='$time_now' WHERE account_num='$account_num'";
		mysql_query($query_login);

		session_start();
		$_SESSION["p2erls_account_num"] 	= $account_num;
		$_SESSION["p2erls_username"] 		= $username;
		$_SESSION["p2erls_access_level"] 	= $access_level; 
		echo "$access_level";
		/*
		
		echo "<b><span style='color:#FF0000;'>account_num : $account_num</span></b>";
		echo "<b><span style='color:#FF0000;'>access_level : $access_level</span></b>";
		echo "<b><span style='color:#FF0000;'>username : $username</span></b>";
		*/
		
	} 
	else 
	{
		echo "<b><span style='color:#FF0000;'>Invalid Password. Please Try Again.</span></b>";
	}
}  
else 
{
	echo "<b><span style='color:#FF0000;'>Invalid Username. Please Try Again.</span></b>";
}
?>