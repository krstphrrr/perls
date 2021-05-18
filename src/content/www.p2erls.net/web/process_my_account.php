<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();

require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$account_num = $_SESSION[p2erls_account_num];

$username=$_POST["username"];
$username_old=$_POST["username_old"];
$password=$_POST["password"]; 
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$phone_num=$_POST["phone_num"];
$email=$_POST["email"];
$email_old=$_POST["email_old"];
$website=$_POST["website"];
$affiliation=$_POST["affiliation"];
$institution=$_POST["institution"];
$affil_role=$_POST["affil_role"];
$comments=$_POST["comments"];
	
 
if($email != $email_old)
{
		$query2 = "SELECT * FROM p2erls_accounts WHERE email = '$email'";
		$result2 = mysql_query($query2);
		$num = mysql_num_rows($result2);
		
		if ($num != 0)
		{
			echo "<P>Sorry, that email already exists.</P>";
			echo "<P><a href=\"#\" onClick=\"history.go(-1)\">Try Another Email.</a></p>";
			exit;
		}
}
if($username != $username_old)
{
		$query2 = "SELECT * FROM p2erls_accounts WHERE username = '$username'";
		$result2 = mysql_query($query2);
		$num = mysql_num_rows($result2);
		
		if ($num != 0)
		{
			echo "<P>Sorry, that username already exists.</P>";
			echo "<P><a href=\"#\" onClick=\"history.go(-1)\">Try Another username.</a></p>";
			exit;
		}
}
if(($email == $email_old && $username == $username_old) || $num =='0' || $num =='' )
{ 

		$query="UPDATE p2erls_accounts SET 
			username='".$username."',
			password='".$password."',
			first_name='".$first_name."',
			last_name='".$last_name."', 
			email='".$email."',
			phone_num='".$phone_num."',
			website='".$website."',
			affiliation='".$affiliation."',
			institution='".$institution."',
			affil_role='".$affil_role."',
			comments='".$comments."'
			where account_num='".$account_num."'
		";
	  	
		mysql_query($query);
		//echo "$query";
		
$to = "p2erls@nmsu.edu";
$subject = "p2erls.net - Account Updated";
$headers = "From: P2erls<p2erls@nmsu.edu>\r\n";
$body = "
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$username has updated their account. 
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

Thanks,\n

Dr. Debra Peters, Project Leader
Research scientist, USDA ARS, Jornada Experimental Range
Principal investigator, Jornada Basin LTER
Box 30003, MSC 3JER, NMSU
Las Cruces, NM 88003-0003
Voice: 505 646 2777
email: debpeter@nmsu.edu 

Christine Laney, Project Coordinator
Jornada Basin LTER
Box 30003, MSC 3JER, NMSU
Las Cruces, NM 88003-0003
Voice: 505 646 3478
email: chrlaney@nmsu.edu

https://www.p2erls.net

\n
\n  
";
 
mail($to, $subject, $body, $headers);  

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
<title>P2ERLS - About Us - Pole to Pole Ecological Research Lattice of Sites</title>
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
  <tr>
    <td align="right" valign="top" id="login">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="images/header.jpg" width="988" height="155" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="259" style="padding:20px; "><br /></td>
          <td width="709" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><h3 align="left"><span style="font-family: Verdana;">My Account </span></h3>
              <p><b>Your account has been updated.</b> </p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
<?php } ?>
