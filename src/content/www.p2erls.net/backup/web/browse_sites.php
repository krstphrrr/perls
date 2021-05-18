<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

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

<head>
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
<title>P2ERLS - Pole to Pole Ecological Research Lattice of Sites - Browse Sites</title>

<script type="text/javascript" language="javascript" src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAASnpDFqD4bcXj7kSd5IwZJxSg_bSw2ZBeZv1bhlLR_60LiO2fChQpvUW_pJ_OLW4j5X0aOCD9z78byA"></script>
<script type="text/javascript" language="javascript" src="includes/map_functions2.js"></script>
<script type="text/javascript" language="javascript" src="includes/prototype.js"></script>
<script type="text/javascript" language="javascript" src="includes/effects.js"></script> 
<script type="text/javascript" language="javascript" src="includes/control.select_multiple.1.0.0.RC1.js"></script>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/restricted/includes/ajax_login.js"></script>
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
		<td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "> 
		<table width="988" border="0" cellspacing="0" cellpadding="5">
			<tr align="left" valign="top">
				<td width="293" style="padding:15px;"><div class="header">By Keywords:</div>
				<table width="223" align="center" border="0" cellspacing="0" cellpadding="6">
					<tr align="center">
						<td><table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="16%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="84%" class="header_small"><input type="text" size="20" name="search_term" id="search_term" /><br /> </td>
                          </tr>
                        </table>
					  <div align="center">&nbsp;&nbsp;<input type="button" name="Button" value="Submit Search Criteria" onclick="searchSiteCriteria('Search');" /></div></td></tr>
				</table> 
				<hr width="223" color="#FFFFFF" /> 
				<div class="header">Search By Site Name:</div>
				<table width="223" align="center" border="0" cellspacing="0" cellpadding="6">
					<!-- Begin Sites criteria -->
					<tr align="center">
						<td>
						<?php
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_sites = "SELECT * FROM p2erls_sites WHERE pending_change = 'No' ORDER BY site_name ASC"; 
						$result_sites = mysql_query($query_sites);
						$num_results_sites = mysql_num_rows($result_sites);
						?>
						
						<div id="select_sites_container" class="select_multiple_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_sites" style="width: 130px;">
								<option value="" selected="selected">All Sites</option>
                  				<?php
								for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
								{
									$site_id= mysql_result($result_sites,$kk_sites,"site_id");
									$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
								?>
                  				<option value="<?php echo"$site_id";?>"><?php echo"$site_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_sites_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_sites_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Sites</td>
											<td width="53" align="right" style="padding-right:5px; "><div align="right">
											  <input type="button" value="Done" id="select_multiple_sites_close" />
										    </div></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
									{
										$mod = $kk_sites % 2;
										$site_id= mysql_result($result_sites,$kk_sites,"site_id");
										$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$site_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$site_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_sites = new Control.SelectMultiple('select_multiple_sites','select_multiple_sites_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_sites && select_multiple_sites.setSelectedRows)
									select_multiple_sites.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_sites.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_sites);
						select_multiple_sites.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_sites.setSelectedRows);
						});
						select_multiple_sites.setSelectedRows();
						
						//link open and closing
						$('select_multiple_sites_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_sites));
						$('select_multiple_sites_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_sites));		
	          			</script></td>
              		</tr>
					<tr>
						<td align="center"><input type="button" name="Button" value="Submit Search Criteria" onclick="searchSiteCriteria('Sites');" /></td>
					</tr>
		          	<!-- End Sites criteria -->
				</table>
  				<hr width="223" color="#FFFFFF" />
				<div class="header">Search By Criteria:</div>
				<table width="223" align="center" border="0" cellspacing="0" cellpadding="6">
					<!-- Begin Programs criteria -->
					<tr align="center">
						<td colspan="2">
						<?php
						$query_programs = "SELECT * FROM p2erls_programs WHERE pending_change = 'No' ORDER BY program_id ASC"; 
						$result_programs = mysql_query($query_programs);
						$num_results_programs = mysql_num_rows($result_programs);
						?>
						
						<div id="select_programs_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_programs" style="width: 130px;">
								<option value="" selected="selected">All Programs</option>
                  				<?php
								for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
								{
									$program_id= mysql_result($result_programs,$kk_programs,"program_id");
									$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
								?>
                  				<option value="<?php echo"$program_id";?>"><?php echo"$program_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_programs_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_programs_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Programs</td>
											<td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_programs_close" /></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
									{
										$mod = $kk_programs % 2;
										$program_id= mysql_result($result_programs,$kk_programs,"program_id");
										$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$program_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$program_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_programs = new Control.SelectMultiple('select_multiple_programs','select_multiple_programs_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_programs && select_multiple_programs.setSelectedRows)
									select_multiple_programs.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_programs.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_programs);
						select_multiple_programs.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_programs.setSelectedRows);
						});
						select_multiple_programs.setSelectedRows();
						
						//link open and closing
						$('select_multiple_programs_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_programs));
						$('select_multiple_programs_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_programs));		
	          			</script></td>
              		</tr>
		          	<!-- End Programs criteria -->
					
					<!-- Begin Networks criteria -->
					<tr align="center">
						<td colspan="2">
						<?php
						$query_networks = "SELECT * FROM p2erls_networks WHERE pending_change = 'No' ORDER BY network_id ASC"; 
						$result_networks = mysql_query($query_networks);
						$num_results_networks = mysql_num_rows($result_networks);
						?>
						
						<div id="select_networks_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_networks" style="width: 130px;">
								<option value="" selected="selected">All Networks</option>
                  				<?php
								for ($kk_networks=0; $kk_networks <$num_results_networks; $kk_networks++)
								{
									$network_id= mysql_result($result_networks,$kk_networks,"network_id");
									$network_name= mysql_result($result_networks,$kk_networks,"network_name");		
								?>
                  				<option value="<?php echo"$network_id";?>"><?php echo"$network_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_networks_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_networks_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Networks</td>
											<td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_networks_close" /></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_networks=0; $kk_networks <$num_results_networks; $kk_networks++)
									{
										$mod = $kk_networks % 2;
										$network_id= mysql_result($result_networks,$kk_networks,"network_id");
										$network_name= mysql_result($result_networks,$kk_networks,"network_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$network_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$network_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_networks = new Control.SelectMultiple('select_multiple_networks','select_multiple_networks_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_networks && select_multiple_networks.setSelectedRows)
									select_multiple_networks.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_networks.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_networks);
						select_multiple_networks.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_networks.setSelectedRows);
						});
						select_multiple_networks.setSelectedRows();
						
						//link open and closing
						$('select_multiple_networks_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_networks));
						$('select_multiple_networks_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_networks));		
	          			</script></td>
              		</tr>
		          	<!-- End Networks criteria -->
					
					<!-- Begin Gradients criteria -->
					<tr align="center">
						<td colspan="2">
						<?php
						$query_gradients = "SELECT * FROM p2erls_gradients WHERE pending_change = 'No' ORDER BY gradient_id ASC"; 
						$result_gradients = mysql_query($query_gradients);
						$num_results_gradients = mysql_num_rows($result_gradients);
						?>
						
						<div id="select_gradients_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_gradients" style="width: 130px;">
								<option value="" selected="selected">All Gradients</option>
                  				<?php
								for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
								{
									$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
									$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
								?>
                  				<option value="<?php echo"$gradient_id";?>"><?php echo"$gradient_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_gradients_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_gradients_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Gradients</td>
											<td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_gradients_close" /></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
									{
										$mod = $kk_gradients % 2;
										$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
										$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$gradient_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$gradient_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_gradients = new Control.SelectMultiple('select_multiple_gradients','select_multiple_gradients_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_gradients && select_multiple_gradients.setSelectedRows)
									select_multiple_gradients.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_gradients.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_gradients);
						select_multiple_gradients.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_gradients.setSelectedRows);
						});
						select_multiple_gradients.setSelectedRows();
						
						//link open and closing
						$('select_multiple_gradients_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_gradients));
						$('select_multiple_gradients_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_gradients));		
	          			</script></td>
              		</tr>
		          	<!-- End Gradients criteria -->
					
					<!-- Begin Regions criteria -->
					<tr align="center">
						<td colspan="2">
						<?php
						$query_regions = "SELECT * FROM p2erls_regions WHERE pending_change = 'No' ORDER BY region_id ASC"; 
						$result_regions = mysql_query($query_regions);
						$num_results_regions = mysql_num_rows($result_regions);
						?>
						
						<div id="select_regions_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_regions" style="width: 130px;">
								<option value="" selected="selected">All Regions</option>
                  				<?php
								for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
								{
									$region_id= mysql_result($result_regions,$kk_regions,"region_id");
									$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
								?>
                  				<option value="<?php echo"$region_id";?>"><?php echo"$region_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_regions_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_regions_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Regions</td>
											<td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_regions_close" /></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
									{
										$mod = $kk_regions % 2;
										$region_id= mysql_result($result_regions,$kk_regions,"region_id");
										$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$region_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$region_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_regions = new Control.SelectMultiple('select_multiple_regions','select_multiple_regions_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_regions && select_multiple_regions.setSelectedRows)
									select_multiple_regions.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_regions.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_regions);
						select_multiple_regions.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_regions.setSelectedRows);
						});
						select_multiple_regions.setSelectedRows();
						
						//link open and closing
						$('select_multiple_regions_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_regions));
						$('select_multiple_regions_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_regions));		
	          			</script></td>
              		</tr>
		          	<!-- End Regions criteria -->
					
					<!-- Begin Ecosystems criteria -->
					<tr align="center">
						<td colspan="2">
						<?php
						$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE pending_change = 'No' ORDER BY ecosystem_id ASC"; 
						$result_ecosystems = mysql_query($query_ecosystems);
						$num_results_ecosystems = mysql_num_rows($result_ecosystems);
						?>
						
						<div id="select_ecosystems_container">
							<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="14%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="25" height="26" border="0" /></a></span></td>
                            <td width="86%" class="header_small">
							<select id="select_multiple_ecosystems" style="width: 130px;">
								<option value="" selected="selected">All Ecosystems</option>
                  				<?php
								for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
								{
									$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
									$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
								?>
                  				<option value="<?php echo"$ecosystem_id";?>"><?php echo"$ecosystem_name";?></option>
                  				<?php } ?>
							</select>
							<a href="" class="white_small" id="select_multiple_ecosystems_open">Multiple</a></td>
                          </tr>
                        </table>						  
							<div id="select_multiple_ecosystems_options" class="select_multiple_container" style="display:none;">
								<div class="select_multiple_header">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="237">Select Ecosystems</td>
											<td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_ecosystems_close" /></td>
										</tr>
									</table>
								</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
									<?php
									for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
									{
										$mod = $kk_ecosystems % 2;
										$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
										$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
								
									if($mod == 0) { ?><tr class="odd"><?php } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
										<td align="left" class="select_multiple_name"><?php echo "$ecosystem_name"; ?></td>
										<td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo "$ecosystem_id"; ?>" /></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					  <script type="text/javascript">
						var select_multiple_ecosystems = new Control.SelectMultiple('select_multiple_ecosystems','select_multiple_ecosystems_options',{
							checkboxSelector: 'table.select_multiple_table tr td input[type=checkbox]',
							nameSelector: 'table.select_multiple_table tr td.select_multiple_name',
							afterChange: function(){
								if(select_multiple_ecosystems && select_multiple_ecosystems.setSelectedRows)
									select_multiple_ecosystems.setSelectedRows();
							}
						});
						
						//adds and removes highlighting from table rows
						select_multiple_ecosystems.setSelectedRows = function(){
							this.checkboxes.each(function(checkbox){
								var tr = $(checkbox.parentNode.parentNode);
								tr.removeClassName('selected');
								if(checkbox.checked)
									tr.addClassName('selected');
							});
						}.bind(select_multiple_ecosystems);
						select_multiple_ecosystems.checkboxes.each(function(checkbox){
							$(checkbox).observe('click',select_multiple_ecosystems.setSelectedRows);
						});
						select_multiple_ecosystems.setSelectedRows();
						
						//link open and closing
						$('select_multiple_ecosystems_open').observe('click',function(event){
							$(this.select).style.visibility = 'hidden';			 
							new Effect.BlindDown(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_ecosystems));
						$('select_multiple_ecosystems_close').observe('click',function(event){
							$(this.select).style.visibility = 'visible';
							new Effect.BlindUp(this.container,{
								duration: 0.3
							});
							Event.stop(event);
							return false;
						}.bindAsEventListener(select_multiple_ecosystems));		
	          			</script></td>
              		</tr>
		          	<!-- End Ecosystems criteria -->
					
					<tr align="center">
						<td colspan="2"><table width="59%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="16%" class="header_small"></td>
                            <td width="84%" class="header_small"><span class="header_medium">Elevation (m)</span> </td>
                          </tr>
                        </table>						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
							<tr>
								<td width="50%" class="header_small">minimum<br />
                        		<input name="site_elev_min" type="text" id="site_elev_min" size="10" /></td>
								<td width="50%" class="header_small">maximum<br />
                        		<input name="site_elev_max" type="text" id="site_elev_max" size="10" /></td>
							</tr>
					  </table></td>
					</tr>					
					<tr align="center">
						<td colspan="2"><table width="76%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="16%" class="header_small"></td>
                            <td width="84%" class="header_small"><span class="header_medium">Temperature (mean annual; &deg;C )</span> </td>
                          </tr>
                        </table>						  
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
							<tr>
								<td width="50%" class="header_small">minimum<br />
                        		<input name="site_temp_min" type="text" id="site_temp_min" size="10" /></td>
								<td width="50%" class="header_small">maximum<br />
                        		<input name="site_temp_max" type="text" id="site_temp_max" size="10" /></td>
							</tr>
					  </table></td>
					</tr>
					<tr align="center">
						<td colspan="2"><table width="71%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="16%" class="header_small"></td>
                            <td width="84%" class="header_small"><span class="header_medium">Precipitation (mean annual; cm)</span></td>
                          </tr>
                        </table>						  
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
							<tr>
								<td width="50%" class="header_small">minimum<br />
                        		<input name="site_precip_min" type="text" id="site_precip_min" size="10" /></td>
								<td width="50%" class="header_small">maximum<br />
                        		<input name="site_precip_max" type="text" id="site_precip_max" size="10" /></td>
							</tr>
					  </table></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="button" name="Button" value="Submit Search Criteria" onclick="searchSiteCriteria('Main');" /><br />
						<input type="button" name="Button" value="Reset Search Criteria" onclick="clearSearchCriteria();" /></td>
					</tr>				  
            	</table>
  				<hr width="223" color="#FFFFFF" />
				<table width="223" align="center" border="0" cellspacing="0" cellpadding="6">
					<!-- Begin Sites criteria -->
					<tr align="center">
						<td><input type="button" name="Button" value="Reset Map" onclick="mapReset();" /><br />
						<input type="button" name="Button" value="Save Current Search" onclick="saveSearch('<?php echo $_SESSION["p2erls_account_num"];?>');" /></td>
					</tr>
				</table>
  				<hr width="223" color="#FFFFFF" />
				<table width="223" align="center" border="0" cellspacing="0" cellpadding="6">
					<tr>
						<td><div id="showSavedSearches"></div></td>
					</tr>
				</table>
				</td>
				<td style="padding-right:20px;padding-top:10px;padding-bottom:10px;">
				<div id="loadingMarkers"></div>
  <div id="map2">
                  <div id="map"></div>
                </div>				
                <br />
				<br />
				<div id="searchSites"></div></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
	</tr>
</table>
<script type="text/javascript">
//<![CDATA[ 
	setTimeout("searchSiteCriteria('Main')",5000);
//]]>
</script>
</body>
</html>
