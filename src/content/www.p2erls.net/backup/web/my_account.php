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
<title>P2ERLS - About Us - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<script type="text/javascript" language="javascript" src="includes/func_affiliations.js"></script>
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
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="251" style="padding:20px; "><br /></td>
          <td width="717" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><h3 align="left"><span style="font-family: Verdana;">My Account </span></h3>
              <?php
require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$account_num = $_SESSION[p2erls_account_num];

$query = "SELECT * FROM p2erls_accounts WHERE account_num = '$account_num' ";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);

for ($i=0; $i <$num_results; $i++)
{
	$account_num= mysql_result($result,$i,"account_num");
	$username= mysql_result($result,$i,"username");
	$password= mysql_result($result,$i,"password");
	$active_user= mysql_result($result,$i,"active_user");
	$member_since= mysql_result($result,$i,"member_since"); 
	$last_login= mysql_result($result,$i,"last_login");
	$first_name= mysql_result($result,$i,"first_name");
	$last_name= mysql_result($result,$i,"last_name");
	$phone_num= mysql_result($result,$i,"phone_num");
	$email= mysql_result($result,$i,"email");
	$affiliation= mysql_result($result,$i,"affiliation");
	$institution= mysql_result($result,$i,"institution");
	$affil_role= mysql_result($result,$i,"affil_role");
	$comments= mysql_result($result,$i,"comments");
	?>
         <form onsubmit="return validate_update_account(this)" action="process_my_account.php" method="post" name="my_account" id="form" >
			 
          <table width="74%" align="center" cellpadding="5" cellspacing="0">
          
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b><font class="ast">*</font> Username</b></td>
                <td><input type="text" value="<?php echo"$username";?>" name="username" id="username" size="30" /></td>
              </tr>
              <tr>
                <td><b><font class="ast">*</font> Password</b></td>
                <td><input type="text" value="<?php echo"$password";?>" name="password" id="password" size="30" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b>Active User </b></td>
                <td><?php echo"$active_user";?></td>
              </tr>
              <tr>
                <td><b>Member Since </b></td>
                <td><?php echo"$member_since";?></td>
              </tr>
              <tr>
                <td><b>Last Login </b></td>
                <td><?php echo"$last_login";?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b><font class="ast">*</font> First Name </b></td>
                <td><input type="text" value="<?php echo"$first_name";?>" name="first_name" id="first_name" size="30" /></td>
              </tr>
              <tr>
                <td><b><font class="ast">*</font> Last Name </b></td>
                <td><input type="text" value="<?php echo"$last_name";?>" name="last_name" id="last_name" size="30" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b>Phone Number </b></td>
                <td><input type="text" value="<?php echo"$phone_num";?>" name="phone_num" id="phone_num" size="30" /></td>
              </tr>
              <tr>
                <td><b><span class="ast"><b>* </b></span><b></b>Email:</b></td>
                <td><input name="email" type="text" id="email" value="<?php echo "$email" ?>" />
                    <span class="ast"> </span></td>
              </tr>
              <tr>
                <td><b>Website:</b></td>
                <td><input name="website" type="text" id="website" value="<?php echo "$website" ?>" /></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b>Affiliation:</b></td>
                <td><select name="affiliation" id="affiliation">
		  <option value="None" <?php if($affiliation == ""){ ?>selected="selected"<?php } ?>>None</option>
		  <option value="K-12" <?php if($affiliation == "K-12"){ ?>selected="selected"<?php } ?>>K-12</option>
		  <option value="College or University" <?php if($affiliation == "College or University"){ ?>selected="selected"<?php } ?>>College or University</option>
		  <option value="NPO" <?php if($affiliation == "NPO"){ ?>selected="selected"<?php } ?>>Non-Profit Agency</option>
		  <option value="State or Federal Agency" <?php if($affiliation == "State or Federal Agency"){ ?>selected="selected"<?php } ?>>State or Federal Agency</option>
		  <option value="Private Company" <?php if($affiliation == "Private Company"){ ?>selected="selected"<?php } ?>>Private Company</option>

          </select></td>
              </tr>
              <tr>
                <td><b>Institution:</b>
				 <?php $institutions_def = array('NMSU','USDA','Jornada','Ecotrends','EPA'); ?>
				</td>
                <td><select name="<?php if(!in_array($institution, $institutions_def)){ echo "institution_drop";} else{ echo "institution";} ?>" id="institution_drop" onchange="toggle_affiliationma();">
              <option value="none" <?php if($institution == "none"){ ?>selected="selected" <?php } ?>>None</option>
              <option value="NMSU" <?php if($institution == "NMSU"){ ?> selected="selected" <?php } ?>>NMSU</option>
              <option value="USDA" <?php if($institution == "USDA"){ ?> selected="selected" <?php } ?>>USDA</option>
              <option value="Jornada" <?php if($institution == "Jornada"){ ?> selected="selected" <?php } ?>>Jornada</option>
              <option value="Ecotrends" <?php if($institution == "Ecotrends"){ ?> selected="selected" <?php } ?>>Ecotrends</option>
              <option value="EPA" <?php if($institution == "EPA"){ ?> selected="selected" <?php } ?>>EPA</option>
              <option value="other" <?php if(!in_array($institution, $institutions_def)){ ?> selected="selected" <?php } ?>>Other</option>
            </select>
                <input name="<?php if(!in_array($institution, $institutions_def)){ echo "institution";} else{ echo "institution_other";} ?>" id="institution_other" type="text" style="display:<?php if(!in_array($institution , $institutions_def)){ echo "block";} else{ echo "none";} ?>" value="<?php if(!in_array($institution , $institutions_def)){ echo "$institution";} ?>" /></td>
              </tr>
              <tr>
                <td><b>Role at Institution: </b></td>
                <td><input name="affil_role" type="text" value="<?php echo "$affil_role"; ?>"/>
                  &nbsp;</td>
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
                <td><b><font class="ast">*</font> = required field</b></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr align="center">
                <td colspan="2"><b>
                  <input name="username_old" type="hidden" value="<?php echo "$username"; ?>"/> 
				  <input name="email_old" type="hidden" value="<?php echo "$email"; ?>"/> 
				  <input type="hidden" value="<?php echo"$account_num";?>" name="account_num" id="account_num" ecosystem_id="account_num" />
                  <input type="submit" value="Update Account" />
                </b></td>
              </tr>
            </table>    
        </form> 
          <?php } ?>          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
