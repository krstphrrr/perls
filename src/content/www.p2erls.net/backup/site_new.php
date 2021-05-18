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
	
	if ($site_elevlow == 0 || $site_elevlow == NULL) { $site_elevlow = ''; }
	if ($site_elevhigh == 0 || $site_elevhigh == NULL) { $site_elevhigh = ''; }
	if ($site_elevmean == 0 || $site_elevmean == NULL) { $site_elevmean = ''; }
	if ($site_temp == 0 || $site_temp == NULL) { $site_temp = ''; }
	if ($site_precip == 0 || $site_precip == NULL) { $site_precip = ''; }
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
<title>P2ERLS - Pole to Pole Ecological Research Lattice of Sites - <?php echo "$site_name"; ?></title>
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
		<td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;"> 
		<table width="988" border="0" cellspacing="0" cellpadding="5">
			<tr align="left" valign="top">
				<td width="255">&nbsp;</td>
				<td width="713" valign="top" style="padding-right:15px;"><h3 align="center">Site Details</h3>
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><b>Site Name:</b> <?php if ($site_url != '') { ?><a href="<?php echo "$site_url"; ?>" target="_blank"><?php } echo "$site_name"; if ($site_url != '') { ?></a><?php } ?></td>
						<td><b>Site ID:</b> <?php echo "$site_id"; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="top">
						<td><b>Latitude:</b> <?php echo "$site_lat"; ?></td>
						<td><b>Longitude:</b> <?php echo "$site_long"; ?></td>
						<td><b>Location:</b> <?php echo "$state_name"; ?>, <?php echo "$country_name"; ?></td>
					</tr>					
					<tr>
						<td colspan="3"><b>Ecosystem:</b> <?php echo "$ecosystem_name"; ?></td>
					</tr>
					<tr valign="top">
						<td><table align="left" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><b>Elevation (m):</b></td>
								<td class="l_r_padding_more">Low: <?php echo "$site_elevlow"; ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td class="l_r_padding_more">High: <?php echo "$site_elevhigh"; ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td class="l_r_padding_more">Mean: <?php echo "$site_elevmean"; ?></td>
							</tr>
						</table></td>
						<td><b>Temperature ( &deg;C ):</b> <?php echo "$site_temp"; ?></td>
						<td><b>Precipitation (mm):</b> <?php echo "$site_temp"; ?></td>
					</tr>
					<tr>
						<td colspan="3"><b>Site Description:</b> <?php echo "$site_description"; ?></td>
					</tr>
					<tr valign="top">
						<td><b>Program(s):</b></td>
    					<td colspan="2">
						<?php
						$display_programs = '';
						
						$query_programs = "SELECT * FROM p2erls_programs LEFT JOIN p2erls_program_sites USING (program_id) WHERE p2erls_program_sites.site_id = '$site_id' AND p2erls_program_sites.pending_change = 'No' AND p2erls_programs.pending_change = 'No' "; 
						$result_programs = mysql_query($query_programs);
						$num_results_programs = mysql_num_rows($result_programs);
						
						for ($i_programs=0; $i_programs <$num_results_programs; $i_programs++)
						{
							$program_id= mysql_result($result_programs,$i_programs,"program_id");
							$program_name= mysql_result($result_programs,$i_programs,"program_name");
							$program_url= mysql_result($result_programs,$i_programs,"program_url");
						
							if ($network_url != '')
							{
								$display_programs = "<a href='$program_url' target='_blank'>$program_name</a>, ";
							}
							else
							{
								$display_programs = "$program_name, ";
							}							
						} 
						$display_programs = rtrim($display_programs, ", ");
						echo "$display_programs";
						?>
						</td>
					</tr>
					<tr valign="top">
						<td><b>Network(s):</b></td>
    					<td colspan="2">
						<?php
						$display_networks = '';
						
						$query_networks = "SELECT * FROM p2erls_networks LEFT JOIN p2erls_network_sites USING (network_id) WHERE p2erls_network_sites.site_id = '$site_id' AND p2erls_network_sites.pending_change = 'No' AND p2erls_networks.pending_change = 'No' "; 
						$result_networks = mysql_query($query_networks);
						$num_results_networks = mysql_num_rows($result_networks);
						
						for ($i_networks=0; $i_networks <$num_results_networks; $i_networks++)
						{
							$network_id= mysql_result($result_networks,$i_networks,"network_id");
							$network_name= mysql_result($result_networks,$i_networks,"network_name");
							$network_url= mysql_result($result_networks,$i_networks,"network_url");
						
							if ($network_url != '')
							{
								$display_networks = "<a href='$network_url' target='_blank'>$network_name</a>, ";
							}
							else
							{
								$display_networks = "$network_name, ";
							}							
						} 
						$display_networks = rtrim($display_networks, ", ");
						echo "$display_networks";
						?>
						</td>
					</tr>
					<tr valign="top">
						<td><b>Gradient(s):</b></td>
    					<td colspan="2">
						<?php
						$display_gradients = '';
						
						$query_gradients = "SELECT * FROM p2erls_gradients LEFT JOIN p2erls_site_gradient USING (gradient_id) WHERE p2erls_site_gradient.site_id = '$site_id' AND p2erls_site_gradient.pending_change = 'No' AND p2erls_gradients.pending_change = 'No'"; 
						$result_gradients = mysql_query($query_gradients);
						$num_results_gradients = mysql_num_rows($result_gradients);
						
						for ($i_gradients=0; $i_gradients <$num_results_gradients; $i_gradients++)
						{
							$gradient_id= mysql_result($result_gradients,$i_gradients,"gradient_id");
							$gradient_name= mysql_result($result_gradients,$i_gradients,"gradient_name");
						
							echo "$gradient_name, ";
						}
						$display_gradients = rtrim($display_gradients, ", ");
						echo "$display_gradients";
						?>
						</td>
					</tr>
					<tr valign="top">
						<td colspan="3"><b>Landowner(s):</b>
    					<?php
						$display_landowners = '';
						
						$query_landowners = "SELECT * FROM p2erls_landowners LEFT JOIN p2erls_site_landowner USING (landowner_id) WHERE p2erls_site_landowner.site_id = '$site_id' AND p2erls_site_landowner.pending_change = 'No' AND p2erls_landowners.pending_change = 'No'"; 
						$result_landowners = mysql_query($query_landowners);
						$num_results_landowners = mysql_num_rows($result_landowners);
						
						for ($i_landowners=0; $i_landowners <$num_results_landowners; $i_landowners++)
						{
							$landowner_id= mysql_result($result_landowners,$i_landowners,"landowner_id");
							$landowner_name= mysql_result($result_landowners,$i_landowners,"landowner_name");
							$landowner_url= mysql_result($result_landowners,$i_landowners,"landowner_url");
						
							if ($landowner_url != '')
							{
								$display_landowners = "<a href='$landowner_url' target='_blank'>$landowner_name</a>, ";
							}
							else
							{
								$display_landowners = "$landowner_name, ";
							}							
						} 
						$display_landowners = rtrim($display_landowners, ", ");
						echo "$display_landowners";
						?>
						</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
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
