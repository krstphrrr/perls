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

$search_type=$_GET["search_type"];
$select_multiple_sites=$_GET["select_multiple_sites"];
$search_term=$_GET["search_term"];
$select_multiple_programs=$_GET["select_multiple_programs"];
$select_multiple_networks=$_GET["select_multiple_networks"];
$select_multiple_gradients=$_GET["select_multiple_gradients"];
$select_multiple_regions=$_GET["select_multiple_regions"];
$select_multiple_ecosystems=$_GET["select_multiple_ecosystems"];

/*
$site_elevlow_min=$_GET["site_elevlow_min"];
$site_elevlow_max=$_GET["site_elevlow_max"];
$site_elevhigh_min=$_GET["site_elevhigh_min"];
$site_elevhigh_max=$_GET["site_elevhigh_max"];
*/
$site_elev_min=$_GET["site_elev_min"];
$site_elev_max=$_GET["site_elev_max"];

$site_temp_min=$_GET["site_temp_min"];
$site_temp_max=$_GET["site_temp_max"];
$site_precip_min=$_GET["site_precip_min"];
$site_precip_max=$_GET["site_precip_max"];

if($search_type == 'Sites')
{
	if($select_multiple_sites != '')
	{
	
		$search_term_array = explode(",", $select_multiple_sites); 
		$number_of_search_terms = count($search_term_array);
		
		//echo"number_of_search_terms: $number_of_search_terms <br>";  
		
		for ($kk_sites=0; $kk_sites < $number_of_search_terms; $kk_sites++)
		{ 
			$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '". $search_term_array[$kk_sites] ."' or "; 
		} 
		
		$search_4_these_sites_id_query = $search_4_these_sites_id_query. "site_id = '' ";
		
		//echo"search_4_these_sites_id_query: $search_4_these_sites_id_query <br>";
		if($select_multiple_sites!=''){	$query_sites = "SELECT * FROM p2erls_sites WHERE ( $search_4_these_sites_id_query ) AND p2erls_sites.pending_change = 'No' ORDER BY site_id ASC"; }
		if($select_multiple_sites==''){	$query_sites = "SELECT * FROM p2erls_sites WHERE p2erls_sites.pending_change = 'No' ORDER BY site_id ASC"; }
		$result_sites = mysql_query($query_sites); 
		$num_results_sites = mysql_num_rows($result_sites);
		//echo"$query_sites<br>";
		for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
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
					
			if($kk_sites==0)
			{
				$markers = $site_id;
			}
			if($kk_sites!=0)
			{
			$markers = $markers.','.$site_id;
			} 
						 
		}
		 
	}
	if($select_multiple_sites == '')
	{
	 
		$query_sites = "SELECT * FROM p2erls_sites WHERE p2erls_sites.pending_change = 'No' ORDER BY site_id ASC"; 
		$result_sites = mysql_query($query_sites); 
		$num_results_sites = mysql_num_rows($result_sites);
		
		for ($kk_sites=0; $kk_sites <$num_results_sites; $kk_sites++)
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
					
			if($kk_sites==0)
			{
				$markers = $site_id;
			}
			if($kk_sites!=0)
			{
			$markers = $markers.','.$site_id;
			} 
						 
		}
		 
	}
	echo"$markers";
}

if($search_type == 'Search')
{
	$query_search = "SELECT * FROM p2erls_sites WHERE pending_change = 'No' AND (
	site_id LIKE '%$search_term%' OR
	site_name LIKE '%$search_term%' OR
	site_desc LIKE '%$search_term%')
	ORDER BY site_id ASC"; 
	$result_search = mysql_query($query_search); 
	$num_results_search = mysql_num_rows($result_search);
	
	//echo"query_search = $query_search<br>";
	//echo"num_results_search = $num_results_search<br>";
	
	$markers = '';
	
	if ($num_results_search != 0)
	{		
		for ($kk_search=0; $kk_search <$num_results_search; $kk_search++)
		{
			$site_id= mysql_result($result_search,$kk_search,"site_id");
			
			if ($kk_search == 0)
			{
				$markers = $site_id;
			}
			else
			{
				$markers = $markers.'_'.$site_id;
			}
		}
	}
	
	echo"$markers";
}

if($search_type == 'Main' || $search_type == 'savedEmpty')
{

		
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
				WHERE  ( $search_4_these_array_id_query ) AND p2erls_program_sites.pending_change = 'No' 
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
				WHERE  ( $search_4_these_array_id_query ) AND p2erls_network_sites.pending_change = 'No'
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
				WHERE  ( $search_4_these_array_id_query ) AND p2erls_site_gradient.pending_change = 'No'
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
					WHERE  ( $search_4_these_array_id_query ) AND p2erls_gradient_region.pending_change = 'No'
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
	
	$query .= " GROUP BY site_id ORDER BY site_id ASC ";
	//echo "$query <br>";
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);
	
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
				
		if($kk==0)
		{
			$markers = $site_id;
		}
		if($kk!=0)
		{
		$markers = $markers.','.$site_id;
		} 
					 
	}
	echo"$markers"; 
}
				
?>