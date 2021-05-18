<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" align="center"><a href="index.php">Home</a>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="about.php">About</a>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="browse_sites.php">Browse Sites</a>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="links.php">Links</a><?php if($_SESSION["p2erls_username"] != '') { ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="my_account.php">My Account</a><?php } ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="saved_searches.php">Saved Searches</a><?php if($_SESSION["p2erls_access_level"] == 1 || $_SESSION["p2erls_access_level"] == 2) { ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="restricted/index2.php">Add or Modify Sites</a><?php } if($_SESSION["p2erls_access_level"] != 1 && $_SESSION["p2erls_access_level"] != 2 && $_SESSION["p2erls_username"] != '') { ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="become_admin.php">Become an Admin</a><?php } if ($_SESSION["p2erls_username"] == '') { ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="create_account.php">Create Account</a>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="login.php">Log In</a><?php } ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="contact.php">Contact</a></td>
	</tr>   
	<tr>
		<td width="38%" align="left" valign="top" style="padding-top:30px;">Copyright &copy; <?php echo date('Y'); ?> P2ERLS &amp; Digital Solutions</td>
		<td width="33%" align="right" valign="top" style="padding-top:30px;">&nbsp;</td>
	<td width="29%" align="right" valign="top" style="padding-top:30px;">Site designed by <a href="https://www.digitalsolutionslc.com" target="_blank">Digital Solutions</a></td>
	</tr>	
	<tr>
		<td colspan="3" style="padding-top:20px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center"><a href="https://usda-ars.nmsu.edu/" target="_blank"><img src="images/usda_jer_logo.jpg" width="234" height="100" border="0" align="middle" alt="USDA-ARS Jornada Experimental Range" /></a></td>
				<td align="center"><a href="https://jornada-www.nmsu.edu/index.php?withJS=true" target="_blank"><img src="images/jornada_basin_logo.jpg" width="116" height="100" border="0" align="middle" alt="Jornada Basin LTER" /></a></td>
				<td align="center"><a href="https://www.nmsu.edu" target="_blank"><img src="images/nmsu_logo.gif" width="89" height="100" border="0" align="middle" alt="New Mexico State University" /></a></td>
				<td align="center"><a href="https://www.ecotrends.info" target="_blank"><img src="images/ecotrends_logo.jpg" width="133" height="100" border="0" align="middle" alt="EcoTrends" /></a></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td colspan="3" align="center" style="padding-top:20px;"><div align="justify" style="padding:5px; font-size:10px;">Disclaimer and Legal Statement: This material is based upon work supported by the Jornada Basin LTER, USDA-ARS Jornada Experimental Range, and New Mexico State University. Any opinions, findings, conclusions, or recommendations expressed in the material are those of the author(s) and do not necessarily reflect the views of these organizations. Please see the <a href="about.php">About</a> page for more information.</div></td>
	</tr>
</table>
