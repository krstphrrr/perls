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
<title>P2ERLS - Saved Sites - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAASnpDFqD4bcXj7kSd5IwZJxRBJaH5kVAE2FIAMXg-zOHkL3oC4RRW82i7w-_PrOPd-JZIfuDcMy0aEA"></script>
<script type="text/javascript" language="javascript" src="includes/map_functions2.js"></script> 
<script type="text/javascript" language="javascript" src="includes/effects.js"></script>
<script type="text/javascript" language="javascript" src="includes/protoload.js"></script>
<script type="text/javascript" language="javascript" src="includes/control.select_multiple.1.0.0.RC1.js"></script>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/restricted/includes/ajax_login.js"></script>

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
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "> 
    <table width="988" border="0" cellspacing="0" cellpadding="5">
      <tr align="left" valign="top">
        <td width="293" style="padding:15px; ">
          <table width="223" border="0" cellspacing="0" cellpadding="6"> 
                  <tr align="center">
                    <td width="210">
					 
<span class="header">Saved Searches </span>
					<div id="showSavedSearches">
					<?php include("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$account_num=$_SESSION["p2erls_account_num"];
if($account_num==''){ echo"You Must Be Logged In To View Your Saved Searches."; }
else{
$query_saved_searches = "SELECT * FROM p2erls_saved_searches where account_num = '$account_num' ORDER BY saved_search_num ASC";
		
$result_saved_searches = mysql_query($query_saved_searches); 
$num_results_saved_searches = mysql_num_rows($result_saved_searches); 
if($num_results_saved_searches=='0'){ echo"Sorry, You Have Not Saved Any Searches."; }
if($num_results_saved_searches!='0'){
?>
<table width="200" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php
for ($kk_saved_searches=0; $kk_saved_searches <$num_results_saved_searches; $kk_saved_searches++)
{
	$saved_search_num= mysql_result($result_saved_searches,$kk_saved_searches,"saved_search_num"); 
	$account_num= mysql_result($result_saved_searches,$kk_saved_searches,"account_num");
	$date_saved= mysql_result($result_saved_searches,$kk_saved_searches,"date_saved");
	$search_name= mysql_result($result_saved_searches,$kk_saved_searches,"search_name");
	$select_multiple_programs= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_programs");
	$select_multiple_networks= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_networks");
	$select_multiple_gradients= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_gradients");
	$select_multiple_regions= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_regions");
	$select_multiple_ecosystems= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_ecosystems");
	$site_elevlow_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevlow_min");
	$site_elevlow_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevlow_max");
	$site_elevhigh_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevhigh_min");
	$site_elevhigh_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevhigh_max"); 
	$site_temp_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_temp_min"); 
	$site_temp_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_temp_max"); 
	$site_precip_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_precip_min"); 
	$site_precip_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_precip_max"); 
?>
		
  <tr>
    <td><a href="javascript:loadSearch('<?php echo"$select_multiple_programs";?>','<?php echo"$select_multiple_networks";?>','<?php echo"$select_multiple_gradients";?>','<?php echo"$select_multiple_regions";?>','<?php echo"$select_multiple_ecosystems";?>','<?php echo"$site_elevlow_min";?>','<?php echo"$site_elevlow_max";?>','<?php echo"$site_elevhigh_min";?>','<?php echo"$site_elevhigh_max";?>','<?php echo"$site_temp_min";?>','<?php echo"$site_temp_max";?>','<?php echo"$site_precip_min";?>','<?php echo"$site_precip_max";?>')" class="white"><?php echo"$search_name";?></a> - <a href="javascript:removeSearch('<?php echo"$saved_search_num";?>','<?php echo"$search_name";?>','<?php echo"$account_num";?>')" class="white">Remove</a></td>
  </tr>
 	 
<?php } ?> 
<tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } }?>			</div>
					</td>
              </tr> 
            </table>
	         
	      <br /></td>
        <td style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><div id="loadingMarkers">Click A Saved Seach to Display Sites</div><div id="map2">
          <div id="map"></div>
        </div>          <br />
  <div id="searchSites"></div>
</td></tr>
    </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table> 
</body>
</html>
