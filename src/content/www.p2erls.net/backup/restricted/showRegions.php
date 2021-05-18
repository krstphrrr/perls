<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
?>
<?php
require("Security_Dept/config.php");
include("includes/mysql.lib.php");
$obj=new connect;
$mode=$_GET["mode"];
?>
		<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#eeeeee" align="center" >
		<tr>
		  <td colspan=11>
		  <?php if($mode=='assc_region_co') {
		  $region_id= $_GET["region_id"];
		  ?>
         <h3 align="center">Continent / Oceans for This Region </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showRegions.php?mode=list&region_id=<?php echo"$region_id";?>','showRegions','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Continent / Ocean</b></td>
          <td colspan="2" ><b>Check if Region Contains Continent / Oceans</b></td>
          </tr>
		<?php 
 
   	
 $query_region_co = "SELECT * FROM p2erls_continents_oceans ORDER BY co_id ASC"; 

$result_region_co = mysql_query($query_region_co);
$num_results_region_co= mysql_num_rows($result_region_co); 
?>
        <?php  
		 for ($i_region_co=0; $i_region_co <$num_results_region_co; $i_region_co++)
  {

$co_id= mysql_result($result_region_co,$i_region_co,"co_id");
$co_name= mysql_result($result_region_co,$i_region_co,"co_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_region_co WHERE pending_change!='Yes' AND region_id = '$region_id' AND co_id='$co_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="563" ><?php echo"$co_name";?></td>
          <td width="219" ><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_region_co WHERE pending_change='Yes' AND account_num!='0' AND region_id='$region_id' AND co_id='$co_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$co_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_region_co','region_id','<?php echo "$region_id"; ?>','co_id','<?php echo "$co_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$co_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_region_co','region_id','<?php echo "$region_id"; ?>','co_id','<?php echo "$co_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$co_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
        <td width="276" ><div id="result_action_<?php echo "$co_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		} ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showRegions.php?mode=list&region_id=<?php echo"$region_id";?>','showRegions','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
			
				if($mode=="update"){
					$region_id=$_GET["region_id"]; 
					
					// Display all the data from the table 
					$query_regions = "SELECT * FROM p2erls_regions WHERE region_id='$region_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY region_id ASC";
					$result_regions = mysql_query($query_regions);
					$num_results_regions = mysql_num_rows($result_regions);
					
					for ($i=0; $i < $num_results_regions; $i++) {
						$region_name= mysql_result($result_regions,$i,"region_name");
					} 
				}
				?> 
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Region <?php echo"$region_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$region_id";?>" name="prev_region_id" id="prev_region_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$region_id";?>" name="region_id" id="region_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Region Name </td>
			  <td><input type="text" value="<?php echo"$region_name";?>" name="region_name" id="region_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showRegions.php?mode=assc_region_co&region_id=<?php echo"$region_id";?>','showRegions','')">Modify Continets / Oceans</a></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showRegions.php?mode=list&region_id=<?php echo"$region_id";?>','showRegions','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_regions','region_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_regions','region_id');">Save</a>
				<?php } ?>
			  </td>
              </tr>
		  </table>  
		  </td></tr>
		<tr>
		  <td colspan=11>&nbsp;</td>
		  </tr>
		<?php } ?>
		
		
		<tr>
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showRegions.php?mode=new&region_id=<?php echo"$region_id";?>','showRegions','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showRegions.php?mode=list','showRegions','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_region_id=$_GET["region_id"];
			$sqlDelete="DELETE FROM p2erls_regions where region_id='$var_region_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$region_id=$_GET["region_id"];
			$region_name=$_GET["region_name"];
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_regions` VALUES (
				'".$region_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$region_name."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_regions` VALUES (
				'".$region_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$region_name."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_region_id=$_GET["prev_region_id"];
			$region_id=$_GET["region_id"]; 
			$region_name=$_GET["region_name"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_regions SET
				region_id='".$region_id."',
				last_updated='".$db_date."',
				region_name='".$region_name."'
				WHERE region_id='".$prev_region_id."'";
				mysql_query($query_update);
				
				$query_update_co_assc="UPDATE p2erls_region_co SET region_id='".$region_id."' WHERE region_id='".$prev_region_id."'";
				mysql_query($query_update_co_assc);
				
				$query_update_gradient_assc="UPDATE p2erls_gradient_regions SET region_id='".$region_id."' WHERE region_id='".$prev_region_id."'";
				mysql_query($query_update_gradient_assc);
				
				 
					require("includes/update_saved_searches.php");
					updateSavedSearches($prev_region_id,$region_id,'select_multiple_regions');
				 
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_regions` VALUES (
				'".$prev_region_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$region_name."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="9%"><b> ID </b></td>
			<td width="75%"><b> Region Name </b></td> 
			<td width="8%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="8%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_regions = "SELECT * FROM p2erls_regions WHERE pending_change != 'Yes' ORDER BY region_id ASC";
			$result_regions = mysql_query($query_regions);
			$num_results_regions = mysql_num_rows($result_regions);
			
			for ($i=0; $i < $num_results_regions; $i++) {
				$region_id_curr= mysql_result($result_regions,$i,"region_id"); 
				$region_name_curr= mysql_result($result_regions,$i,"region_name");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$region_id_updating=$_GET["region_id"];
				
			}
			if($region_id_updating!=$region_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$region_id_curr";?></td> 
				<td><?php echo"$region_name_curr";?></td> 
				<td> <a href="javascript:requestInfo('showRegions.php?mode=update&region_id=<?php echo"$region_id_curr";?>','showRegions','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showRegions.php?mode=delete&region_id=<?php echo"$region_id_curr";?>','showRegions','');" onclick="return confirmLink(this, 'region', '<?php echo"$region_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 