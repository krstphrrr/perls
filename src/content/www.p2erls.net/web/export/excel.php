<?php
/////////////functions for excel headers/footers
// Functions for export to excel.
function xlsBOF() {
echo pack("vvvvvv", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("vv", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("vvvvv", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("vvvvvv", 0x204, 8 + $L, $Row, $Col, 0x00, $L);
echo $Value;
return;
} 
//////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
//Get the fields to make the file from
//////////////////////////////////////////////////////////////////////

$big_var = $_POST["big_var"];

$x = str_replace("_", "' OR site_id = '", $big_var);
$parameters = "WHERE site_id = '".$x."'";
////////////////////////////////////////////////////////
$date = date('dSFYhis');
require("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);




// Query Database
$sql = "select site_id, site_name, site_url, site_lat, site_long, site_elevlow, site_elevhigh, site_elevmean, site_temp, site_precip, site_desc, ecosystem_id, state_id, country_id from p2erls_sites $parameters ";
//echo"$sql"; exit;
    $result	=	mysql_query($sql);
	$num_results = mysql_num_rows($result);
    // Send Header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=p2erls_$date.xls "); // à¹à¸¥à¹‰à¸§à¸™à¸µà¹ˆà¸à¹‡à¸Šà¸·à¹ˆà¸­à¹„à¸Ÿà¸¥à¹Œ
    header("Content-Transfer-Encoding: binary ");

   /*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsBOF();

xlsWriteLabel(0,0,"P2erls Sites");

// Make column labels. (at line 3)
xlsWriteLabel(2,0,"Id");
xlsWriteLabel(2,1,"Name");
xlsWriteLabel(2,2,"URL");
xlsWriteLabel(2,3,"Latitude");
xlsWriteLabel(2,4,"Longitude");
xlsWriteLabel(2,5,"Low Elevation");
xlsWriteLabel(2,6,"High Elevation");
xlsWriteLabel(2,7,"Mean Elevation");
xlsWriteLabel(2,8,"Temperature");
xlsWriteLabel(2,9,"Precipitation");
xlsWriteLabel(2,10,"Description");
xlsWriteLabel(2,11,"Ecosystem");
xlsWriteLabel(2,12,"State");
xlsWriteLabel(2,13,"Country"); 

$xlsRow = 3;//$num_results;


// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
xlsWriteLabel($xlsRow,0,$row['site_id']);
xlsWriteLabel($xlsRow,1,$row['site_name']);
xlsWriteLabel($xlsRow,2,$row['site_url']);
xlsWriteNumber($xlsRow,3,$row['site_lat']);
xlsWriteNumber($xlsRow,4,$row['site_long']); 
xlsWriteNumber($xlsRow,5,$row['site_elevlow']);
xlsWriteNumber($xlsRow,6,$row['site_elevhigh']);
xlsWriteNumber($xlsRow,7,$row['site_elevmean']);
xlsWriteNumber($xlsRow,8,$row['site_temp']);
xlsWriteNumber($xlsRow,9,$row['site_precip']);
xlsWriteLabel($xlsRow,10,$row['site_desc']);
xlsWriteLabel($xlsRow,11,$row['ecosystem_id']);
xlsWriteLabel($xlsRow,12,$row['state_id']);
xlsWriteLabel($xlsRow,13,$row['country_id']);

$xlsRow++;
}
xlsEOF();
exit();