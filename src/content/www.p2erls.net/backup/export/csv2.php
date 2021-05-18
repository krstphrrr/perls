<?php
require("../restricted/Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$big_var = $_POST["big_var"];

//site_id = 'CHDM' AND site_id = 'CBLK' AND site_id = 'LKANN' AND site_id = 'LKEU' AND site_id = 'LKKN' AND site_id = 'LKM' AND site_id = 'LKPA' AND site_id = 'LKRT' AND site_id = 'LKSUN' AND site_id = 'LKTA' AND site_id = 'SOYL' AND site_id = 'SPLK' AND site_id = 'TBLK' AND site_id = 'TRLK' AND site_id = 'YYLK

$x = str_replace("_", "' OR site_id = '", $big_var);
$parameters = "WHERE site_id = '".$x."'";


@ob_start();
$content_file = "";
$content_file .= "site_id,site_name,site_url,site_lat,site_long,site_elevlow,site_elevhigh,site_elevmean,site_temp,site_precip,site_desc,ecosystem_id,state_id,country_id, \r\n";
$sql = "select site_id, site_name, site_url, site_lat, site_long, site_elevlow, site_elevhigh, site_elevmean, site_temp, site_precip, site_desc, ecosystem_id, state_id, country_id from p2erls_sites $parameters";
$statement = mysql_query($sql);
while($row = mysql_fetch_array($statement)) {
$content_file .= $row['site_id'] . ',' . $row['site_name'] . ',' . $row['site_url'] . ',' . $row['site_lat'] . ',' . $row['site_long'] . ',' . $row['site_elevlow'] . ',' . $row['site_elevhigh'] . ',' . $row['site_elevmean'] . ',' . $row['site_temp'] . ',' . $row['site_precip'] . ',' . $row['site_desc'] . ',' . $row['ecosystem_id'] . ',' . $row['state_id'] . ',' . $row['country_id'] . "\r\n";
}
$date = date('dSFYhis');
$output_file = 'p2erls_' .$date. '.csv';
@ob_end_clean();
@ini_set('zlib.output_compression', 'Off');
header('Pragma: public');
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header('Content-Transfer-Encoding: none');
//This should work for IE & Opera
header('Content-Type: application/octetstream; name="' . $output_file . '"');
//This should work for the rest
header('Content-Type: application/octet-stream; name="' . $output_file . '"');
header('Content-Disposition: attachment; filename="' . $output_file . '"');
echo $content_file;
exit();
?>