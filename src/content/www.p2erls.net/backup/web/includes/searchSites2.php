<?php 

require ("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
		
$search_sites="10,100,200,260,333";

if($search_sites!='')
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
	
	$query_sites = "SELECT * FROM p2erls_sites where $search_4_these_sites_id_query ORDER BY site_id ASC"; 
	$result_sites = mysql_query($query_sites);
	$num_results_sites = mysql_num_rows($result_sites); 
	
	//echo"query_sites: $query_sites <br>";
	//echo"num_results_sites: $num_results_sites <br>";
}

?>