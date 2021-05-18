<table width="1016">
 <?php
   	
require ("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);
  
$site_id="AA";
 
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
          <td width="533" ><b><?php echo"$landowner_name";?></b> </td>
          <td width="248" ><form> 
<?php if($num_results_get_exists!='0'){?>
            <input  onClick="showCustomer(this.checked,this.value,'<?php= $site_id; ?>','<?php= $landowner_id; ?>')" type="checkbox" name="site_landowner3_<?php echo"$landowner_id";?>" value="Yes" checked="checked" />
            <?php } ?>
            <?php if($num_results_get_exists=='0'){?>
            <input onClick="showCustomer(this.checked,this.value,'<?php= $site_id; ?>','<?php= $landowner_id; ?>')" type="checkbox" name="site_landowner3_<?php echo"$landowner_id";?>" value="Yes" />
            <?php } ?>
</form>

 

 
</td>
        <td width="219" ><div id="site_landowner_<?php echo"$landowner_id";?>">Click to Modify </div>
<div id="site_landowner2_<?php echo"$landowner_id";?>"></div></td>
        </tr>
        <?php } ?> 
		</table> 