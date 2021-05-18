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
<title>P2ERLS - Site Map - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<style type="text/css">
<!--
@import url("includes/p2erls_styles.css");  
-->
</style>
</head>
<body onload="load()";>
<table width="988" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include("includes/login.php"); ?>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="255" style="padding:20px; "><br /></td>
          <td width="713" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><?php   
 
require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$query_sites = "SELECT * FROM p2erls_sites WHERE p2erls_sites.pending_change != 'Yes' ORDER BY site_id ASC";
$result = mysql_query($query_sites);
$num_results = mysql_num_rows($result); 	
		 

?> <h2>All Sites
            </h2>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
 
  <?php if($num_results!=0){ ?>
  
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="0">
        <tr>
          <td width="14%">&nbsp;</td>
          <td width="86%"><b> Site Name </b></td>
          </tr>
        <?php
		for ($kk=0; $kk <$num_results; $kk++)
		{
			 	$site_id= mysql_result($result,$kk,"site_id"); 
				$site_name= mysql_result($result,$kk,"site_name");
				$site_url= mysql_result($result,$kk,"site_url");
				$site_lat= mysql_result($result,$kk,"site_lat");
				$site_long= mysql_result($result,$kk,"site_long");
				$site_elevlow= mysql_result($result,$kk,"site_elevlow");
				$site_elevhigh= mysql_result($result,$kk,"site_elevhigh");
				$site_elevmean= mysql_result($result,$kk,"site_elevmean");
				$site_temp= mysql_result($result,$kk,"site_temp");
				$site_precip= mysql_result($result,$kk,"site_precip");
				$site_desc= mysql_result($result,$kk,"site_desc");
				$ecosystem_id= mysql_result($result,$kk,"ecosystem_id");
				$state_id= mysql_result($result,$kk,"state_id"); 
				$country_id= mysql_result($result,$kk,"country_id"); 
			
				 
			  ?>
        <tr>
          <td><a href="site.php?site_id=<?php echo"$site_id";?>" target="_blank">View &raquo;</a></td>
          <td><?php if($site_url!=''){?>
            <a href="<?php echo"$site_url";?>" target="_blank">
            <?php } ?>
            <?php echo"$site_name";?>
            <?php if($site_url!=''){?>
            </a>
            <?php } ?></td>
          </tr>
        <?php } ?> 
      </table></td>
  </tr>
  <?php } ?>
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
