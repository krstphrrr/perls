<?php
include("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

function updateSavedSearches($prev_pkey_value,$pkey_value,$pkey)
{

	if($pkey == 'select_multiple_programs')		{ $query_saved_searches = "SELECT * FROM p2erls_saved_searches WHERE select_multiple_programs != '' ORDER BY saved_search_num ASC";}
	if($pkey == 'select_multiple_networks')		{ $query_saved_searches = "SELECT * FROM p2erls_saved_searches WHERE select_multiple_networks != '' ORDER BY saved_search_num ASC";}
	if($pkey == 'select_multiple_gradients')	{ $query_saved_searches = "SELECT * FROM p2erls_saved_searches WHERE select_multiple_gradients != '' ORDER BY saved_search_num ASC";}
	if($pkey == 'select_multiple_regions')		{ $query_saved_searches = "SELECT * FROM p2erls_saved_searches WHERE select_multiple_regions != '' ORDER BY saved_search_num ASC";}
	if($pkey == 'select_multiple_ecosystems')	{ $query_saved_searches = "SELECT * FROM p2erls_saved_searches WHERE select_multiple_ecosystems != '' ORDER BY saved_search_num ASC";}
	
	$result_saved_searches = mysql_query($query_saved_searches);
	$num_results_saved_searches = mysql_num_rows($result_saved_searches);
	
	for ($i_saved_searches=0; $i_saved_searches < $num_results_saved_searches; $i_saved_searches++) 
	{
		$saved_search_num= mysql_result($result_saved_searches,$i_saved_searches,"saved_search_num"); 
		$select_multiple_programs= mysql_result($result_saved_searches,$i_saved_searches,"select_multiple_programs");
		$select_multiple_networks= mysql_result($result_saved_searches,$i_saved_searches,"select_multiple_networks");				
		$select_multiple_gradients= mysql_result($result_saved_searches,$i_saved_searches,"select_multiple_gradients");
		$select_multiple_regions= mysql_result($result_saved_searches,$i_saved_searches,"select_multiple_regions");				
		$select_multiple_ecosystems= mysql_result($result_saved_searches,$i_saved_searches,"select_multiple_ecosystems");
	
		if($pkey == 'select_multiple_programs')		{ $change_array = explode(",", $select_multiple_programs);	 }
		if($pkey == 'select_multiple_networks')		{ $change_array = explode(",", $select_multiple_networks);	 }
		if($pkey == 'select_multiple_gradients')	{ $change_array = explode(",", $select_multiple_gradients);	 }
		if($pkey == 'select_multiple_regions')		{ $change_array = explode(",", $select_multiple_regions);	 }
		if($pkey == 'select_multiple_ecosystems')	{ $change_array = explode(",", $select_multiple_ecosystems); }
		 
		$number_of_terms = count($change_array); 
		
		if($number_of_terms != "0")
		{	
			if($pkey_value != $prev_pkey_value && $change_array[0] == $prev_pkey_value)
			{
				$change_array[0] = $pkey_value;
			}
			
			$new_array = $change_array[0]; 
			
			for ($i_terms=1; $i_terms < $number_of_terms; $i_terms++)
			{ 
				if($pkey_value != $prev_pkey_value && $change_array[$i_terms] == $prev_pkey_value)
				{	
					//echo"value diff<br> $change_array[$i_terms]<br> ";
					$change_array[$i_terms] = $pkey_value;
					//echo"value diff<br> $change_array[$i_terms]<br> ";
				} 
				
				$new_array = $new_array.",".$change_array[$i_terms];
			} 
			
			$query_update_saved_search="UPDATE p2erls_saved_searches SET ".$pkey."='".$new_array."' WHERE saved_search_num='".$saved_search_num."'";
			mysql_query($query_update_saved_search);
		} 
	}
}
?>