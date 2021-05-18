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
<title>P2ERLS - Sites - Pole to Pole Ecological Research Lattice of Sites</title>
<script type="text/javascript" language="javascript" src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAASnpDFqD4bcXj7kSd5IwZJxRBJaH5kVAE2FIAMXg-zOHkL3oC4RRW82i7w-_PrOPd-JZIfuDcMy0aEA"></script>
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

<body onload="load()">
<table width="988" border="0" align="center" cellpadding="0" cellspacing="0"> 
  <?php include("includes/login.php"); ?>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;  "> 
    <table width="988" border="0" cellspacing="0" cellpadding="5">
      <tr align="left" valign="top">
        <td width="293" style="padding:15px; "><div align="center"></div>
          <div align="center"><span class="header">Search By Site Name</span><br />
              <br />
              <?php     
require ("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

     
$query_sites = "SELECT * FROM p2erls_sites WHERE pending_change = 'No' ORDER BY site_id ASC"; 
$result_sites = mysql_query($query_sites);
$num_results_sites = mysql_num_rows($result_sites);
?>
              <div id="select_sites_container">
                <select id="select_multiple_sites" width="175" style="width: 175px;">
                  <option value="" selected="selected">All</option>
                  <?php
for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
{
  	$site_id= mysql_result($result_sites,$kk_sites,"site_id");
	$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
?>
                  <option value="<?php echo"$site_id";?>"><?php echo"$site_name";?></option>
                  <?php } ?>
                </select>
                <a href="" class="white_small" id="select_multiple_sites_open" >Multiple</a>
                <div style="display:none;" id="select_multiple_sites_options" class="select_multiple_container">
                  <div class="select_multiple_header">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="237">Select Sites</td>
                        <td width="53" align="right" style="padding-right:5px; "><input type="button" value="Done" id="select_multiple_sites_close"/></td>
                      </tr>
                    </table>
                  </div>
                  <table cellspacing="0" cellpadding="0" class="select_multiple_table" width="100%">
                    <?php
for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
{
	$mod = $kk_sites % 2;
  	$site_id= mysql_result($result_sites,$kk_sites,"site_id");
	$site_name= mysql_result($result_sites,$kk_sites,"site_name");		
?>
                    <?php if($mod=='0'){?>
                    <tr class="odd">
                      <?php } ?>
                      <?php if($mod!='0'){?>
                    </tr>
                    <tr class="even">
                      <?php } ?>
                      <td class="select_multiple_name"><?php echo"$site_name";?></td>
                      <td class="select_multiple_checkbox"><input type="checkbox" value="<?php echo"$site_id";?>"/></td>
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
	          </script>
          </div>
          <br />
          <br />
          <table width="223" border="0" cellspacing="0" cellpadding="6">
            <tr align="center">
              <td width="210" style="border-top:solid 1px #ffffff; "><a href="javascript:searchSiteCriteria('Sites');"><b><font color="#FFFFFF" size="4">Search By Sites</font></b></a></td>
            </tr>
          </table>
          <br /></td>
        <td style="padding-right:20px;padding-top:10px;padding-bottom:10px;"><div id="loadingMarkers"></div><div id="map2">
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
 <script type="text/javascript">
   //<![CDATA[ 
//setTimeout("searchSiteCriteria('Sites')",5000);
//]]>
</script>
</body>
</html>
