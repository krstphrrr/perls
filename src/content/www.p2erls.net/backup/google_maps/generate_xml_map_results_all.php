<?php
session_start();

require ("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

function parseToXML($xmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$xmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
//$xmlStr=str_replace('(','',$xmlStr); 
//$xmlStr=str_replace(')','',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr); 
//$xmlStr=str_replace('-','',$xmlStr); 
$xmlStr=str_replace("'",'&apos;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr);   
//$xmlStr=str_replace("ñ",'n',$xmlStr); 
return $xmlStr; 
} 

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';
 
$query_page = "SELECT * FROM p2erls_sites ORDER BY site_id ASC"; //test only
$result = mysql_query($query_page);
$num_results = mysql_num_rows($result);
// echo"num_results $num_results<br>";


for ($i=0; $i < $num_results ; $i++)
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
				 

 
// Iterate through the rows, printing XML nodes for each 
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
 				echo 'site_id="' . parseToXML($site_id) . '" ';
				echo 'site_name="' . parseToXML($site_name) . '" ';
				echo 'site_url="' . parseToXML($site_url) . '" ';
				echo 'site_lat="' . parseToXML($site_lat) . '" ';
				echo 'site_long="' . parseToXML($site_long) . '" ';
				echo 'site_flyer="' . parseToXML($site_flyer) . '" ';
				/*
				echo 'site_id="' . parseToXML($site_id) . '" ';
				echo 'site_name="' . parseToXML($site_name) . '" ';
				echo 'site_url="' . parseToXML($site_url) . '" ';
				echo 'site_lat="' . parseToXML($site_lat) . '" ';
				echo 'site_long="' . parseToXML($site_long) . '" ';
				*/
				//echo 'site_elevlow="' . parseToXML($site_elevlow) . '" ';
				//echo 'site_elevhigh="' . parseToXML($site_elevhigh) . '" ';
				//echo 'site_elevmean="' . parseToXML($site_elevmean) . '" ';
				//echo 'site_temp="' . parseToXML($site_temp) . '" ';
				//echo 'site_precip="' . parseToXML($site_precip) . '" ';
				//echo 'site_desc="' . parseToXML($site_desc) . '" ';
				//echo 'ecosystem_id="' . parseToXML($ecosystem_id) . '" ';
				//echo 'state_id="' . parseToXML($state_id) . '" ';
				//echo 'country_id="' . parseToXML($country_id) . '" ';
  echo ' />';
} 
// End XML file
echo '</markers>';

?>