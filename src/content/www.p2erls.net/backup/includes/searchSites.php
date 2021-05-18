<?php 
require ("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
		
$search_sites=$_GET["search_sites"];
$site_elevlow=$_GET["site_elevlow"];
$site_elevhigh=$_GET["site_elevhigh"];
$site_templow=$_GET["site_templow"];
$site_temphigh=$_GET["site_temphigh"];
$site_preciplow=$_GET["site_preciplow"];
$site_preciphigh=$_GET["site_preciphigh"]; 


require_once("../includes/class.pager_sites.php"); 
	
$p = new Pager;  
$listings_page=45; 
$limit = $listings_page; 
$start = $p->findStart($limit); 
	
if($search_sites!='' || ($search_sites=='' && $site_elevlow=='' && $site_elevhigh=='' && $site_templow=='' && $site_temphigh=='' && $site_preciplow=='' && $site_preciphigh==''))
{
	$search_term_array = explode(",", $search_sites); 
	$number_of_search_terms = count($search_term_array);
	
	//echo"number_of_search_terms: $number_of_search_terms <br>";
 
	$query_sites = "SELECT * FROM p2erls_sites ORDER BY site_id ASC"; 
	$result_sites = mysql_query($query_sites);
	$num_results_sites = mysql_num_rows($result_sites); 
	
	//echo"query_sites: $query_sites <br>";
	//echo"num_results_sites: $num_results_sites <br><br>";
	
	for ($kk_sites=0; $kk_sites <$number_of_search_terms; $kk_sites++)
	{
		$site_id= mysql_result($result_sites,$search_term_array[$kk_sites],"site_id");
		$site_name= mysql_result($result_sites,$search_term_array[$kk_sites],"site_name");	
		$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '".$site_id."' or "; 
	}
	 
	$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '' ";
	
	//echo"search_4_these_sites_id_query: $search_4_these_sites_id_query <br>";
	if($search_sites!=''){	$query_sites = "SELECT * FROM p2erls_sites where $search_4_these_sites_id_query ORDER BY site_name ASC"; }
	if($search_sites==''){	$query_sites = "SELECT * FROM p2erls_sites ORDER BY site_name ASC"; }
	$result_sites = mysql_query($query_sites);
	$count = mysql_num_rows($result_sites); 
	
	//echo"query_sites: $query_sites <br>";
	//echo"num_results_sites: $num_results_sites <br>";
		
	$pages = $p->findPages($count, $limit); 
 	
	if($search_sites!=''){	$query_page = "SELECT * FROM p2erls_sites where $search_4_these_sites_id_query ORDER BY site_name asc LIMIT $start , $limit"; }
	if($search_sites==''){	$query_page = "SELECT * FROM p2erls_sites ORDER BY site_name asc LIMIT $start , $limit"; }
	 
	
	//echo"$query_page <br><br>";
	$result = mysql_query($query_page);
	$num_results = mysql_num_rows($result);
	
	$pagelist = $p->pageList($_GET['page'], $pages,$search_sites,$site_elevlow,$site_elevhigh,$site_templow,$site_temphigh,$site_preciplow,$site_preciphigh); 

}

if($search_sites=='' || ($search_sites!='' && ($site_elevlow!='' || $site_elevhigh!='' || $site_templow!='' || $site_temphigh!='' || $site_preciplow!='' || $site_preciphigh!='')))
{
 
	$query = "SELECT * FROM p2erls_sites ";
	
	if($site_elevlow!='' || $site_elevhigh!='' || $site_templow!='' || $site_temphigh!='' || $site_preciplow!='' || $site_preciphigh !='' ){
	$query .= "where "; 
	}
	if($mls_num!=''){ $query .= "site_id != '' "; }
	if($site_elevlow!=''){ $query .= "and site_elevlow >= '$site_elevlow' ";  } 
	if($site_elevhigh!=''){ $query .= "and site_elevhigh <= '$site_elevhigh' ";  } 
	if($site_templow!=''){ $query .= "and site_temp >= '$site_templow' ";  } 
	if($site_temphigh!=''){ $query .= "and site_temp <= '$site_temphigh' ";  } 	
	if($site_preciplow!=''){ $query .= "and site_precip >= '$site_preciplow' ";  } 
	if($site_preciphigh!=''){ $query .= "and site_precip <= '$site_preciphigh' ";  } 	
	
	if($site_elevlow=='' && $site_elevhigh=='' && $site_templow=='' && $site_temphigh=='' && $site_preciplow=='' && $site_preciphigh=='' ){
	$query = "SELECT * FROM p2erls_sites"; 
	}
	
	//echo"$query <br><br>";
	
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	
	$pages = $p->findPages($count, $limit); 
	
	$query_page = "SELECT * FROM p2erls_sites ";
	
	if($site_elevlow!='' || $site_elevhigh!='' || $site_templow!='' || $site_temphigh!='' || $site_preciplow!='' || $site_preciphigh !='' ){
	$query_page .= "where "; 
	}
	if($mls_num!=''){ $query_page .= "site_id != '' "; }
	if($site_elevlow!=''){ $query_page .= "and site_elevlow >= '$site_elevlow' ";  } 
	if($site_elevhigh!=''){ $query_page .= "and site_elevhigh <= '$site_elevhigh' ";  } 
	if($site_templow!=''){ $query_page .= "and site_temp >= '$site_templow' ";  } 
	if($site_temphigh!=''){ $query_page .= "and site_temp <= '$site_temphigh' ";  } 	
	if($site_preciplow!=''){ $query_page .= "and site_precip >= '$site_preciplow' ";  } 
	if($site_preciphigh!=''){ $query_page .= "and site_precip <= '$site_preciphigh' ";  } 	
	
	$query_page .= " ORDER BY site_name asc LIMIT $start , $limit";
	
	if($site_elevlow=='' && $site_elevhigh=='' && $site_templow=='' && $site_temphigh=='' && $site_preciplow=='' && $site_preciphigh=='' )
	{
		$query_page = "SELECT * FROM p2erls_sites ORDER BY site_name asc LIMIT $start , $limit"; 
	}
	
	//echo"$query_page <br><br>";
	$result = mysql_query($query_page);
	$num_results = mysql_num_rows($result);
	
	$pagelist = $p->pageList($_GET['page'], $pages,$search_sites,$site_elevlow,$site_elevhigh,$site_templow,$site_temphigh,$site_preciplow,$site_preciphigh); 

}

?> 
<table width="700" border="0" cellspacing="0" cellpadding="5">
   <?php if($num_results==0){ ?>
   <tr>
    <td colspan="2">Sorry, there are no sites meeting your critera.</td>
  </tr>
  <?php } ?>
  <?php if($num_results!=0){ ?>
  <tr>
    <td colspan="2"><?php $showing_to  = $limit + $num_results; echo"There are $count sites that meet your criteria. ";?></td>
    
  </tr>
  <tr>
    <td width="489"><?php if($count>=$limit){ echo "$pagelist"; } ?></td>
	<td width="191"><a href="excel/export.php">Download Excel File of Sites</a> </td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" cellpadding="3" cellspacing="0">
        <tr>
          <td width="5%"><b> ID </b></td>
          <td width="16%"><b> Site Name </b></td>
          <td width="11%"><b> Latitude</b></td>
          <td width="13%"><b>Longitude</b></td>
          <td width="11%"><b>Elevation</b></td>
          <td width="8%"><b>Temp</b></td>
          <td width="9%"><b>Precip</b></td>
          <td width="12%"><b>Ecosystem</b></td>
          <td><b>Location</b></td>
        </tr>
        <?php
		for ($kk_sites=0; $kk_sites <$number_of_search_terms; $kk_sites++)
		{
			 	$site_id= mysql_result($result_sites,$kk_sites,"site_id"); 
				$site_name= mysql_result($result_sites,$kk_sites,"site_name");
				$site_url= mysql_result($result_sites,$kk_sites,"site_url");
				$site_lat= mysql_result($result_sites,$kk_sites,"site_lat");
				$site_long= mysql_result($result_sites,$kk_sites,"site_long");
				$site_elevlow= mysql_result($result_sites,$kk_sites,"site_elevlow");
				$site_elevhigh= mysql_result($result_sites,$kk_sites,"site_elevhigh");
				$site_elevmean= mysql_result($result_sites,$kk_sites,"site_elevmean");
				$site_temp= mysql_result($result_sites,$kk_sites,"site_temp");
				$site_precip= mysql_result($result_sites,$kk_sites,"site_precip");
				$site_desc= mysql_result($result_sites,$kk_sites,"site_desc");
				$ecosystem_id= mysql_result($result_sites,$kk_sites,"ecosystem_id");
				$state_id= mysql_result($result_sites,$kk_sites,"state_id"); 
				$country_id= mysql_result($result_sites,$kk_sites,"country_id"); 
				 
			  ?>
        <tr bgcolor="#ffffff">
          <td><?php echo"$site_id";?></td>
          <td><?php if($site_url!=''){?>
            <a href="<?php echo"$site_url";?>" target="_blank">
            <?php } ?>
            <?php echo"$site_name";?>
            <?php if($site_url!=''){?>
            </a>
            <?php } ?></td>
          <td><?php echo"$site_lat";?></td>
          <td><?php echo"$site_long";?></td>
          <td>Low: <?php echo"$site_elevlow";?><br />
            High: <?php echo"$site_elevhigh";?><br />
            Mean: <?php echo"$site_elevmean";?></td>
          <td><?php echo"$site_temp";?></td>
          <td><?php echo"$site_precip";?></td>
          <td><?php echo"$ecosystem_id";?></td>
          <td><?php echo"$state_id";?><br />
          <?php echo"$country_id";?></td>
        </tr>
        <?php } ?> 
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php if($count>=$limit){ echo "$pagelist"; } ?></td>
  </tr>
  <?php } ?>
</table>
