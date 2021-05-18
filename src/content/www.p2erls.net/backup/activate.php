<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$code=$_GET['code'];  

if($code!=''){
	$query = "SELECT * FROM p2erls_accounts WHERE active_user = '$code'";
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);
	$is_code=$num_results;
	//echo"is_code $is_code <br />";
	 if($num_results!="0"){
		for ($i=0; $i <$num_results; $i++)
  		{
			$account_num= mysql_result($result,$i,"account_num");		
			$username= mysql_result($result,$i,"username");
			$active_user2= mysql_result($result,$i,"active_user");		
		}
	
if($active_user2!='Yes'){
		$query3 = "UPDATE `p2erls_accounts` SET active_user = 'Yes' WHERE  account_num = '$account_num' ";
		mysql_query($query3);

$member_since= date("Y-m-d H:i:s");	

$query_login = "UPDATE `p2erls_accounts` SET member_since = '$member_since' WHERE account_num = '$account_num' ";
mysql_query($query_login);



/////////////////////////////////////////////////////////////////////////////////////
$to = "p2erls@nmsu.edu";
	$subject = 'p2erls.net - Account Registration Activated';
	$headers = "From: P2erls<p2erls@nmsu.edu>\r\n";
	$body = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$username just created an account.

This Account Has Been Activated!!!
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

P2ERLS Admin.

https://www.p2erls.net

\n
\n  
";
 

	mail($to, $subject, $body, $headers);
	 mail("p2erls@nmsu.edu", $subject, $body, $headers);
	 
}
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
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<style type="text/css">
<!--
@import url("includes/p2erls_styles.css"); 
.style7 {font-family: Arial, Helvetica, sans-serif; color: #424C68; font-size: 12px;}
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
		  <td width="699" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><h3>Activate Account
			  </h3>
		     <?php if($is_code!='0' && $code!=''){ ?>
             <p>Your account has been activated. Please <a href="login.php"><b>Log In &raquo;</b></a>. <br />
               <br />
               <?php } ?>
               <?php if($is_code=='0' || $code==''){ ?>
You have an invalid code. Please check your email again.<br />
<br />
or Your account has already been activated. Please <a href="login.php"><b>Log In &raquo;</b></a><br />
<?php } ?> 
</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;             </p></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
