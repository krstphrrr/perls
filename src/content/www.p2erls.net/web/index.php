<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();

include("restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
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
<title>P2ERLS - Pole to Pole Ecological Research Lattice of Sites - Home</title>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/restricted/includes/ajax_login.js"></script>

<style type="text/css">
<!--
@import url("includes/p2erls_styles.css");  
-->
</style> 
</head>

<body>
<table width="1008" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include("includes/login.php"); ?>
  <tr>
    <td align="left" valign="middle" class="header_medium" id="nav"><?php include("includes/nav.php"); ?></td>
  </tr>
  <tr>
    <td valign="top" style="background-image:url(images/bg_repeat.jpg); background-repeat:repeat-y;"><table width="988" border="0" cellspacing="0" cellpadding="5">
        <tr align="left" valign="top">
          <td width="255"> <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
		 	<tr>
				<td><span class="header">Links to Selected Networks </span></td>
			</tr>
			<tr>
				<td><span class="header_medium">US - National</span></td>
			</tr>
              <?php
		
		// Display all the data from the table
			$query_links = "SELECT * FROM p2erls_links WHERE link_homepg = 'Yes' AND link_cat = 'U.S. National' ORDER BY link_name ASC";
			$result_links = mysql_query($query_links);
			$num_results_links = mysql_num_rows($result_links);
			
			for ($i_links = 0; $i_links < $num_results_links; $i_links++) 
			{
				$link_id	= mysql_result($result_links,$i_links,"link_id"); 
				$link_name	= mysql_result($result_links,$i_links,"link_name");
				$link_url	= mysql_result($result_links,$i_links,"link_url");
				 ?>
              <tr align="left" valign="top">
                <td><a href="<?php echo "$link_url"; ?>" target="_blank" class="white_small"><?php echo "$link_name"; ?> &raquo;</a></td>
              </tr>
              <?php } ?>
          </table>
		  <br />
		  <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
		 	<tr>
				<td><span class="header_medium">International</span></td>
			</tr>
              <?php
		
		// Display all the data from the table
			$query_links = "SELECT * FROM p2erls_links WHERE link_homepg = 'Yes' AND link_cat = 'International' ORDER BY link_name ASC";
			$result_links = mysql_query($query_links);
			$num_results_links = mysql_num_rows($result_links);
			
			for ($i_links = 0; $i_links < $num_results_links; $i_links++) 
			{
				$link_id	= mysql_result($result_links,$i_links,"link_id"); 
				$link_name	= mysql_result($result_links,$i_links,"link_name");
				$link_url	= mysql_result($result_links,$i_links,"link_url");
				 ?>
              <tr align="left" valign="top">
                <td><a href="<?php echo "$link_url"; ?>" target="_blank" class="white_small"><?php echo "$link_name"; ?> &raquo;</a></td>
              </tr>
              <?php } ?>
			  <tr>
			  	<td>
				<br />
				<span class="header_medium" s><a href="links.php" class="white">More Networks &raquo;</a></span>
				</td>
			</tr>
          </table>
		  <br />
		  
		  </td>
          <td width="713" valign="top"><h2 align="center">Welcome to the Pole-to-Pole Ecological Research Lattice of Sites (P<sup>2</sup>ERLS)!</h2>
              <div align="justify" style="padding-right:20px;">
                <div>
                  <p>P<sup>2</sup>ERLS (pronounced "pearls") is a portal that facilitates easy access to information about ecological research sites and links to their websites. Information can be found at four spatial scales: individual sites, logical gradients of sites within a region, and networks of sites located both within and across continents and the globe.</p>
                  <p>This "network of networks" is designed to: facilitate new research opportunities by assisting in the identification of individual sites and gradients of sites, and promote synthesis via increased interactions among researchers working at different sites. We will be adding sites both within North America and on other continents through time. If you would like to add a site, gradient or network to our expanding database, <a href="create_account.php">Sign up now</a> or <a href="login.php">Login</a>.</p>
                  <p>P<sup>2</sup>ERLS is a collaboration among the Jornada Basin Long Term Ecological Research (LTER) site funded by the National Science Foundation, the USDA Agricultural Research Service (ARS), Jornada Experimental Range, and New Mexico State University; all located in Las Cruces, New Mexico, USA. The leader of the P2ERLS project is Dr. Debra Peters, and the project coordinator is Christine Laney.</p>
                  <p>For more information, please feel free to <a href="contact.php">Contact us</a>.</p>
                </div>
                <p>&nbsp;</p>
                <div><a name="how"></a><span class="section">How to use this site</span>
                    <p><a href="browse_sites.php"><img src="images/map_shot_350.jpg" width="350" height="275" border="0" align="left" alt="Click on the map or Browse Sites link to search for sites" style="margin-right:10px;" /></a>This website will allow you to search for one or more sites by several different criteria, and by two different methods.</p>
                    <p><span style="font-weight:bold; font-style:italic;">Using the map interface on the Browse sites page:</span> Use the controls on the left hand side of the map to zoom in (+) and out (-). The zoom will focus around the center of the current image. To pan, place your cursor over the map. Click the left mouse button and move the mouse while still holding the button down. Release the mouse button to stop panning. Alternatively, use the arrow buttons on the upper left corner of the map to pan. Click on any marker of interest. Information about the site will appear. Click on "More" to view details associated with the site, or click on "View Website" to have your browser open a new window or tab pointing to the site's home webpage.</p>
                    <p><span style="font-weight:bold; font-style:italic;">Using the search functions:</span> See the <a href="about.php#glossary">Glossary of Terms</a> on the <a href="about.php">About</a> page for search terms. The key to using this function is to start with a broad search, and add additional criteria if too many sites are initially found. For example, you may want to start by searching for a single network. Use the drop down list under "Networks" to select one, and then click on the "Search" button. Experiment with various criteria, and then with combinations of two or three criteria. You will soon have a good understanding for the level of detail which is useful to your purposes.</p>
                </div>
                <p>&nbsp;</p>
              </div>
              <p> </p></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td id="footer" align="center"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>