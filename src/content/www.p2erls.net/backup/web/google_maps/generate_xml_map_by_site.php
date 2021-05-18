<?php
session_start();

require ("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$mls_num=$_GET['mls_num'];
$property_type=$_GET['property_type'];
$min_price=$_GET['min_price'];
$max_price=$_GET['max_price'];
$city=$_GET['city'];
$street=$_GET['street'];
$zip_code=$_GET['zip_code'];
$features=$_GET['features'];
$area=$_GET['area'];
$min_sqft=$_GET['min_sqft'];
$beds=$_GET['beds'];
$baths=$_GET['baths'];
$age=$_GET['age'];
$lot_size=$_GET['lot_size'];
$garages=$_GET['garages'];
$listings_page=$_GET['listings_page'];
$time=$_GET['time'];

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&apos;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

  header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

/*  
$search_term_array = explode(" ", $street);
//echo"$search_term <br>"; 
$number_of_search_terms = count($search_term_array);
// echo"$number_of_search_terms <br>"; 
// This loops through each search term and adds it to query
$street_string = " ";
$search_terms = "";
$number_of_search_terms2 =$number_of_search_terms-1;
for ($jk=0; $jk <$number_of_search_terms; $jk++)
{
$street_string = $street_string." and listings_8 LIKE '%".$search_term_array[$jk]."%' ";

if($number_of_search_terms==1){
$search_terms = $search_terms.$search_term_array[$jk];
//echo"$jk end <br>"; 
}
if($jk<$number_of_search_terms2 && $number_of_search_terms!=1){
$search_terms = $search_terms.$search_term_array[$jk].', ';
//echo"$jk <br>"; 
}
if($jk==$number_of_search_terms2 && $number_of_search_terms!=1){
$search_terms = $search_terms.$search_term_array[$jk];
//echo"$jk end <br>"; 
}
 }
 
 $search_term_array2 = explode(" ", $features);
//echo"$search_term <br>"; 
$number_of_search_terms2 = count($search_term_array2);
// echo"$number_of_search_terms <br>"; 
// This loops through each search term and adds it to query
$street_string2 = " ";
$search_terms2 = "";
$number_of_search_terms22 =$number_of_search_terms2-1;
for ($jk2=0; $jk2 <$number_of_search_terms2; $jk2++)
{
$street_string2 = $street_string2." and listings_51 LIKE '%".$search_term_array2[$jk2]."%' ";

if($number_of_search_terms2==1){
$search_terms2 = $search_terms2.$search_term_array2[$jk2];
//echo"$jk end <br>"; 
}
if($jk2<$number_of_search_terms22 && $number_of_search_terms2!=1){
$search_terms2 = $search_terms2.$search_term_array2[$jk2].', ';
//echo"$jk <br>"; 
}
if($jk2==$number_of_search_terms22 && $number_of_search_terms2!=1){
$search_terms2 = $search_terms2.$search_term_array2[$jk2];
//echo"$jk end <br>"; 
}
 }
 
  
//echo"$street_string2 <br>"; 

$query_page = "SELECT * FROM steinborn_mls_listings ";
if($mls_num!='' || $property_type!='' || $min_price!='' || $max_price!='' || $city!='' || $street !='' || $zip_code!='' || $features!='' || $min_sqft!='' || $max_price!='' || $beds!=''|| $baths!='' || $area!='' || $age!='' || $lot_size!='' || $garages!=''){
$query_page .= "where "; 
}
if($mls_num!=''){ $query_page .= "mls_num = '$mls_num' "; }
if($mls_num==''){ $query_page .= "mls_num !='1' "; }
if($property_type!=''){ $query_page .= "and listings_3 = '$property_type' ";}
//if($property_type==''){ $query_page .= "and listings_3 = '%' ";}
if($min_price!=''){ $query_page .= "and listings_5 >= '$min_price' ";  } 
if($max_price!=''){ $query_page .= "and listings_5 <= '$max_price ' ";  } 
if($city!=''){ $query_page .= "and listings_10 = '$city' "; }
//if($city==''){ $query_page .= "and listings_10 = '%' "; }
if($zip_code!=''){ $query_page .= "and listings_12 = '$zip_code'  "; }
//if($zip_code==''){ $query_page .= "and listings_12 = '%'  "; }
if($min_sqft!=''){ $query_page .= "and listings_22 >= '$min_sqft' "; }
//if($min_sqft==''){ $query_page .= "and listings_22 >= '%' "; }
if($beds!=''){ $query_page .= "and listings_15 = '$beds' "; }
//if($beds==''){ $query_page .= "and listings_15 = '%' "; }
if($baths!=''){ $query_page .= "and listings_16 = '$baths' "; }
if($area!=''){ $query_page .= "and listings_4 = '$area'  "; }
if($street!=''){ $query_page .= "$street_string  "; }
if($features!=''){ $query_page .= "$street_string2  "; }
if($garages!=''){ $query_page .= "and listings_18 = '$garages' "; } 
if($lot_size!=''){ $query_page .= "and listings_19 = '$lot_size' "; } 
if($age!=''){ $query_page .= "and listings_21 = '$age' "; } 


$query_page .= "ORDER BY listings_5 desc";

if($mls_num=='' && $property_type=='' && $min_price=='' && $max_price=='' && $city=='' && $street=='' && $zip_code=='' && $features=='' && $min_sqft=='' && $max_price=='' && $beds==''&& $baths=='' && $area=='' && $age=='' && $lot_size==''&& $garages==''){
$query_page = "SELECT * FROM steinborn_mls_listings ORDER BY listings_5 desc"; 
}
*/
//echo"query_page $query_page<br>";
$site_id = $_GET['id'];
$query_page = "SELECT * FROM p2erls_sites where site_id='$site_id' ORDER BY site_id ASC"; //test only
$result = mysql_query($query_page);
$num_results = mysql_num_rows($result);
//echo"num_results $num_results<br>";


for ($i=0; $i <$num_results; $i++)
  {  
  				$site_id= mysql_result($result,$i,"site_id"); 
				$site_name= mysql_result($result,$i,"site_name");
				$site_url= mysql_result($result,$i,"site_url");
				$site_lat= mysql_result($result,$i,"site_lat");
				$site_long= mysql_result($result,$i,"site_long");
				$site_elevlow= mysql_result($result,$i,"site_elevlow");
				$site_elevhigh= mysql_result($result,$i,"site_elevhigh");
				$site_elevmean= mysql_result($result,$i,"site_elevmean");
				$site_temp= mysql_result($result,$i,"site_temp");
				$site_precip= mysql_result($result,$i,"site_precip");
				$site_desc= mysql_result($result,$i,"site_desc");
				$ecosystem_id= mysql_result($result,$i,"ecosystem_id");
				$state_id= mysql_result($result,$i,"state_id"); 
				$country_id= mysql_result($result,$i,"country_id"); 
				$site_flyer= mysql_result($result,$i,"site_flyer");
				 

//$address = "$listings_6 $listings_8 $listings_10 $listings_11 $listings_12"; 

//$photo ="https://www.steinborn.com/mls/mls_images/LASCRUCES$mls_num.jpg";

// Iterate through the rows, printing XML nodes for each 
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
				echo 'site_name="' . parseToXML($site_name) . '" ';
				echo 'site_url="' . parseToXML($site_url) . '" ';
				echo 'site_lat="' . parseToXML($site_lat) . '" ';
				echo 'site_long="' . parseToXML($site_long) . '" ';
				echo 'site_elevlow="' . parseToXML($site_elevlow) . '" ';
				echo 'site_elevhigh="' . parseToXML($site_elevhigh) . '" ';
				echo 'site_elevmean="' . parseToXML($site_elevmean) . '" ';
				echo 'site_temp="' . parseToXML($site_temp) . '" ';
				echo 'site_precip="' . parseToXML($site_precip) . '" ';
				echo 'site_desc="' . parseToXML($site_desc) . '" ';
				echo 'ecosystem_id="' . parseToXML($ecosystem_id) . '" ';
				echo 'state_id="' . parseToXML($state_id) . '" ';
				echo 'country_id="' . parseToXML($country_id) . '" ';
				echo 'site_flyer="' . parseToXML($site_flyer) . '" ';
  echo ' />';
} 
// End XML file
echo '</markers>';

?>