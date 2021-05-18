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

require ("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$search_type				= $_GET["search_type"];
$select_multiple_sites		= $_GET["select_multiple_sites"];
$search_results				= $_GET["search_results"];
$select_multiple_programs	= $_GET["select_multiple_programs"];
$select_multiple_networks	= $_GET["select_multiple_networks"];
$select_multiple_gradients	= $_GET["select_multiple_gradients"];
$select_multiple_regions	= $_GET["select_multiple_regions"];
$select_multiple_ecosystems	= $_GET["select_multiple_ecosystems"];
$site_elev_min				= $_GET["site_elev_min"];
$site_elev_max				= $_GET["site_elev_max"];
$site_temp_min				= $_GET["site_temp_min"];
$site_temp_max				= $_GET["site_temp_max"];
$site_precip_min			= $_GET["site_precip_min"];
$site_precip_max			= $_GET["site_precip_max"];
$sort_type					= $_GET["sort_type"];


if($sort_type != "")
{
	$sort_string = "ORDER BY $sort_type ASC";
}
else
{
	$sort_string = "ORDER BY site_name ASC";
}
//echo "search_type=$search_type<br>";

if($search_type == 'Sites')
{
	require_once("../includes/class.pager_sites.php");
	
	$p = new Pager;  
	$listings_page=45; 
	$limit = $listings_page; 
	$start = $p->findStart($limit);

	$search_term_array = explode(",", $select_multiple_sites); 
	$number_of_search_terms = count($search_term_array);
	
	//echo"number_of_search_terms: $number_of_search_terms <br>";  
	
	for ($kk_sites=0; $kk_sites < $number_of_search_terms; $kk_sites++)
	{ 
		$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '". $search_term_array[$kk_sites] ."' OR "; 
	} 
	
	$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '' ";
	
	//echo"search_4_these_sites_id_query: $search_4_these_sites_id_query <br>";
	if($select_multiple_sites!=''){	$query_sites = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_countries USING(country_id) WHERE ( $search_4_these_sites_id_query ) AND p2erls_sites.pending_change != 'Yes' $sort_string"; }
	if($select_multiple_sites==''){	$query_sites = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_countries USING(country_id) WHERE p2erls_sites.pending_change != 'Yes' $sort_string"; }
	$result_sites = mysql_query($query_sites);
	$count = mysql_num_rows($result_sites); 
	
	//echo"query_sites: $query_sites <br>";
	//echo"num_results_sites: $num_results_sites <br>";
		
	$pages = $p->findPages($count, $limit); 
 	
	if($select_multiple_sites!=''){	$query_page = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_countries USING(country_id) WHERE p2erls_sites.pending_change != 'Yes' AND ( $search_4_these_sites_id_query ) $sort_string LIMIT $start , $limit"; }
	if($select_multiple_sites==''){	$query_page = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_countries USING(country_id) WHERE p2erls_sites.pending_change != 'Yes' $sort_string LIMIT $start , $limit"; }
	 
	//echo"$query_page <br><br>";
	$result = mysql_query($query_page);
	$num_results = mysql_num_rows($result);
	
	$pagelist = $p->pageList($_GET['page'], $pages,$search_type,$select_multiple_sites,$select_multiple_programs,$select_multiple_networks,$select_multiple_gradients,$select_multiple_regions,$select_multiple_ecosystems,$site_elevlow_min,$site_elevlow_max,$site_elevhigh_min,$site_elevhigh_max,$site_temp_min,$site_temp_max,$site_precip_min,$site_precip_max,$sort_type); 
}

else if($search_type == 'Search')
{
	require_once("../includes/class.pager_search_sites.php");
	
	$p = new Pager;  
	$listings_page=45; 
	$limit = $listings_page; 
	$start = $p->findStart($limit);
	
	$search_results_array = explode("_", $search_results); 
	$number_of_search_results = count($search_results_array);
	
	//echo"number_of_search_terms: $number_of_search_terms <br>";  
	
	for ($kk_search=0; $kk_search < $number_of_search_results; $kk_search++)
	{ 
		$search_4_these_search_sites_id_query = $search_4_these_search_sites_id_query. "site_id = '". $search_results_array[$kk_search] ."' OR "; 
	} 
	
	$search_4_these_search_sites_id_query = $search_4_these_search_sites_id_query. "site_id = '' ";
	
	//echo"search_4_these_search_sites_id_query: $search_4_these_search_sites_id_query <br>";
	$query_search_sites = "SELECT * FROM p2erls_sites LEFT JOIN p2erls_countries USING(country_id) WHERE ( $search_4_these_search_sites_id_query ) AND p2erls_sites.pending_change != 'Yes'";
	$result_search_sites = mysql_query($query_search_sites);
	$count = mysql_num_rows($result_search_sites); 
	
	//echo"query_sites: $query_search_sites <br>";
	//echo"num_results_sites: $count <br>";
		
	$pages = $p->findPages($count, $limit); 
 	
	$query_page = $query_search_sites." $sort_string LIMIT $start , $limit";
	 
	//echo"$query_page <br><br>";
	$result = mysql_query($query_page);
	$num_results = mysql_num_rows($result);
	
	//$search_terms = str_replace(" ", "_", $search_terms);
	$pagelist = $p->pageList($_GET['page'], $pages,$search_type,$select_multiple_sites,$select_multiple_programs,$select_multiple_networks,$select_multiple_gradients,$select_multiple_regions,$select_multiple_ecosystems,$site_elevlow_min,$site_elevlow_max,$site_elevhigh_min,$site_elevhigh_max,$site_temp_min,$site_temp_max,$site_precip_min,$site_precip_max,$sort_type); 
}

//if($search_type != 'Sites')
else
{
	require_once("../includes/class.pager_sites2.php");
	
	$p = new Pager;  
	$listings_page=45; 
	$limit = $listings_page; 
	$start = $p->findStart($limit);
	
	$query = 
	"
		SELECT * 
		FROM p2erls_sites
		LEFT JOIN p2erls_program_sites USING (site_id)
		LEFT JOIN p2erls_site_gradient USING (site_id)
		LEFT JOIN p2erls_gradients USING (gradient_id)
		LEFT JOIN p2erls_programs USING (program_id)
		LEFT JOIN p2erls_ecosystems USING (ecosystem_id)
		LEFT JOIN p2erls_states USING (state_id)
		LEFT JOIN p2erls_countries USING (country_id)
	";
	
		$query .= "WHERE site_id != '' AND p2erls_sites.pending_change = 'No' "; 
		
		if($select_multiple_programs != '')
		{
			$search_term_array = explode(",", $select_multiple_programs); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " program_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " program_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_program_sites
				WHERE ( $search_4_these_array_id_query ) AND p2erls_program_sites.pending_change = 'No' 
			)
			"; 
		}
		if($select_multiple_networks != '')
		{
			$search_term_array = explode(",", $select_multiple_networks); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " network_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " network_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_network_sites
				WHERE ( $search_4_these_array_id_query ) AND p2erls_network_sites.pending_change = 'No'
			)
			"; 
		}
		if($select_multiple_gradients != '')
		{
			$search_term_array = explode(",", $select_multiple_gradients); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " gradient_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " gradient_id = '' ";
			 
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_site_gradient
				WHERE ( $search_4_these_array_id_query ) AND p2erls_site_gradient.pending_change = 'No'
			)
			"; 
		}
		if($select_multiple_regions != '')
		{
			$search_term_array = explode(",", $select_multiple_regions); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " region_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " region_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_site_gradient
				WHERE gradient_id 
				IN
				(
					SELECT gradient_id 
					FROM p2erls_gradient_region
					WHERE ( $search_4_these_array_id_query ) AND p2erls_gradient_region.pending_change = 'No'
				)
			)
			"; 
		}
		if($select_multiple_ecosystems != '')
		{
			$search_term_array = explode(",", $select_multiple_ecosystems); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " ecosystem_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " ecosystem_id = '' ";
			$query .= "AND ( $search_4_these_array_id_query ) ";
		}
		
		/* 
		if($site_elevlow_min!='' )		{ $query .= "AND site_elevlow >= '$site_elevlow_min' "; 	} 
		if($site_elevlow_max!='' )		{ $query .= "AND site_elevlow <= '$site_elevlow_max' ";  	} 
		if($site_elevhigh_min!='')		{ $query .= "AND site_elevhigh >= '$site_elevhigh_min' ";  	} 
		if($site_elevhigh_max!='')		{ $query .= "AND site_elevhigh <= '$site_elevhigh_max' ";  	}
		*/
		if($site_elev_min != '' && $site_elev_max == '') { $query .= "AND site_elevlow >= '$site_elev_min' "; }
		if($site_elev_min == '' && $site_elev_max != '') { $query .= "AND site_elevhigh <= '$site_elev_max' "; } 
		if($site_elev_min != '' && $site_elev_max != '') { $query .= "AND site_elevlow >= '$site_elev_min' AND site_elevhigh <= '$site_elev_max' "; }
		
		if($site_temp_min!='')			{ $query .= "AND site_temp >= '$site_temp_min' ";  		} 
		if($site_temp_max!='')			{ $query .= "AND site_temp <= '$site_temp_max' ";  		}  	
		if($site_precip_min!='')		{ $query .= "AND site_precip >= '$site_precip_min' ";  	} 
		if($site_precip_max!='')		{ $query .= "AND site_precip <= '$site_precip_max' ";  	}  
	
	$query 		.= " GROUP BY site_id $sort_string ";
	//echo "$query <br>";
	$result 	= mysql_query($query);
	$count 		= mysql_num_rows($result);
	if(empty($big_var)){$big_var 	= "";}
	for ($i_exp=0; $i_exp <$count; $i_exp++)
		{
			 	$site_id	= mysql_result($result,$i_exp,"site_id"); 
				$big_var 	.= $site_id. "_";
		}
	 
	 
		
	$pages = $p->findPages($count, $limit); 
		
		$query = 
	"
		SELECT * 
		FROM p2erls_sites
		LEFT JOIN p2erls_program_sites USING (site_id)
		LEFT JOIN p2erls_site_gradient USING (site_id)
		LEFT JOIN p2erls_gradients USING (gradient_id)
		LEFT JOIN p2erls_programs USING (program_id)
		LEFT JOIN p2erls_ecosystems USING (ecosystem_id)
		LEFT JOIN p2erls_states USING (state_id)
		LEFT JOIN p2erls_countries USING (country_id)
	";
	
		$query .= "WHERE site_id != '' AND p2erls_sites.pending_change = 'No' "; 
		
		if($select_multiple_programs != '')
		{
			$search_term_array = explode(",", $select_multiple_programs); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " program_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " program_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_program_sites
				WHERE ( $search_4_these_array_id_query ) AND p2erls_program_sites.pending_change = 'No'
			)
			"; 
		}
		if($select_multiple_networks != '')
		{
			$search_term_array = explode(",", $select_multiple_networks); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " network_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " network_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_network_sites
				WHERE ( $search_4_these_array_id_query ) AND p2erls_network_sites.pending_change = 'No'
			)
			"; 
		}
		if($select_multiple_gradients != '')
		{
			$search_term_array = explode(",", $select_multiple_gradients); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " gradient_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " gradient_id = '' ";
			 
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_site_gradient
				WHERE ( $search_4_these_array_id_query ) AND p2erls_site_gradient.pending_change = 'No'
			)
			"; 
		}
		if($select_multiple_regions != '')
		{
			$search_term_array = explode(",", $select_multiple_regions); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " region_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " region_id = '' ";
			
			$query .= 
			"
			AND
			site_id IN
			(
				SELECT site_id 
				FROM p2erls_site_gradient
				WHERE gradient_id 
				IN
				(
					SELECT gradient_id 
					FROM p2erls_gradient_region
					WHERE ( $search_4_these_array_id_query ) AND p2erls_gradient_region.pending_change = 'No'
				)
			)
			"; 
		}
		if($select_multiple_ecosystems != '')
		{
			$search_term_array = explode(",", $select_multiple_ecosystems); 	$number_of_search_terms = count($search_term_array);
			$search_4_these_array_id_query='';
			for ($kk_array=0; $kk_array < $number_of_search_terms; $kk_array++)
			{
				$search_4_these_array_id_query = $search_4_these_array_id_query. " ecosystem_id = '". $search_term_array[$kk_array] ."' OR "; 
			} 
			$search_4_these_array_id_query = $search_4_these_array_id_query. " ecosystem_id = '' ";
			$query .= "AND ( $search_4_these_array_id_query ) ";
		}
		
		/* 
		if($site_elevlow_min!='' )		{ $query .= "AND site_elevlow >= '$site_elevlow_min' "; 	} 
		if($site_elevlow_max!='' )		{ $query .= "AND site_elevlow <= '$site_elevlow_max' ";  	} 
		if($site_elevhigh_min!='')		{ $query .= "AND site_elevhigh >= '$site_elevhigh_min' ";  	} 
		if($site_elevhigh_max!='')		{ $query .= "AND site_elevhigh <= '$site_elevhigh_max' ";  	} 
		*/
		if($site_elev_min != '' && $site_elev_max == '') { $query .= "AND site_elevlow >= '$site_elev_min' "; }
		if($site_elev_min == '' && $site_elev_max != '') { $query .= "AND site_elevhigh <= '$site_elev_max' "; }
		if($site_elev_min != '' && $site_elev_max != '') { $query .= "AND site_elevlow >= '$site_elev_min' AND site_elevhigh <= '$site_elev_max' "; }
		
		if($site_temp_min!='')			{ $query .= "AND site_temp >= '$site_temp_min' ";  		} 
		if($site_temp_max!='')			{ $query .= "AND site_temp <= '$site_temp_max' ";  		}  	
		if($site_precip_min!='')		{ $query .= "AND site_precip >= '$site_precip_min' ";  	} 
		if($site_precip_max!='')		{ $query .= "AND site_precip <= '$site_precip_max' ";  	}  
	
	$query .= " GROUP BY site_id $sort_string LIMIT $start , $limit";
	//echo "$query <br>"; 
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result); 	
		
	$pagelist = $p->pageList($_GET['page'], $pages,$search_type,$search_multiple_sites,$select_multiple_programs,$select_multiple_networks,$select_multiple_gradients,$select_multiple_regions,$select_multiple_ecosystems,$site_elev_min,$site_elev_max,$site_temp_min,$site_temp_max,$site_precip_min,$site_precip_max,$sort_type); 
	$showing_to  = $limit + $num_results;
	
	$change_sort_page = $_GET['page'];
	
} 


		for ($kk=0; $kk <$num_results; $kk++)
		{
			 	$site_id= mysql_result($result,$kk,"site_id"); 
				$site_name= mysql_result($result,$kk,"site_name");
				$site_url= mysql_result($result,$kk,"site_url");
				$site_lat= mysql_result($result,$kk,"site_lat");
				$site_long= mysql_result($result,$kk,"site_long");
				$site_elevlow= mysql_result($result,$kk,"site_elevlow");
				$site_elevhigh= mysql_result($result,$kk,"site_elevhigh");
				$site_elevmean= mysql_result($result,$kk,"site_elevmean");
				$site_temp= mysql_result($result,$kk,"site_temp");
				$site_precip= mysql_result($result,$kk,"site_precip");
				$site_desc= mysql_result($result,$kk,"site_desc");
				$ecosystem_id= mysql_result($result,$kk,"ecosystem_id");
				$state_id= mysql_result($result,$kk,"state_id"); 
				$country_id= mysql_result($result,$kk,"country_id");
				if(empty($big_var))
				{
				$big_var = "";
				$big_var .= $site_id. "_";
				}
				if ($site_elevlow == 0 || $site_elevlow == NULL) { $site_elevlow = ''; }
				if ($site_elevhigh == 0 || $site_elevhigh == NULL) { $site_elevhigh = ''; }
				if ($site_elevmean == 0 || $site_elevmean == NULL) { $site_elevmean = ''; }
				if ($site_temp == 0 || $site_temp == NULL) { $site_temp = ''; }
				if ($site_precip == 0 || $site_precip == NULL) { $site_precip = ''; }
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
    <td width="609"><?php 
    if($count==1){
    	echo "There is 1 site that met ";
    } else {echo "There are ".--$count." sites that meet ";
    } 
    ?>
    your criteria. Click on Details to see more detailed information about a site. Click on Map to show the site on the map above. Click on the site name to go to the site's homepage. You may also click on any of the site markers in the map above.</td>
    <td width="71"><form name="csv" action="export/csv.php" enctype="multipart/form-data" method="post">
  <input type="hidden" name="big_var" value="<?php echo "$big_var"; ?>">
    CSV 
    <div align="right">
      <input name="image" type="image" value="images/csv.jpg" width="30" src="images/csv.jpg" alt="submit" >
    </div>
    </form>
	  <form name="excel" action="export/excel.php" enctype="multipart/form-data" method="post">
  <input type="hidden" name="big_var"  value="<?php echo "$big_var"; ?>">
EXCEL
 <div align="right">
   <input name="image" type="image" width="30" src="images/excel.jpg" alt="submit" >
 </div>
	  </form></td>
  </tr>
  <tr>
    <td colspan="2"><?php if($count>=$limit){ echo "$pagelist"; } ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" cellpadding="3" cellspacing="0">
        <tr>
          <td width="11%">&nbsp;</td>
          <td width="10%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_name')\" ><b>Site Name</b></a>";?></td>
          <td width="10%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_lat')\" ><b>Latitude</b></a>";?></td>
          <td width="13%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_long')\" ><b>Longitude</b></a>";?></td>
          <td width="11%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_elevlow')\" ><b>Elevation</b></a>";?></td>
          <td width="8%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_temp')\" ><b>Temp</b></a>";?></td>
          <td width="9%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=site_precip')\" ><b>Precip</b></a>";?></td>
          <td width="12%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=ecosystem_name')\" ><b>Ecosystem</b></a>";?></td>
          <td width="14%"><?php echo"<a href=\"javascript:searchSiteCriteriaTable2('?page=".$change_sort_page."$i&search_type=$search_type&search_multiple_sites=$search_multiple_sites&select_multiple_programs=$select_multiple_programs&select_multiple_networks=$select_multiple_networks&select_multiple_gradients=$select_multiple_gradients&select_multiple_regions=$select_multiple_regions&select_multiple_ecosystems=$select_multiple_ecosystems&site_elev_min=$site_elev_min&site_elev_max=$site_elev_max&site_temp_min=$site_temp_min&site_temp_max=$site_temp_max&site_precip_min=$site_precip_min&site_precip_max=$site_precip_max&sort_type=country_name')\" ><b>Location</b></a>";?></td>
        </tr>
        <?php
		for ($kk=0; $kk <$num_results; $kk++)
		{
			 	$site_id= mysql_result($result,$kk,"site_id"); 
				$site_name= mysql_result($result,$kk,"site_name");
				$site_url= mysql_result($result,$kk,"site_url");
				$site_lat= mysql_result($result,$kk,"site_lat");
				$site_long= mysql_result($result,$kk,"site_long");
				$site_elevlow= mysql_result($result,$kk,"site_elevlow");
				$site_elevhigh= mysql_result($result,$kk,"site_elevhigh");
				$site_elevmean= mysql_result($result,$kk,"site_elevmean");
				$site_temp= mysql_result($result,$kk,"site_temp");
				$site_precip= mysql_result($result,$kk,"site_precip");
				$site_desc= mysql_result($result,$kk,"site_desc");
				$ecosystem_id= mysql_result($result,$kk,"ecosystem_id");
				$state_id= mysql_result($result,$kk,"state_id"); 
				$country_id= mysql_result($result,$kk,"country_id"); 
				
			
				if ($site_elevlow == 0 || $site_elevlow == NULL) { $site_elevlow = ''; }
				if ($site_elevhigh == 0 || $site_elevhigh == NULL) { $site_elevhigh = ''; }
				if ($site_elevmean == 0 || $site_elevmean == NULL) { $site_elevmean = ''; }
				if ($site_temp == 0 || $site_temp == NULL) { $site_temp = ''; }
				if ($site_precip == 0 || $site_precip == NULL) { $site_precip = ''; }
		?>
        <tr bgcolor="#ffffff">
          <td><a href="site.php?site_id=<?php echo"$site_id";?>" target="_blank">Details</a><?php if ( ($site_lat != '' && $site_long != '') || ($site_lat == 'NULL' && $site_long == 'NULL') || ($site_lat == '0' && $site_long == '0') ) { ?> - <a href="#google_map" onClick="javascript:myclick('<?php echo"$site_id";?>')">Map</a><?php } ?></td>
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
  <?php } 
  $big_var=rtrim($big_var, "_");
  ?>
</table>
