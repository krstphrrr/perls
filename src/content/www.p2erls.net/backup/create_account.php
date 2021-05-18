<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
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
<script type="text/javascript" language="javascript" src="includes/func_affiliations.js"></script>
 
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
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "> 
    <table width="988" border="0" cellspacing="0" cellpadding="5">
      <tr align="left" valign="top">
        <td width="270" style="padding:20px; "><div align="center"> </div>
            <br /></td>
        <td width="698" style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
		<div id="create_account">
		<h2>Create Account </h2>
      <form onSubmit="return validate_registration(this)" action="process_create_account.php" method="post">
                  Please enter your information in the following form to create your account. <br />
                  <br />
                  <table width="544" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                      <td><span class="ast"><b>* </b></span><b>Required</b> </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="198"><b><span class="ast"><b>* </b></span><b></b>First Name:</b></td>
                      <td width="326"><input name="first_name" type="text" id="first_name" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                      <td><b><span class="ast"><b>* </b></span><b></b>Last Name: </b></td>
                      <td><input name="last_name" type="text" id="last_name" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b>Phone Number(include country code):</b></td>
                      <td><input name="phone" type="text" id="phone" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Address 1: </b></td>
                        <td><input name="address1" type="text" id="address1" /></td>
                    </tr>
                    <tr>
                        <td><b>Address 2: </b></td>
                        <td><input name="address2" type="text" id="address2" /></td>
                    </tr>
                    <tr>
                        <td><b>City:</b></td>
                        <td><input name="city" type="text" id="city" /></td>
                    </tr>
                    <tr>
                        <td><b>State:</b></td>
                        <td>
						<?php
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query = "SELECT * FROM p2erls_states ORDER BY state_id ASC";
						$result = mysql_query($query);
						$num_results = mysql_num_rows($result); 
						
						?>
						<select name="state_id" id="state_id" width="30">
						<option value="">select</option>
						
						<?php   
						for ($i=0; $i <$num_results; $i++)
						{
						$state_id		= mysql_result($result,$i,"state_id");
						$state_name		= mysql_result($result,$i,"state_name");	 	
						
						
						?>
						<option value="<?php echo"$state_id"; ?>"><?php echo"$state_name"; ?></option>
						<?php } ?>
						</select>
						</td>
                    </tr>
                    <tr>
                        <td><b>Zip:</b></td>
                        <td><input name="zip" type="text" id="zip" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b><span class="ast"><b>* </b></span><b></b>Email:</b></td>
                      <td><input name="email" type="text" id="email" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                      <td><b>Website:</b></td>
                      <td><input name="website" type="text" id="website" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b>Affiliation:</b></td>
                      <td><select name="affiliation" id="affiliation">
                        <option value="None" selected="selected">None</option>
                        <option value="K-12">K-12</option>
                        <option value="College or University">College or University</option>
                        <option value="NPO">Non-Profit Agency</option>
                        <option value="State or Federal Agency">State or Federal Agency</option>
                        <option value="Private Company">Private Company</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td><b>Institution:</b></td>
                      <td><input type="text" name="institution" id="institution_drop" />					  </td>
                    </tr>
                    <tr>
                      <td><b>Role at Institution: </b></td>
                      <td>
					  <select name="affil_role">
					  <option value="" selected="selected">Select</option>
					  <option value="Student">Student</option>
					  <option value="Faculty">Faculty</option>
					  <option value="Researcher">Researcher</option>
					  <option value="Administrator">Administrator</option>
					  <option value="Other">Other</option>
					  </select>					  </td>
                    </tr>
                    <tr>
                      <td><b>Comments:</b></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><textarea name="comments" cols="56" rows="15"></textarea></td>
                    </tr>                    
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
					<tr>
                      <td><b><span class="ast"><b>* </b></span><b></b>Username:</b></td>
                      <td><input name="username" type="text" id="username" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                      <td><b><span class="ast"><b>* </b></span><b></b>Password:</b></td>
                      <td><input name="password" type="password" id="password" />
                        <span class="ast"> </span></td>
                    </tr>
                    <tr>
                      <td><b><span class="ast"><b>* </b></span><b></b>Confirm Password:</b></td>
                      <td><input name="confirm_password" type="password" id="confirm_password" />
                        <span class="ast"> </span></td>
                    </tr>
					<tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
					<tr>
                      <td>&nbsp;</td>
                      <td><img src="includes/da_code.php" alt="Security image" width="100" height="50" /></td>
                    </tr>
                    <tr>
                      <td valign="top"><b><span class="ast"><b>* </b></span>Security Code: </b></td>
                      <td><input name="s_image" type="text" id="s_image" size="5" maxlength="4" /><br />
					  <i><font color="#666666" size="2">Please type in the letters you see in the above image. If you are having trouble with the current image please refresh this page.</font></i></p></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="hidden" name="verify" value="Yes" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="Submit" value="Create Account" /></td>
                    </tr>
                  </table>
        </form></div>
</td></tr>
    </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
