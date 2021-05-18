<?php
session_start(); if($_SESSION["p2erls_username"] != '') { header("Location: https://www.p2erls.net/web/my_account.php"); } 
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
<title>P2ERLS - Login - Pole to Pole Ecological Research Lattice of Sites</title>

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
          <td width="259" style="padding:20px; "><div align="center"> </div>
              <br /></td>
          <td width="709" style="padding-right:20px;padding-top:10px;padding-bottom:10px;">            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableBorder">
            <tr>
              <td align="left"><h2>Log In </h2></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td><form action="restricted/Security_Dept/redirect.php" method="post" name="form1" id="form1">
                  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="tableBorder">
                    <tr bgcolor="#eeeeee">
                      <td colspan="2"><div id="loginDetails"><strong>Enter Username and Password</strong></div></td>
                    </tr>
                    <tr align="left" valign="top">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="left" valign="top">
                      <td width="50%">Username</td>
                      <td width="50%"><input name="username" type="text" id="username" /></td>
                    </tr>
                    <tr align="left" valign="top">
                      <td>Password</td>
                      <td><input name="password" type="password" id="password" /></td>
                    </tr>
                    <tr align="left" valign="top">
                      <td>&nbsp;</td>
                      <td><input type="submit" name="Button" value="Go"  />
                      </td>
                    </tr>
                    <tr align="left" valign="top">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="left" valign="top">
                      <td><p><span class="style1">You can create a FREE account that will enable you to Save Searches and to edit site information. </span></p>
                        <p align="center"><a href="create_account.php"><img src="images/free-accnt-btn.gif" alt="Create your FREE account!" width="201" height="32" border="0" title="Create your FREE account!" /></a> </p></td>
                      <td> <p><a href="forgot_password.php" ><b>Forgot Password &raquo;</b></a></p>
                        <p>Already created an account and never received activation code, or lost it? Get a new one. <a href="activate_account.php" ><b><br />
                        Get new Activation Code &raquo; </b></a></p></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                  </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
