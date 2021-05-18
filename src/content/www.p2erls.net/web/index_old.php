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
<title>P2ERLS - Home - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAAigmhrOBEEzX8ecVtaVgiFhTsNdPTia7QLwn0AXR_2hbg_R98WhRFLwB3wH1z01MeSzPthRpUqcKHuA"></script>
<script type="text/javascript" language="javascript" src="includes/map_functions.js"></script>
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
        <td width="293" style="padding:15px; "><div align="center"><span class="header">Search Sites </span><br />
		        <br />
</div>
          <table width="223" border="0" cellspacing="0" cellpadding="6"> 
		           
		          <tr align="center">
		            <td colspan="2"><span class="header_medium">Programs</span></td>
              </tr>
		          <tr align="center">
		            <td colspan="2"><?php     
require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

     
$query_programs = "SELECT * FROM p2erls_programs WHERE pending_change = 'No' ORDER BY  program_id ASC"; 
$result_programs = mysql_query($query_programs);
$num_results_programs = mysql_num_rows($result_programs);
?>
              <div id="select_programs_container">
                <select id="select_multiple_programs" width="175" style="width: 175px;">
                  <option value="" selected="selected">All</option>
                  <?php
for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
{
  	$program_id= mysql_result($result_programs,$kk_programs,"program_id");
	$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
?>
                  <option value="<?php echo"$program_id";?>"><?php echo"$program_name";?></option>
                  <?php } ?>
                </select>
                <a href="" class="white_small" id="select_multiple_programs_open" >Multiple</a>
                <div style="display:none;" id="select_multiple_programs_options" class="select_multiple_container">
                  <div class="select_multiple_header">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="237">Select Sites</td>
                        <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_programs_close"/></td>
                      </tr>
                    </table>
                  </div>
                  <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                    <?php
