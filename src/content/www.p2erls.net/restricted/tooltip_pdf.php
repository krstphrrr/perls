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

$query_prev_flyer = "SELECT * FROM p2erls_sites WHERE site_id = '$site_id' ORDER BY site_id ASC";
//echo "$site_id2";
//echo "$site_id";
//echo "$query_prev_flyer";  exit;
$result_prev_flyer = mysql_query($query_prev_flyer);
$num_results_prev_flyer = mysql_num_rows($result_prev_flyer); 
 for ($i_prev_flyer=0; $i_prev_flyer <$num_results_prev_flyer; $i_prev_flyer++)
  	{
  	$site_flyer_old= mysql_result($result_prev_flyer,$i_prev_flyer,"site_flyer");
	}

?>

<script type="text/javascript" language="javascript" djConfig="parseOnLoad: true, isDebug: true" src="includes/dojo/dojo/dojo.js"></script>
<script type="text/javascript" language="javascript">
dojo.require("dojo.io.iframe"); 
dojo.require("dijit.ProgressBar"); 
dojo.require("dijit.form.Button"); 
dojo.require("dojo.parser");
</script>
<script type="text/javascript" language="javascript" src="includes/pdf/ajax_insert.js"></script>



</head>

<body>
<table width="100%" border="0" style="background-color:#A0A0A4">
  <tr>
    <td colspan="2" align="center"><div align="left"><a href="#" onClick="ajax_hideTooltip();">Close Window</a></div>Site: <?php echo "$site_id"; ?> PDF </td>
  </tr>
  <tr>
  <td width="79%" valign="top">
  <div id="inputField"><form action="insert_pdf.php" method="post" enctype="multipart/form-data" name="add_pdf_form" id="add_pdf_form">
      <input type="file" name="userfile0">
	  <input name="site_id" type="hidden" value="<?php echo "$site_id"; ?>">
	  <input name="site_flyer_old" type="hidden" value="<?php echo "$site_flyer_old"; ?>">
	<span class="reg_font">PDF filename  must not contain spaces or <a href="javascript: void(0)" onClick="window.open('https://www.digitalsolutionslc.com/help_center/special_characters.php','notice','height=400,width=400,toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=0')" class="link">special characters</a></span><br />
	<br />
    <span class="bold_pale_yellow">PLEASE NOTE: Only click browse if you<br />
want to change the file! Leave blank if<br />
you want to keep the current pdf...
<h2>OR</h2>
<input type="checkbox" name="userfile0_delete" id="userfile0_delete" value="Delete" />
  </form></div>
...Check this box to delete this PDF <br />
	<br />
	<div id="status">&nbsp;</div>
    </td>
    <td width="21%"><div id="preview"><?php if($site_flyer_old != ''){ ?><img src="includes/pdf_prev_servlet.php?num=<?php echo "$site_id"; ?>" width="200" id="refresh" /><?php } ?></div></td>
  </tr>
  
  <tr>
    <td colspan="2"><div id="progressField">&nbsp;</div><br /><br /><div align="center"><button type="button" value="Add Photo" dojoType="dijit.form.Button" onclick="processForm();">Upload</button></div></td>
  </tr>
  <tr>
    
	<td colspan="2"><div id="uploadedFiles"></div></td>
  </tr>
   
</table>
</body>
</html>
