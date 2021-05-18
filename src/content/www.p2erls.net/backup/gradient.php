<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
   
include("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$site_id=$_GET["site_id"]; 

$query = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_ecosystems USING (ecosystem_id) LEFT JOIN p2erls_states USING (state_id) LEFT JOIN p2erls_countries USING (country_id)WHERE site_id = '$site_id' AND p2erls_sites.pending_change = 'No' "; 
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
	
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
	$state_name= mysql_result($result,$kk,"state_name"); 
	$country_name= mysql_result($result,$kk,"country_name"); 
	$ecosystem_name= mysql_result($result,$kk,"ecosystem_name");
	$ecosystem_description= mysql_result($result,$kk,"ecosystem_description");
	$site_flyer= mysql_result($result,$kk,"site_flyer");			  
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
<title>P2ERLS - <?php echo "$site_name"; ?> - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/p2erls/restricted/includes/ajax_login.js"></script>
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
          <td width="257" style="padding:20px; "><br /></td>
          <td width="711" style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
		  

<table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr align="left" valign="top">
    <td colspan="2">&nbsp;</td>
    </tr>
   <?php
	$query_programs = "SELECT * FROM p2erls_programs LEFT JOIN p2erls_program_sites USING (program_id) WHERE p2erls_program_sites.site_id = '$site_id' AND p2erls_program_sites.pending_change = 'No' AND p2erls_programs.pending_change = 'No' "; 
 
 	$result_programs = mysql_query($query_programs);
	$num_results_programs = mysql_num_rows($result_programs);
	if($num_results_programs != 0)
	{
	?>
  <?php } ?>
  <?php
  $query_networks = "SELECT * FROM p2erls_networks LEFT JOIN p2erls_network_sites USING (network_id) WHERE p2erls_network_sites.site_id = '$site_id' AND p2erls_network_sites.pending_change = 'No' AND p2erls_networks.pending_change = 'No' "; 
 
 	$result_networks = mysql_query($query_networks);
	$num_results_networks = mysql_num_rows($result_networks);
	if($num_results_networks != 0)
	{
	?>
  <?php } ?>
    <?php
$query_gradients = "SELECT * FROM p2erls_gradients LEFT JOIN p2erls_site_gradient USING (gradient_id) WHERE p2erls_site_gradient.site_id = '$site_id' AND p2erls_site_gradient.pending_change = 'No' AND p2erls_gradients.pending_change = 'No' "; 
 
 	$result_gradients = mysql_query($query_gradients);
	$num_results_gradients = mysql_num_rows($result_gradients);
	if($num_results_gradients != 0)
	{
	?><?php } ?>
  <?php
$query_landowners = "SELECT * FROM p2erls_landowners LEFT JOIN p2erls_site_landowner USING (landowner_id) LEFT JOIN p2erls_landowner_bounds USING (lb_id) LEFT JOIN p2erls_states USING (state_id) WHERE p2erls_site_landowner.site_id = '$site_id' AND p2erls_site_landowner.pending_change = 'No' AND p2erls_landowners.pending_change = 'No' AND p2erls_landowner_bounds.pending_change = 'No' AND p2erls_states.pending_change = 'No' "; 
 
 	$result_landowners = mysql_query($query_landowners);
	$num_results_landowners = mysql_num_rows($result_landowners);
	if($num_results_landowners != 0)
	{
	?> <?php } ?>
  <tr align="left" valign="top">
    <td width="119" valign="top">&nbsp;</td>
    <td width="527">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
  <td><B>Site Description</B></td>
      <td valign="top">
	  <?php
	
	$gradient_id = $_GET["id"];
	$site_id = $_GET["site_id"];
$query_gradients = "SELECT * FROM p2erls_gradients WHERE gradient_id = '$gradient_id' AND pending_change = 'No' "; 
 
 	$result_gradients = mysql_query($query_gradients);
	$num_results_gradients = mysql_num_rows($result_gradients);
	if($num_results_gradients != 0)
	{
	
	for ($i_gradients=0; $i_gradients <$num_results_gradients; $i_gradients++)
	{
		$gradient_id= mysql_result($result_gradients,$i_gradients,"gradient_id");
		$gradient_name= mysql_result($result_gradients,$i_gradients,"gradient_name");
		$gradient_desc= mysql_result($result_gradients,$i_gradients,"gradient_desc");
	}
	}
?><?php echo "$gradient_desc"; ?>	  </td>
      </tr>
  <tr align="left" valign="top">
      <td colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr align="left" valign="top">
      <td valign="top"><b>Sites in Gradient</b> </td>
	  <td valign="top">
	  <?php $query_sites = "SELECT * FROM p2erls_sites as s LEFT JOIN p2erls_site_gradient as g USING(site_id) WHERE gradient_id = '$gradient_id' AND s.pending_change = 'No' "; 
 
 	$result_sites = mysql_query($query_sites);
	$num_results_sites = mysql_num_rows($result_sites);
	if($num_results_sites != 0)
	{
	
	for ($i_sites=0; $i_sites <$num_results_sites; $i_sites++)
	{
		$site_id2= mysql_result($result_sites,$i_sites,"site_id");
		$site_name= mysql_result($result_sites,$i_sites,"site_name");
	 ?>
	 <p><a href="site.php?site_id=<?php echo "$site_id2"; ?>"><?php echo "$site_name"; ?></a></p>
	 <?php }} ?>
</td>
  </tr>
  <tr align="left" valign="top">
      <td colspan="2" valign="top"><a href="site.php?site_id=<?php echo "$site_id"; ?>">Back to Site: <?php echo "$site_id"; ?></a></td>
  </tr>
</table>
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
