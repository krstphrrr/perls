<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();

include("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$email=$_POST["email"];  
   
$query = "SELECT * FROM p2erls_accounts WHERE email='$email'";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
$account_exists=$num_results;
if($num_results=='1')
{  

	for ($i=0; $i <$num_results; $i++)
	{
		$password= mysql_result($result,$i,"password");   	 
		$active_user= mysql_result($result,$i,"active_user");
	}
	
	if($active_user=='Yes')
	{
		$to = $email;
		$subject = 'P2erls.net - Account Password';
		$headers = "From: P2erls<p2erls@nmsu.edu>\r\n";
		$body = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
Your P2erls.net Password is: $password
		
Please login at https://www.P2erls.net/login.php
		 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
		
P2ERLS Admin.

https://www.p2erls.net

\n 
		";
		 
		
		mail($to, $subject, $body, $headers);
	 	mail("lerner@digitalsolutionslc.com", $subject, $body, $headers);
	}	
}
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
<title>P2ERLS - Forgot Password - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/restricted/includes/ajax_login.js"></script>
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
          <td width="269">&nbsp;</td>
		  <td width="699" style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
			 
		      <h3><span class="purple">Forgot Password </span></h3>
		      <p class="purple">
		        <?php if($active_user=='Yes' && $account_exists!='0'){ ?>
		      </p>
		      <p><span class="purple">Your Password has been sent to</span> <span class="orange"><?php echo"$email";?> </span><span class="purple">.</span></p>
		      <p><span class="purple">Once you get your email please <a href="login.php">log in &raquo;</a>.</span></p>
		      <?php } ?>
              <?php if($account_exists=='0'){ ?>
              <span class="purple">Sorry, the email <?php echo"$email";?> is invalid.<br />
              </span>
              <p><span class="purple"><a href="#" onclick="history.go(-1)" ><b>Try Another Email. (go back) </b></a></span></p>
              <?php } ?>
              <?php if($active_user!='Yes' && $account_exists!='0'){ ?>
              <p class="purple"> Sorry, There is a P2ERLS Account with that email but it has not been activated yet. </p>
              <p><span class="purple">Once you activate your account you can then click the forgot password link. <br />
                    <br />
                    <a href="activate_account.php" ><b>Activate your Account &raquo;</b></a> </span></p>
              <p><span class="purple"><a href="#" onclick="history.go(-1)" ><b>Try Another Email. (go back) </b></a></span></p>
              <?php } ?> </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
