<?php 
// get the site id passed
$site_id = $_GET["site_id"];


require ("Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$query_preview = "SELECT * FROM p2erls_sites WHERE site_id = '$site_id' ORDER BY site_id ASC";
//echo "$site_id2";
//echo "$site_id";
//echo "$query_preview";  exit;
$result_preview = mysql_query($query_preview);
$num_results_preview = mysql_num_rows($result_preview); 
 if(num_results_preview != 0){
 for ($i_preview=0; $i_preview <$num_results_preview; $i_preview++)
  	{
  	$site_flyer= mysql_result($result_preview,$i_preview,"site_flyer");
	}
?>
<img src="../flyers<?php echo "$site_id"; ?>/preview.jpeg" />
<?php } ?>