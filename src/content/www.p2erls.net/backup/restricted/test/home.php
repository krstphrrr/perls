<?php  
// Get Page Name
$page_name = 'home.php';

// Connect to DB
require ("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);


 		 
			  $site_id=$_GET["site_id"]; 
				$landowner_id=$_GET["landowner_id"];
				$value=$_GET["value"];
				  
				  echo"site_id $site_id <br>";
				  echo"landowner_id $landowner_id <br>";
				  echo"value $value <br>";
				  if($value='Yes'){
			$query="INSERT INTO p2erls_site_landowner VALUES(
				'$site_id', 
				'$landowner_id'
			)";
			 mysql_query($query);
			}
			else
			{
			$var_site_id=$_GET["site_id"];
			$var_landowner_id=$_GET["landowner_id"];
			$query="DELETE FROM p2erls_site_landowner where site_id='$var_site_id' and landowner_id='$var_landowner_id'"; 
			mysql_query($query);
			} 
 
	
	  
 ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="lead_table">
  <tr>
    <th colspan="2">&nbsp; </th>
  </tr>
  <?php
   	
  
 
$query_land_owners = "SELECT * FROM p2erls_landowners ORDER BY landowner_id ASC"; 

$result_land_owners = mysql_query($query_land_owners);
$num_results_land_owners= mysql_num_rows($result_land_owners); 
?>
        <?php  
		 for ($i_land_owners=0; $i_land_owners <$num_results_land_owners; $i_land_owners++)
  {

$landowner_id= mysql_result($result_land_owners,$i_land_owners,"landowner_id");
$landowner_name= mysql_result($result_land_owners,$i_land_owners,"landowner_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_site_landowner where site_id = '$site_id' and landowner_id='$landowner_id' ";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="153" ><b><?php echo"$landowner_name";?></b> </td>
          <td colspan="2" >
		  <select name="<?php= 'landowner_name'.$i_land_owners; ?>" onchange="UPDATELead(<?php= $site_id; ?>,this.value,<?php= $landowner_id; ?>,'<?php= $page_name; ?>')">
                <option value="'"<?php if($num_results_get_exists == 0){ echo ' selected="selected"'; } ?>>No</option>
                <option value="<?php= $landowner_id; ?>"<?php if($num_results_get_exists != 0){ echo ' selected="selected"'; } ?>><?php echo "$landowner_name"; ?></option>
            
              </select><div id="site_landowner_<?php echo"$landowner_id";?>"></div></td>
        </tr>
        <?php } ?>
		
		 
</table>
