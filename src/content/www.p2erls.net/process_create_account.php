<?php /*********************************************************************
					   Digital Solutions Contact Form 
					Version 4.1 --> Modified Jun 7, 2007
*********************************************************************/ 
 
// This line is necessary to verify the security image. 
ini_set('arg_separator.output', '&amp;'); session_start();

// This will test if the security code entered for the security image is correct
if (empty($_POST["s_image"]) || $_POST["s_image"] != $_SESSION["rand_code"]) {
	echo '<h2>You have entered an incorrect security code.</h2>
	<p><a href="javascript: history.go(-1)"><b>Click here to refresh you back to your screen to try again.</b></a></p>';
	exit();
}
unset($_SESSION["rand_code"]);

// This will verify that the user got to this page from the form, otherwise they will be redirected to the home page.
// Don't forget to add the hidden tag from the contact_form_template!
if ($_POST["verify"] != 'Yes') {
	echo '<meta http-equiv="refresh" content="3;url=https://'.$_SERVER['HTTP_HOST'].'">
	<h2>You have reached this page in error.</h2>
	<p><b>Please standby to be redirected.</b></p>';
	exit();
}

require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$account_num			=$_POST["account_num"];
$active_user			= md5(uniqid(rand()));
$member_since			= date("Y-m-d H:i:s");
//$last_login			=$_POST['last_login'];  	
$first_name				=$_POST["first_name"];  	 
$last_name				=$_POST["last_name"];  	 
$phone					=$_POST["phone"]; 
$address1				=$_POST["address1"]; 
$address2				=$_POST["address2"]; 
$city					=$_POST["city"]; 
$state_id				=$_POST["state_id"]; 
$zip					=$_POST["zip"]; 
$email					=$_POST["email"]; 
$website				=$_POST["website"]; 
$affiliation			=$_POST["affiliation"]; 
$institution			=$_POST["institution"]; 
$affil_role				=$_POST["affil_role"];
$comments				=$_POST["comments"];  
$username				=$_POST["username"];  
$password				=$_POST["password"]; 

$query = "SELECT * FROM p2erls_accounts WHERE username = '$username'";
$result = mysql_query($query);
$num_results= mysql_num_rows($result);

if ($num_results != 0) {
	echo '<html>
		<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="refresh" content="5;url=javascript: history.go(-1)">  
		</head>
		<body> 
		<h2>Sorry, there is already a member with that username.</h2>
		<p>This page will refresh you back to your screen to try again.</p>   
		</body>
		</html>';
	exit;
}

$query = "SELECT * FROM p2erls_accounts WHERE email = '$email'";
$result = mysql_query($query);
$num_results= mysql_num_rows($result);

if ($num_results != 0) {
	echo '<html>
		<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="refresh" content="5;url=javascript: history.go(-1)">  
		</head>
		<body> 
		<h2>Sorry, there is already a member with that email.</h2>
		<p>This page will refresh you back to your screen to try again.</p>   
		</body>
		</html>';
	exit;
}

$query = "INSERT INTO `p2erls_accounts` VALUES  (
'',  	 	
'".$username."',  
'".$password."',  
'".$active_user."', 
'".$member_since."', 
'', 
'".$first_name."',  	 
'".$last_name."',  
'".$phone."', 
'".$address1."', 
'".$address2."', 
'".$city."', 
'".$state_id."', 
'".$zip."', 	
'".$email."',
'".$website."',
'3',
'".$affiliation."',
'".$institution."',
'".$affil_role."',
'".$comments."'

)";   

mysql_query($query);

$date = date("m/d/Y H:i:s");
/////////////////////////////////////////////////////////////////////////////////////

$to = $email;
	$subject = "P2ERLS - Account Registration Confirmation";
	$headers = "From: P2ERLS<p2erls@nmsu.edu>\r\n";
	$body = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Thank you for registering for an account at P2ERLS.

Your username is $username
Your password is $password

Click on the confirmation link to activate your account.

https://www.p2erls.net/activate.php?code=$active_user

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

P2ERLS Admin.

https://www.p2erls.net

\n
\n  
";
       mail($email, $subject, $body, $headers);
	//mail("p2erls@nmsu.edu", $subject, $body, $headers);
	//mail($to, $subject, $body, $headers); 
	//mail("lerner@digitalsolutionslc.com", $subject, $body, $headers);
	
	/////////////////////////////////////////////////////////////////////////////////////

	$to2 = "p2erls@nmsu.edu";
	$subject2 = "P2ERLS - New Account Created";
	$headers2 = "From: P2ERLS<$to>\r\n";
	$body2 = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

An account has been created.

Name: $first_name $last_name
Username: $username
Phone: $phone
Address 1: $address1
Address 2: $address2
City: $city
State: $state_id
Zip: $zip
Email: $email
Website: $website
Affiliation: $affiliation
Institution: $institution
Role: $affil_role

Comments: $comments
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
\n
\n
Date/Time:  $date\n
";
 

	mail($to2, $subject2, $body2, $headers2); 
	//mail("keith@digitalsolutionslc.com", $subject2, $body2, $headers2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Copyright (C) 2007 Cro-Cec, Inc. dba Digital Solutions.
// A complete description of Digital Solutions (c) copyright notice can be found online at:
// https://www.digitalsolutionslc.com/copyright_notice.php
//
// Digital Solutions is a premier marketing and web development company in Las Cruces, New Mexico.
// We offer professional web design including flash and database web sites, graphic design, marketing materials,
// and video production.
//
// If you enjoyed this website and are looking for custom web development, give us a call at (505) 523-7661.
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="images/favicon.ico" /> 
<meta name="description" content="This 'network of networks' is designed to: facilitate new research opportunities by assisting in the identification of individual sites and gradients of sites, and promote synthesis via increased interactions among researchers working at different sites." />
<meta name="keywords" content="p2erls, research, sites, networks, gradients, regions" />
<meta name="copyright" content="copyright 2007, P2erls, Digital Solutions" />
<meta name="language" content="english" />
<meta name="distribution" content="global" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="14 days" />
<meta name="author" content="Digital Solutions" />
<title>P2ERLS - Create an Account - Pole to Pole Ecological Research Lattice of Sites</title>
 
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<style type="text/css">
<!--
@import url("includes/p2erls_styles.css"); 
-->
</style> 
</head>

<body>
<table width="988" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include("includes/login.php"); ?>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "> 
    <table width="988" border="0" cellspacing="0" cellpadding="5">
      <tr align="left" valign="top">
        <td width="293" style="padding:20px; "><div align="center"> </div>
            <br /></td>
        <td style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
		<div id="create_account">
		<h3>Account Created </h3>
        Thank you for creating an account. An email has been sent to the address you provided with record of your username and password, as well as a confirmation link with an activation code. To log in the first time, you must click on that confirmation link and activate your account.<br />
		</div>
</td></tr>
    </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
