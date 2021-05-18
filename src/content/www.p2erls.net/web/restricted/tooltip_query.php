<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PDF</title>
<link rel="stylesheet" href="includes/pdf/ajax-tooltip.css" media="screen">
<?php 
// get the site id passed
$site_id2 = $_GET["site"];
$site_id = str_replace("?=undefined","",$site_id2);

require ("Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
?>




</head>

<body>
<table width="100%" border="0" style="background-color:#A0A0A4">
  <tr>
    <td align="center"><div align="left"><a href="#" onClick="ajax_hideTooltip();">Close Window</a></div>
    Query</td>
  </tr>
  <tr>
  <td valign="top"> 
<form action="exec_query.php" method="post" enctype="multipart/form-data" name="query" id="query">
<textarea rows="14" cols="45" name="userquery"></textarea>
<br />
	<br />
<input type="submit" value="Run Query">
</form> 
	</td>
    </tr>
  
  
 
</table>
</body>
</html>
