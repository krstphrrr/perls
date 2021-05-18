<?php include("includes/permissions_admin.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="includes/ajax_common.js"></script>
<script type="text/javascript" src="includes/ajax_continents.js"></script>

<link href="includes/admin_styles.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="init_table();">
<div align="center">
<table style="width:960px;  " border="0" align="center" cellpadding="0" cellspacing="0" class="tableBorder">
  <?php include("includes/header_admin.php"); ?>
  <tr>
    <td align="left" valign="top"><div id="showContinents"><div id='loading_indicator' align='center'><h1><b><font color='#FFFFFF'><br />LOADING</font></b></h1><h1><b><font color='#FFFFFF'><img src='../images/ajax-load-indicator.gif' width='32' height='32' /></font></b></h1><h1><b><font color='#FFFFFF'>PLEASE WAIT </font></b></h1></div></div></td>
  </tr> 
  <?php include("includes/footer_admin.php"); ?>
</table>
</div>
<p>&nbsp;</p>

</body>
</html>
