<?php    
/*
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
*/

include("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$account_num=$_GET["account_num"];

if($account_num==''){ echo"You Must Be Logged In To View Your Saved Searches."; }
else{
$query_saved_searches = "SELECT * FROM p2erls_saved_searches where account_num = '$account_num' ORDER BY saved_search_num ASC";
		
$result_saved_searches = mysql_query($query_saved_searches); 
$num_results_saved_searches = mysql_num_rows($result_saved_searches); 
if($num_results_saved_searches=='0'){ echo"Sorry, You Have Not Saved Any Searches."; }
if($num_results_saved_searches!='0'){
?>
<table width="200" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php
for ($kk_saved_searches=0; $kk_saved_searches <$num_results_saved_searches; $kk_saved_searches++)
{
	$saved_search_num= mysql_result($result_saved_searches,$kk_saved_searches,"saved_search_num"); 
	$account_num= mysql_result($result_saved_searches,$kk_saved_searches,"account_num");
	$date_saved= mysql_result($result_saved_searches,$kk_saved_searches,"date_saved");
	$search_name= mysql_result($result_saved_searches,$kk_saved_searches,"search_name");
	$select_multiple_programs= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_programs");
	$select_multiple_networks= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_networks");
	$select_multiple_gradients= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_gradients");
	$select_multiple_regions= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_regions");
	$select_multiple_ecosystems= mysql_result($result_saved_searches,$kk_saved_searches,"select_multiple_ecosystems");
	$site_elevlow_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevlow_min");
	$site_elevlow_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevlow_max");
	$site_elevhigh_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevhigh_min");
	$site_elevhigh_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_elevhigh_max"); 
	$site_temp_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_temp_min"); 
	$site_temp_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_temp_max"); 
	$site_precip_min= mysql_result($result_saved_searches,$kk_saved_searches,"site_precip_min"); 
	$site_precip_max= mysql_result($result_saved_searches,$kk_saved_searches,"site_precip_max"); 
?>
		
  <tr>
    <td><a href="javascript:loadSearch('<?php echo"$select_multiple_programs";?>','<?php echo"$select_multiple_networks";?>','<?php echo"$select_multiple_gradients";?>','<?php echo"$select_multiple_regions";?>','<?php echo"$select_multiple_ecosystems";?>','<?php echo"$site_elevlow_min";?>','<?php echo"$site_elevlow_max";?>','<?php echo"$site_elevhigh_min";?>','<?php echo"$site_elevhigh_max";?>','<?php echo"$site_temp_min";?>','<?php echo"$site_temp_max";?>','<?php echo"$site_precip_min";?>','<?php echo"$site_precip_max";?>')" class="white"><?php echo"$search_name";?></a> - <a href="javascript:removeSearch('<?php echo"$saved_search_num";?>','<?php echo"$search_name";?>','<?php echo"$account_num";?>')" class="white">Remove</a></td>
  </tr>
 	 
<?php } ?> 
<tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } }?>