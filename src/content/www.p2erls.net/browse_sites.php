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

<script type="text/javascript" language="javascript" src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAASnpDFqD4bcXj7kSd5IwZJxRBJaH5kVAE2FIAMXg-zOHkL3oC4RRW82i7w-_PrOPd-JZIfuDcMy0aEA"></script>
<script type="text/javascript" language="javascript" src="includes/map_functions2.js"></script>
<script type="text/javascript" language="javascript" src="includes/prototype.js"></script>
<script type="text/javascript" language="javascript" src="includes/effects.js"></script> 
<script type="text/javascript" language="javascript" src="includes/control.select_multiple.1.0.0.RC1.js"></script>
<script type="text/javascript" language="javascript" src="/web/restricted/includes/ajax_login.js"></script>
<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>

<style type="text/css">
@import url("includes/p2erls_styles.css");   
.style10 {font-size: 10px}
.style12 {color: #000000}
.style13 {
	font-size: 10px;
	font: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style17 {color: #006699}
.style18 {color: #0033FF}
.style19 {color:#0066FF}
/*.ctrDropDown
{
	width:400px;
	font-size:11px;

}
.ctrDropDownClick{
	font-size:11px;
	width:400px;

}
.plainDropDown{
	width:400px;
	font-size:11px;

}
*/
</style>
<style type="text/css">
		.narrow { width: 100px; }
                .container { width: 120px; overflow:hidden; }
	</style>


   <script src="/prototype1.js" type="text/javascript"></script> 
        <script src="/ie_fix.js" type="text/javascript"></script> 
	<script language="javascript" type="text/javascript">
          document.observe('dom:loaded', function() { new IEDropdown('select_multiple_gradients'); },false);
		  document.observe('dom:loaded', function() { new IEDropdown('select_multiple_networks'); }, false);
          document.observe('dom:loaded', function() { new IEDropdown('select_multiple_programs'); },false);
          document.observe('dom:loaded', function() { new IEDropdown('select_multiple_regions'); },false);
          document.observe('dom:loaded', function() { new IEDropdown('select_multiple_ecosystems'); },false);
          document.observe('dom:loaded', function() { new IEDropdown('select_multiple_sites'); },false);
	</script>



</head>

<body onload="load()";>
<table width="958" border="0" align="center" cellpadding="0" cellspacing="0"> 
	<? include("includes/login.php"); ?>
	<tr>
		<td align="left" valign="middle" class="header_medium" id="nav"><? include("includes/nav.php"); ?></td>
	</tr>
	<tr>
	  <td valign="top" style="background-image:url(images/footer11.jpg); background-repeat:repeat-y;  "> 
		<table width="1004" border="0" cellspacing="0" cellpadding="5">
			<tr align="left" valign="top">
				<td width="994" align="center" style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><table width="860" height="159" border="0">
                    <tr>
                      <td width="147" height="71" align="left" valign="top"><strong>Search By Keywords:</strong>
                        <a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a>
                        <table width="146" height="50" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr align="left">
                              <td width="146" height="35" halign="left" valign="top"><table width="96%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="10" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"></a></span></td>
                                    <td width="130" height="20" class="header_small"><input type="text" align="middle" size="20" name="search_term" id="search_term" />
                                        <br />                                    <input type="button" name="Button2" value="Submit Search Criteria" onclick="searchSiteCriteria('Search');" /></td>
                                  </tr>
                                </table>
                              <div align="center"></div>                              </td>
                            </tr>
                      </table></td>
                      <td width="152" height="71" align="left" valign="top">
                        
						
						
						
						
						<strong>Search by Criteria:</strong> 
						
						
<div id="select_networks_container" style="padding:4px;width:120px;height:40px; overflow : hidden;">
 <table width="65%" border="0" cellpadding="2" cellspacing="0">
  <tr>
<td width="9%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a></span></td>
                                <td width="91%" class="header_small">
		<select name="select4" id="select_multiple_networks" style="width: 100px;">
                                	  <option value="" selected="selected">All Networks</option>
                                  	  <option value="ACEIC">Atlantic Coast Environment Indicators Consortium</option>
                                      <option value="CALEON">California Ecological Observatory Network</option>
                                      <option value="EcoTrends">EcoTrends</option>
                                      <option value="GLEON">Global Lake Ecological Observatory Network</option>
                                      <option value="ILTER">International Long Term Ecological Research Network</option>
                                      <option value="LTER">Long Term Ecological Research Network</option>
                                      <option value="NEON">National Ecological Observatory Network</option>
                                      <option value="NERRS">The National Estuarine Research Reserve System</option>
                                      <option value="NPS">National Park Service (US Dept. of the Interior)</option>
                                      <option value="OBFS">Organization of Biological Field Stations</option>
                                      <option value="SageSTEP">Sagebrush Steppe Treatment Evaluation Project</option>
                                      <option value="TNC">The Nature Conservancy</option>
                                      <option value="UCNRS">University of California Natural Reserve System</option>
                                      <option value="UNESCO">UNESCO Man and Biosphere Reserves </option>
                                      <option value="USDA-ARS">USDA Agricultural Research Service (US Dept. of Agriculture)</option>
                                      <option value="USDA-FS">USDA Forest Service (US Dept. of Agriculture)</option>
                                      <option value="USDOE">US Department of Energy</option>
                                      <option value="USGS">US Geological Survey</option>
          </select>
								
								<a href="" class="white_small style19" id="select_multiple_gradients_open">Multiple</a></td>
                 </table>
                        </div>
                      <td width="125" align="left" valign="middle"><?
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_gradients = "SELECT * FROM p2erls_gradients WHERE pending_change = 'No' ORDER BY gradient_id ASC"; 
						$result_gradients = mysql_query($query_gradients);
						$num_results_gradients = mysql_num_rows($result_gradients);
						?>
					    <div id="select_gradients_container" class="container">
                          <table width="60%" height="46" border="0" cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="9%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a></span></td>
                              <td width="91%" class="header_small"><select name="select4" id="select_multiple_gradients" style="width: 100px;">
                                  <option value="" selected="selected">All Gradients</option>
                                  <?
								for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
								{
									$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
									$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
								?>
                                  <option value="<? echo"$gradient_id";?>"><? echo"$gradient_name";?></option>
                                  <? } ?>
                                </select>
                                <a href="" class="white_small style18" id="select_multiple_gradients_open">Multiple</a></td>
                            </tr>
                          </table>
                          <div id="select_multiple_gradients_options" class="select_multiple_container" style="display:none;">
                          <div class="select_multiple_header">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                  <td width="237">Select Gradients</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input name="button4" type="button" id="select_multiple_gradients_close" value="Done" /></td>
                                </tr>
                              </table>
                            </div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
                              <?
									for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
									{
										$mod = $kk_gradients % 2;
										$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
										$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
								
									if($mod == 0) { ?>
                              <tr class="odd">
                                <? } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
                                <td align="left" class="select_multiple_name"><? echo "$gradient_name"; ?></td>
                                <td class="select_multiple_checkbox"><input name="checkbox4" type="checkbox" value="<? echo "$gradient_id"; ?>" /></td>
                              </tr>
                              <? } ?>
                            </table>
                          </div>
                      </div></td>
                      <td width="125" align="left" valign="middle">
                        <?
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_programs = "SELECT * FROM p2erls_programs WHERE pending_change = 'No' ORDER BY program_id ASC"; 
						$result_programs = mysql_query($query_programs);
						$num_results_programs = mysql_num_rows($result_programs);
						?>
                        <div id="select_programs_container" class="container">
                          <table width="67%" border="0" cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="9%" class="header_small"><span class="style10"></span><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a></span></td>
                              <td width="91%" class="header_small"><select name="select2" id="select_multiple_programs" style="width: 100px;">
                                  <option value="" selected="selected">All Programs</option>
                                  <?
								for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
								{
									$program_id= mysql_result($result_programs,$kk_programs,"program_id");
									$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
								?>
                                  <option value="<? echo"$program_id";?>"><? echo"$program_name";?></option>
                                  <? } ?>
                                </select>
                                <a href="" class="white_small" id="select_multiple_programs_open">Multiple</a></td>
                            </tr>
                          </table>
                          <div id="select_multiple_programs_options" class="select_multiple_container" style="display:none;">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Programs</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input name="button2" type="button" id="select_multiple_programs_close" value="Done" /></td>
                                </tr>
                              </table>
                            </div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
                              <?
									for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
									{
										$mod = $kk_programs % 2;
										$program_id= mysql_result($result_programs,$kk_programs,"program_id");
										$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
								
									if($mod == 0) { ?>
                              <tr class="odd">
                                <? } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
                                <td align="left" class="select_multiple_name"><? echo "$program_name"; ?></td>
                                <td class="select_multiple_checkbox"><input name="checkbox2" type="checkbox" value="<? echo "$program_id"; ?>" /></td>
                              </tr>
                              <? } ?>
                            </table>
                          </div>
                      </div></td>
                      <td width="146" align="left" valign="middle">
                        <?
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_regions = "SELECT * FROM p2erls_regions WHERE pending_change = 'No' ORDER BY region_id ASC"; 
						$result_regions = mysql_query($query_regions);
						$num_results_regions = mysql_num_rows($result_regions);
						?>
                        <div id="select_regions_container" class="container">
                          <table width="60%" height="34" border="0" cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="10%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a></span></td>
                              <td width="90%" class="header_small"><select name="select5" id="select_multiple_regions" style="width: 100px;">
                                  <option value="" selected="selected">All Regions</option>
                                  <?
								for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
								{
									$region_id= mysql_result($result_regions,$kk_regions,"region_id");
									$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
								?>
                                  <option value="<? echo"$region_id";?>"><? echo"$region_name";?></option>
                                  <? } ?>
                                </select>
                                <a href="" class="white_small" id="select_multiple_regions_open">Multiple</a></td>
                            </tr>
                          </table>
                          <div id="select_multiple_regions_options" class="select_multiple_container" style="display:none;">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Regions</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input name="button5" type="button" id="select_multiple_regions_close" value="Done" /></td>
                                </tr>
                              </table>
                            </div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
                              <?
									for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
									{
										$mod = $kk_regions % 2;
										$region_id= mysql_result($result_regions,$kk_regions,"region_id");
										$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
								
									if($mod == 0) { ?>
                              <tr class="odd">
                                <? } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
                                <td align="left" class="select_multiple_name"><? echo "$region_name"; ?></td>
                                <td class="select_multiple_checkbox"><input name="checkbox5" type="checkbox" value="<? echo "$region_id"; ?>" /></td>
                              </tr>
                              <? } ?>
                            </table>
                          </div>
                      </div></td>
                      <td width="175" align="left" valign="middle">
                        <?
						  require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE pending_change = 'No' ORDER BY ecosystem_id ASC"; 
						$result_ecosystems = mysql_query($query_ecosystems);
						$num_results_ecosystems = mysql_num_rows($result_ecosystems);
						?>
                        <div id="select_ecosystems_container" class="container">
                          <table width="58%" border="0" cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="9%" class="header_small"><span class="header_medium"><a href="about.php#glossary" target="_blank"><img src="images/help.gif" width="15" height="16" border="0" /></a></span></td>
                              <td width="91%" class="header_small"><select name="select6" id="select_multiple_ecosystems" style="width: 115px;">
                                  <option value="" selected="selected">All Ecosystems</option>
                                  <?
								for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
								{
									$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
									$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
								?>
                                  <option value="<? echo"$ecosystem_id";?>"><? echo"$ecosystem_name";?></option>
                                  <? } ?>
                                </select>
                                <a href="" class="white_small" id="select_multiple_ecosystems_open">Multiple</a></td>
                            </tr>
                          </table>
                          <div id="select_multiple_ecosystems_options" class="select_multiple_container" style="display:none;">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Ecosystems</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input name="button6" type="button" id="select_multiple_ecosystems_close" value="Done" /></td>
                                </tr>
                              </table>
                            </div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
                              <?
									for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
									{
										$mod = $kk_ecosystems % 2;
										$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
										$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
								
									if($mod == 0) { ?>
                              <tr class="odd">
                                <? } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
                                <td align="left" class="select_multiple_name"><? echo "$ecosystem_name"; ?></td>
                                <td class="select_multiple_checkbox"><input name="checkbox6" type="checkbox" value="<? echo "$ecosystem_id"; ?>" /></td>
                              </tr>
                              <? } ?>
                            </table>
                          </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td height="71" align="left" valign="top"><strong>Search By Site Name</strong>:<span class="style10">
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
	          			</script>
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
	          			  </script>
                      <?
						require ("restricted/Security_Dept/config.php");
						@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
						
						$query_sites = "SELECT * FROM p2erls_sites WHERE pending_change = 'No' ORDER BY site_name ASC"; 
						$result_sites = mysql_query($query_sites);
						$num_results_sites = mysql_num_rows($result_sites);
						?>
                      </span>
                        <div id="select_sites_container" class="container" style="width:155px;">
                          <table width="108%" height="49" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="2%" height="38" class="header_small"></td>
                              <td width="100%" class="header_small"><div align="justify">
                                  <select name="select" id="select_multiple_sites" style="width: 100px;">
                                    <option value="" selected="selected">All Sites</option>
                                    <?
								for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
								{
									$site_id= mysql_result($result_sites,$kk_sites,"site_id");
									$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
								?>
                                    <option value="<? echo"$site_id";?>"><? echo"$site_name";?></option>
                                    <? } ?>
                                  </select>
                                  <a href="" class="header_small style12" id="select_multiple_sites_open">Multiple</a>
                                  <input type="button" name="Button3" value="Submit Search Criteria" onclick="searchSiteCriteria('Sites');" />
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
                          </table>
                          <div id="select_multiple_sites_options" class="select_multiple_container" style="display:none;">
                          <div class="select_multiple_header">
                                <table width="%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td width="237">Select Sites</td>
                                <td width="53" align="right" style="padding-right:5px; "><div align="right">
                                <input name="button" type="button" id="select_multiple_sites_close" value="Done" />
                                </div></td>
                                </tr>
                                </table>
                           </div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="select_multiple_table">
                              <?
									for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
									{
										$mod = $kk_sites % 2;
										$site_id= mysql_result($result_sites,$kk_sites,"site_id");
										$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
								
									if($mod == 0) { ?>
                              <tr class="odd">
                                <? } if($mod != 0) { echo "</tr><tr class='even'>"; } ?>
                                <td align="left" class="select_multiple_name"><? echo "$site_name"; ?></td>
                                <td class="select_multiple_checkbox"><input name="checkbox" type="checkbox" value="<? echo "$site_id"; ?>" /></td>
                              </tr>
                              <? } ?>
                            </table>
                          </div>
                      </div></td><td align="left" valign="top"><span class="style13">Temperature(mean,&deg;C)</span>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="50%" class="header_small"><span class="style12">minimum</span><br />
                            <input name="site_temp_min" type="text" id="site_temp_min" size="5" /></td>
                            <td width="50%" class="header_small"><span class="style12">maximum</span><br />
                            <input name="site_temp_max" type="text" id="site_temp_max" size="5" /></td>
                          </tr>
                      </table></td>
                      <td align="left" valign="top"><span class="style13"><strong>Elevation ( m )</strong>:</span>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="50%" class="header_small"><span class="style12">minimum</span><br />
                            <input name="site_elev_min" type="text" id="site_elev_min" size="5" /></td>
                            <td width="50%" class="header_small"><span class="style12">maximum</span><br />
                            <input name="site_elev_max" type="text" id="site_elev_max" size="5" /></td>
                          </tr>
                      </table></td>
                      <td valign="top"><span class="style13">Precipitation(mean; cm)</span>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="50%" class="header_small"><span class="style12">minimum</span><br />
                            <input name="site_precip_min" type="text" id="site_precip_min" size="5" /></td>
                            <td width="50%" class="header_small"><span class="style12">maximum</span><br />
                            <input name="site_precip_max" type="text" id="site_precip_max" size="5" /></td>
                          </tr>
                      </table></td>
                      <td align="center" valign="bottom"><span class="header_small">
                        <span class="style12">Rows/Page</span>
                        <input name="site_length" type="text" id="site_length" value="50" size="5" />
                      </span>
                        <input type="button" name="Button4" value="Submit Search Criteria" onclick="searchSiteCriteria('Main');" />
                      <input type="button" name="Button7" value="Save Current Search" onclick="saveSearch('<? echo $_SESSION["p2erls_account_num"];?>');" /></td>
                    <td align="center" valign="bottom"><input type="button" name="Button5" value="Reset Search Criteria" onclick="clearSearchCriteria();" />                          <input type="button" name="Button6" value="Reset Map" onclick="mapReset();" />                      </td>
                    </tr>
                    
                  </table>
				  <div id="loadingMarkers"></div>
  <div id="map2">
                  <div id="map"></div>
                </div>				
                <br />
				<br />
			  <div id="searchSites"></div></td>
			</tr>&nbsp;
	    </table></td>
	</tr>
	<tr>
		<td id="footer" align="center"><? include("includes/footer.php"); ?></td>
	</tr>
</table>
<script type="text/javascript">
//<![CDATA[ 
	setTimeout("searchSiteCriteria('Main')",5000);
//]]>
</script>
</body>
</html>
