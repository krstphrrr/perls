<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
if (ucfirst($_SESSION[p2erls_username]) == ""){ header("Location: https://www.p2erls.net/web/restricted/index.php"); exit; }
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
<title>P2ERLS - Become an Admin - Pole to Pole Ecological Research Lattice of Sites</title>
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
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="293" style="padding:20px; "><div align="center"><br />
          </div>
          </td>
          <td style="padding-right:20px;padding-top:10px;padding-bottom:10px;">            <div id="become_admin">
              <h3>Become an Admin</h3>
              <?php if($_SESSION[p2erls_access_level] != "1" || $_SESSION[p2erls_access_level] != "2" ){?>
			  <form onsubmit="return validate_admin(this)" action="process_become_admin.php" method="post">
                Please enter your information in the following form to request
                  administrator privileges.<br />
                <br />
                <table width="544" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td width="198"><span class="ast"><b>* </b></span><b>Required</b> </td>
                    <td width="326">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><b><span class="ast"><b>* </b></span><b></b>Email:</b></td>
                    <td><input name="email" type="text" id="email" /> 
                    <span class="ast"></span></td>
                  </tr>
                  <tr>
                    <td><b><span class="ast"><b>* </b></span><b></b>Username:</b></td>
                    <td><input name="username" type="text" id="username" /> 
                    <span class="ast"></span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Submit" value="Submit" /></td>
                  </tr>
                </table>
              </form>
			  <?php }?>
			  <?php if($_SESSION[p2erls_access_level] == "1" || $_SESSION[p2erls_access_level] == "2" ){?>
			  You are already an admin!!!  <br />
<br />
<a href="restricted/index2.php">Click here to modify sites &raquo;</a>
<?php } ?>            </div>
             
          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
