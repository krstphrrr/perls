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
          <td width="260" style="padding:20px; "><div align="center"> </div>
              <br /></td>
          <td width="708" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><div id="create_account">
              <h2>Contact P2ERLS </h2>
              <p><br />
                Dr. Debra Peters, Project Leader<br />
                Research scientist, USDA ARS, Jornada Experimental Range<br />
                Principal investigator, Jornada Basin LTER<br />
                Box 30003, MSC 3JER, NMSU<br />
                Las Cruces, NM 88003-0003<br />
                Voice: 505 646 2777<br />
              email: debpeter@nmsu.edu </p>
              
               <p></p>
              <form onsubmit="return validate(this)" action="process_contact.php" method="post" enctype="multipart/form-data">
                <table width="75%" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td width="30%" align="left"><b><font class="ast">* </font>First Name</b></td>
                    <td width="70%"><input name="first_name" type="text" id="first_name" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><b> <font class="ast">*</font> Last Name</b></td>
                    <td><input name="last_name" type="text" id="last_name" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><b><font class="ast">*</font><font color="#CC0000"> </font>E-Mail</b></td>
                    <td><input name="email" type="text" id="email" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left"><b>Phone Number</b></td>
                    <td><input name="phone" type="text" id="phone" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left"><b>Address</b></td>
                    <td><input name="address" type="text" id="address" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><b>City</b></td>
                    <td><input name="city" type="text" id="city" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><b>State</b></td>
                    <td><select name="state" id="state">
                        <option value="Alabama">Alabama</option>
                        <option value="Alaska">Alaska</option>
                        <option value="Arizona">Arizona</option>
                        <option value="Arkansas">Arkansas</option>
                        <option value="California">California</option>
                        <option value="Colorado">Colorado</option>
                        <option value="Connecticut">Connecticut</option>
                        <option value="Delaware">Delaware</option>
                        <option value="District of Columbia">District of Columbia</option>
                        <option value="Florida">Florida</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Idaho">Idaho</option>
                        <option value="Illinois">Illinois</option>
                        <option value="Indiana">Indiana</option>
                        <option value="Iowa">Iowa</option>
                        <option value="Kansas">Kansas</option>
                        <option value="Kentucky">Kentucky</option>
                        <option value="Louisiana">Louisiana</option>
                        <option value="Maine">Maine</option>
                        <option value="Maryland">Maryland</option>
                        <option value="Massachusetts">Massachusetts</option>
                        <option value="Michigan">Michigan</option>
                        <option value="Minnesota">Minnesota</option>
                        <option value="Mississippi">Mississippi</option>
                        <option value="Missouri">Missouri</option>
                        <option value="Montana">Montana</option>
                        <option value="Nebraska">Nebraska</option>
                        <option value="Nevada">Nevada</option>
                        <option value="New Hampshire">New Hampshire</option>
                        <option value="New Jersey">New Jersey</option>
                        <option value="New Mexico" selected="selected">New Mexico</option>
                        <option value="New York">New York</option>
                        <option value="North Carolina">North Carolina</option>
                        <option value="North Dakota">North Dakota</option>
                        <option value="Ohio">Ohio</option>
                        <option value="Oklahoma">Oklahoma</option>
                        <option value="Oregon">Oregon</option>
                        <option value="Pennsylvania">Pennsylvania</option>
                        <option value="Rhode Island">Rhode Island</option>
                        <option value="South Carolina">South Carolina</option>
                        <option value="South Dakota">South Dakota</option>
                        <option value="Tennessee">Tennessee</option>
                        <option value="Texas">Texas</option>
                        <option value="Utah">Utah</option>
                        <option value="Vermont">Vermont</option>
                        <option value="Virginia">Virginia</option>
                        <option value="Washington">Washington</option>
                        <option value="West Virginia">West Virginia</option>
                        <option value="Wisconsin">Wisconsin</option>
                        <option value="Wyoming">Wyoming</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left"><b>Zip Code</b></td>
                    <td><input name="zip" type="text" id="zip" size="10" /></td>
                  </tr>
                  <tr>
                    <td valign="top" align="left">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top" align="left"><b><font class="ast">*</font> Comments</b></td>
                    <td><textarea name="comments" id="comments" rows="8" cols="35"></textarea></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td><img src="includes/da_code.php" alt="Security image" width="100" height="50" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><b><font class="ast">*</font> Security Code:</b></td>
                    <td><input name="s_image" type="text" id="s_image" size="10" maxlength="4" />
                        <p><i><font color="#666666" size="2">Please type in the letters you see in the above image. If you are having trouble with the current image please refresh this page.</font></i></p></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><b><br />
                        <font class="ast">*</font> = required field</b></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><b><br />
                      <input type="hidden" name="verify" value="Yes" />
                      <input type="submit" name="submit" id="submit" value="Send Request" />
                    </b></td>
                  </tr>
                </table>
              </form>
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
