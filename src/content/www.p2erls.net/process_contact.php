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

// Gather form field information
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$phone=$_POST["phone"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$comments=$_POST["comments"];
$email=$_POST["email"];
$date = date("m/d/Y H:i:s");

// Define variables for mail function parameters of the message sent to site owner
$to = "p2erls@nmsu.edu";
$subject = "P2erls.net - Questions and Comments - Main Contact Form";
$headers = "From: P2erls Web Site Visitor<p2erls@nmsu.edu>\r\n";
$body = "
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Name: $first_name $last_name\n
E-Mail: $email
Phone Number: $phone\n 
Address: $address
City: $city
State: $state
Zip Code: $zip\n
Questions/Comments: 

$comments\n

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
\n
Date/Time:  $date\n
";

 	//mail($to, $subject, $body, $headers);
	mail("p2erls@nmsu.edu", $subject, $body, $headers);
	
if (!empty($email)) {
	$to2 = $email;
	$subject2 = "Thank You For Visiting p2erls.net";
	$headers2 = "From: P2erls<p2erls@nmsu.edu>\r\n";
	$body2 = "Thank you for visiting p2erls.net and contacting us. 
	Your message has been received and we will respond to your inquiry as soon as we can.\n
 
Sincerely,

P2ERLS Admin.

https://www.p2erls.net

\n
\n
\n ";

	// Send the confirmation message to the site visitor
	mail($to2, $subject2, $body2, $headers2);
} else {
	print "";
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
<title>P2ERLS - Contact P2ERLS - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<style type="text/css">
<!--
@import url("includes/p2erls_styles.css"); 
-->
</style> 
 

</head>

<body>
<table width="988" border="0" align="center" cellpadding="0" cellspacing="0"><?php include("includes/login.php"); ?>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="268" style="padding:20px; "><div align="center"> </div>
              <br /></td>
          <td width="700" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><div id="create_account">
              <h3>Contact P2ERLS </h3>
              <h4>Thank you, <?php echo "$first_name"; ?>!</h4>
              <p>Your form has been received and a confirmation e-mail has been sent to the address you provided. <br />
                <br />
  Thank you for your interest in P2ERLS.</p>
              <p>&nbsp;</p>
          </div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>