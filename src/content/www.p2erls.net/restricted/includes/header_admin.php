<tr>
	<td height="25" align="right">Welcome User: <?php echo "<b>$_SESSION[p2erls_username]</b>&nbsp;&nbsp;"; if ($_SESSION["p2erls_access_level"] == 1){ ?> <a href="accounts.php">Accounts</a> || <a href="approvals.php">Approvals</a> || <?php } ?><a href="https://www.p2erls.net/">Main Site</a> || <a href="Security_Dept/logout.php">Log Out</a>&nbsp;</td>
</tr>
<tr>
	<td align="center" bgcolor="#eeeeee"><h1>Administration Panel</h1></td>
</tr>
<tr>
	<td align="center" bgcolor="#dddddd" style="padding:3px;"><a href="continents.php">Continents / Oceans</a> - <a href="countries.php">Countries</a> - <a href="ecosystems.php">Ecosystems</a> - <a href="gradients.php">Gradients</a> - <a href="landowner_bounds.php">Landowner Bounds</a> - <a href="landowner.php">Landowners</a> - <a href="networks.php">Networks</a> - <a href="programs.php">Programs</a> - <a href="regions.php">Regions</a> - <a href="sites.php">Sites</a> - <a href="states.php">States</a><?php if ($_SESSION["p2erls_access_level"] == 1){ ?> - <a href="links.php">Links</a><?php } ?></td>
</tr>