for ($kk_programs=0; $kk_programs <$num_results_programs; $kk_programs++)
{
	$mod = $kk_programs % 2;
  	$program_id= mysql_result($result_programs,$kk_programs,"program_id");
	$program_name= mysql_result($result_programs,$kk_programs,"program_name");		
?>
                    <?php if($mod=='0'){?>
                    <tr class="odd">
                      <?php } ?>
                      <?php if($mod!='0'){?>
                    </tr>
                    <tr class="even">
                      <?php } ?>
                      <td class="select_multiple_name"><?php echo"$program_name";?></td>
                      <td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo"$program_id";?>"/></td>
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
		          
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Networks</span></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><?php      
     
$query_networks = "SELECT * FROM p2erls_networks  WHERE pending_change = 'No' ORDER BY network_id ASC"; 
$result_networks = mysql_query($query_networks);
$num_results_networks = mysql_num_rows($result_networks);
?>
                        <div id="select_networks_container">
                          <select id="select_multiple_networks" width="175" style="width: 175px;">
                            <option value="" selected="selected">All</option>
                            <?php
for ($kk_networks=0; $kk_networks <$num_results_networks; $kk_networks++)
{
  	$network_id= mysql_result($result_networks,$kk_networks,"network_id");
	$network_name= mysql_result($result_networks,$kk_networks,"network_name");		
?>
                            <option value="<?php echo"$network_id";?>"><?php echo"$network_name";?></option>
                            <?php } ?>
                          </select>
                          <a href="" class="white_small" id="select_multiple_networks_open" >Multiple</a>
                          <div style="display:none;" id="select_multiple_networks_options" class="select_multiple_container">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Sites</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_networks_close"/></td>
                                </tr>
                              </table>
                            </div>
                            <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                              <?php
for ($kk_networks=0; $kk_networks <$num_results_networks; $kk_networks++)
{
	$mod = $kk_networks % 2;
  	$network_id= mysql_result($result_networks,$kk_networks,"network_id");
	$network_name= mysql_result($result_networks,$kk_networks,"network_name");		
?>
                              <?php if($mod=='0'){?>
                              <tr class="odd">
                                <?php } ?>
                                <?php if($mod!='0'){?>
                              </tr>
                              <tr class="even">
                                <?php } ?>
                                <td class="select_multiple_name"><?php echo"$network_name";?></td>
                                <td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo"$network_id";?>"/></td>
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
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Gradients</span></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><?php   
     
$query_gradients = "SELECT * FROM p2erls_gradients WHERE pending_change = 'No' ORDER BY gradient_id ASC"; 
$result_gradients = mysql_query($query_gradients);
$num_results_gradients = mysql_num_rows($result_gradients);
?>
                        <div id="select_gradients_container">
                          <select id="select_multiple_gradients" width="175" style="width: 175px;">
                            <option value="" selected="selected">All</option>
                            <?php
for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
{
  	$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
	$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
?>
                            <option value="<?php echo"$gradient_id";?>"><?php echo"$gradient_name";?></option>
                            <?php } ?>
                          </select>
                          <a href="" class="white_small" id="select_multiple_gradients_open" >Multiple</a>
                          <div style="display:none;" id="select_multiple_gradients_options" class="select_multiple_container">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Sites</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_gradients_close"/></td>
                                </tr>
                              </table>
                            </div>
                            <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                              <?php
for ($kk_gradients=0; $kk_gradients <$num_results_gradients; $kk_gradients++)
{
	$mod = $kk_gradients % 2;
  	$gradient_id= mysql_result($result_gradients,$kk_gradients,"gradient_id");
	$gradient_name= mysql_result($result_gradients,$kk_gradients,"gradient_name");		
?>
                              <?php if($mod=='0'){?>
                              <tr class="odd">
                                <?php } ?>
                                <?php if($mod!='0'){?>
                              </tr>
                              <tr class="even">
                                <?php } ?>
                                <td class="select_multiple_name"><?php echo"$gradient_name";?></td>
                                <td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo"$gradient_id";?>"/></td>
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
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Regions</span></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><?php      
     
$query_regions = "SELECT * FROM p2erls_regions WHERE pending_change = 'No' ORDER BY region_id ASC"; 
$result_regions = mysql_query($query_regions);
$num_results_regions = mysql_num_rows($result_regions);
?>
                        <div id="select_regions_container">
                          <select id="select_multiple_regions" width="175" style="width: 175px;">
                            <option value="" selected="selected">All</option>
                            <?php
for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
{
  	$region_id= mysql_result($result_regions,$kk_regions,"region_id");
	$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
?>
                            <option value="<?php echo"$region_id";?>"><?php echo"$region_name";?></option>
                            <?php } ?>
                          </select>
                          <a href="" class="white_small" id="select_multiple_regions_open" >Multiple</a>
                          <div style="display:none;" id="select_multiple_regions_options" class="select_multiple_container">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Sites</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_regions_close"/></td>
                                </tr>
                              </table>
                            </div>
                            <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                              <?php
for ($kk_regions=0; $kk_regions <$num_results_regions; $kk_regions++)
{
	$mod = $kk_regions % 2;
  	$region_id= mysql_result($result_regions,$kk_regions,"region_id");
	$region_name= mysql_result($result_regions,$kk_regions,"region_name");		
?>
                              <?php if($mod=='0'){?>
                              <tr class="odd">
                                <?php } ?>
                                <?php if($mod!='0'){?>
                              </tr>
                              <tr class="even">
                                <?php } ?>
                                <td class="select_multiple_name"><?php echo"$region_name";?></td>
                                <td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo"$region_id";?>"/></td>
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
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Ecosystems</span></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><?php      
					
$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE pending_change = 'No' ORDER BY ecosystem_id ASC"; 
$result_ecosystems = mysql_query($query_ecosystems);
$num_results_ecosystems = mysql_num_rows($result_ecosystems);
?>
                        <div id="select_ecosystems_container">
                          <select id="select_multiple_ecosystems" width="175" style="width: 175px;">
                            <option value="" selected="selected">All</option>
                            <?php
for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
{
  	$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
	$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
?>
                            <option value="<?php echo"$ecosystem_id";?>"><?php echo"$ecosystem_name";?></option>
                            <?php } ?>
                          </select>
                          <a href="" class="white_small" id="select_multiple_ecosystems_open" >Multiple</a>
                          <div style="display:none;" id="select_multiple_ecosystems_options" class="select_multiple_container">
                            <div class="select_multiple_header">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="237">Select Sites</td>
                                  <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_ecosystems_close"/></td>
                                </tr>
                              </table>
                            </div>
                            <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                              <?php
for ($kk_ecosystems=0; $kk_ecosystems <$num_results_ecosystems; $kk_ecosystems++)
{
	$mod = $kk_ecosystems % 2;
  	$ecosystem_id= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_id");
	$ecosystem_name= mysql_result($result_ecosystems,$kk_ecosystems,"ecosystem_name");		
?>
                              <?php if($mod=='0'){?>
                              <tr class="odd">
                                <?php } ?>
                                <?php if($mod!='0'){?>
                              </tr>
                              <tr class="even">
                                <?php } ?>
                                <td class="select_multiple_name"><?php echo"$ecosystem_name";?></td>
                                <td class="select_multiple_checkbox"><input type="checkbox" id="eco_<?php echo"$ecosystem_id";?>" value="<?php echo"$ecosystem_id";?>"/></td>
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
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Elevation Low </span></td>
                  </tr>
		          <tr align="center" valign="top">
		            <td width="89" class="header_small">min<br />
		              <input name="site_elevlow_min" type="text" id="site_elevlow_min" size="10" /></td>
              <td width="121" class="header_small"> max<br />
                <input name="site_elevlow_max" type="text" id="site_elevlow_max" size="10" /></td>
	          </tr>
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Elevation High </span></td>
                  </tr>
		          <tr align="center" valign="top">
                    <td class="header_small">min<br />
                        <input name="site_elevhigh_min" type="text" id="site_elevhigh_min" size="10" /></td>
                    <td class="header_small"> max<br />
                        <input name="site_elevhigh_max" type="text" id="site_elevhigh_max" size="10" /></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Temp </span></td>
                  </tr>
		          <tr align="center" valign="top">
                    <td class="header_small">min<br />
                        <input name="site_temp_min" type="text" id="site_temp_min" size="10" /></td>
                    <td class="header_small"> max<br />
                        <input name="site_temp_max" type="text" id="site_temp_max" size="10" /></td>
              </tr>
		          <tr align="center">
                    <td colspan="2"><span class="header_medium">Precip</span></td>
                  </tr>
		          <tr align="center" valign="top">
                    <td class="header_small">min<br />
                        <input name="site_precip_min" type="text" id="site_precip_min" size="10" /></td>
                    <td class="header_small"> max<br />
                        <input name="site_precip_max" type="text" id="site_precip_max" size="10" /></td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                 
                  <tr align="center">
                    <td colspan="2" style="border-top:solid 1px #ffffff; ">&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td colspan="2"><a href="javascript:searchSiteCriteria('Main');"><b><font color="#FFFFFF" size="4">Search By Criteria</font></b></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td colspan="2" style="border-top:solid 1px #ffffff; ">&nbsp;</td>
                  </tr> 
                  <tr align="center">
                    <td colspan="2"><a href="javascript:mapReset();" class="white_small">Reset Map</a> - <a href="javascript:saveSearch('<?php echo $_SESSION["p2erls_account_num"];?>');" class="white_small" >Save Current Search</a></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div id="showSavedSearches"></div></td>
                  </tr>
				  
            </table>
	         
	      <br /></td>
        <td style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><div id="loadingMarkers"></div><div id="map2">
          <div id="map"></div>
        </div>          <br><br />
  <div id="searchSites"></div>
</td></tr>
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
