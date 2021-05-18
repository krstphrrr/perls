<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
 
include("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$email=$_POST["email"];   

  
$query = "select * from p2erls_accounts where email='$email'";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
$account_exists=$num_results;
if($num_results=='1')
{  
	

		   
  	for ($i=0; $i <$num_results; $i++)
  	{
		$account_num= mysql_result($result,$i,"account_num"); 
		$username= mysql_result($result,$i,"username");
		$email= mysql_result($result,$i,"email");
		$password= mysql_result($result,$i,"password");
		$active_user= mysql_result($result,$i,"active_user"); 
		$already_activated=$active_user;
	}
	if($active_user!='Yes')
	{
	
		$active_user= md5(uniqid(rand()));
		$member_since= date("Y-m-d H:i:s");	
		
		$query3="UPDATE p2erls_accounts SET active_user='".$active_user."' WHERE account_num='".$account_num."'";
		mysql_query($query3);
		
		$to=$_POST["email"];  
		$subject = "P2erls.net - New Activation Code";
		$headers = "From: P2erls<p2erls@nmsu.edu>\r\n";
		$body = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
Click on the confirmation link to activate your account.

https://www.p2erls.net/web/activate.php?code=$active_user
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

P2ERLS Admin.

https://www.p2erls.net	

\n
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
<title>P2ERLS - Activate Your Account - Pole to Pole Ecological Research Lattice of Sites</title>
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
          <td width="272">&nbsp;</td>
		  <td width="696" style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
			 
		      <h3><span class="purple">Get New Activation Code</span></h3>
		      <p class="style1"><b>
		        <?php if($active_user!='Yes' && $account_exists!='0'){ ?>
  An email has been sent to <?php echo"$email";?>.</b></p>
		      <p class="style1">Please check your email so we can verify your email.</p>
		      <p class="style1"> All you need to do is click on the link provided in your email and your account will be activated. </p>
		      <?php } ?>
              <?php if($account_exists=='0'){ ?>
              <p><b> That account does not exist. </b><br />
                  <br />
  If you are an existing Digital Solutions customer please call us at (505) 523-7661 or email us digitalsolutions@zianet.com </p>
              <p>If you are not an existing Digital Solutions customer you can create a free account.<br />
                  <a href="create_account.php" ><b>Create Account &raquo;</b></a></p>
              <?php } ?>
              <?php	if($active_user=='Yes' && $account_exists!='0'){ ?>
              
              <p><b>Your account has already been activated. </b><br />
                  <br />
  Please enter your email address and we will send you your password. <br />
  <br />
  You can also log in if you know your password.&nbsp;&nbsp; <a href="login.php"><b>Log In &raquo;</b></a><br />
              </p>
              <form method="post" action="process_forgot_password.php">
                <table width="302" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="78">Email:</td>
                    <td width="204"><input name="email" type="text" id="email" size="25" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Retrieve Password" style="border:solid 1px #000000;" /></td>
                  </tr>
                </table>
              </form>
              <?php } ?>
<p>&nbsp;</p> </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
