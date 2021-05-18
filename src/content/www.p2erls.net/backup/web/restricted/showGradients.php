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
		  <?php if($mode=='assc_gradient_regions') {
		  $gradient_id= $_GET["gradient_id"];
		  ?>
         <h3 align="center">Regions for this Gradient </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showGradients.php?mode=list&gradient_id=<?php echo"$gradient_id";?>','showGradients','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Regions</b></td>
          <td colspan="2" ><b>Check if Gradient Contains Region </b></td>
          </tr>
		<?php 
 
   	
 $query_gradient_region = "SELECT * FROM p2erls_regions ORDER BY region_id ASC"; 

$result_gradient_region = mysql_query($query_gradient_region);
$num_results_gradient_region= mysql_num_rows($result_gradient_region); 
?>
        <?php  
		 for ($i_gradient_region=0; $i_gradient_region <$num_results_gradient_region; $i_gradient_region++)
  {

$region_id= mysql_result($result_gradient_region,$i_gradient_region,"region_id");
$region_name= mysql_result($result_gradient_region,$i_gradient_region,"region_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_gradient_region WHERE pending_change!='Yes' AND gradient_id='$gradient_id' AND region_id='$region_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="563" ><?php echo"$region_name";?></td>
          <td width="219" ><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_gradient_region WHERE pending_change='Yes' AND account_num!='0' AND gradient_id='$gradient_id' AND region_id='$region_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$region_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_gradient_region','gradient_id','<?php echo "$gradient_id"; ?>','region_id','<?php echo "$region_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$region_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_gradient_region','gradient_id','<?php echo "$gradient_id"; ?>','region_id','<?php echo "$region_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$region_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
        <td width="276" ><div id="result_action_<?php echo "$region_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		} ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showGradients.php?mode=list&gradient_id=<?php echo"$gradient_id";?>','showGradients','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
			
			if($mode=="update"){
				$gradient_id=$_GET["gradient_id"]; 
				
				// Display all the data from the table 
				$query_gradients = "SELECT * FROM p2erls_gradients WHERE gradient_id='$gradient_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY gradient_id ASC";
				$result_gradients = mysql_query($query_gradients);
				$num_results_gradients = mysql_num_rows($result_gradients);
				
				for ($i=0; $i < $num_results_gradients; $i++) {
					$gradient_name= mysql_result($result_gradients,$i,"gradient_name");
					$gradient_desc= mysql_result($result_gradients,$i,"gradient_desc");
				} 
			}
				?> 
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Gradient <?php echo"$gradient_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$gradient_id";?>" name="prev_gradient_id" id="prev_gradient_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$gradient_id";?>" name="gradient_id" id="gradient_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Gradient Name </td>
			  <td><input type="text" value="<?php echo"$gradient_name";?>" name="gradient_name" id="gradient_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td colspan="2">Gradient Description</td>
              </tr>
			<tr bgcolor="#ffffff">
			  <td colspan="2"><textarea name="gradient_desc" id="gradient_desc" cols="40" rows="10"><?php echo"$gradient_desc";?></textarea></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
			  </tr>
			<?php if($mode=='update') {?>
			<tr bgcolor="#ffffff">
              <td colspan="2"><a href="javascript:requestInfo('showGradients.php?mode=assc_gradient_regions&gradient_id=<?php echo"$gradient_id";?>','showGradients','')">Modify Regions </a></td>
			  </tr>
			<?php } ?>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showGradients.php?mode=list&gradient_id=<?php echo"$gradient_id";?>','showGradients','')">Cancel</a> ||
				  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_gradients','gradient_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_gradients','gradient_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showGradients.php?mode=new&gradient_id=<?php echo"$gradient_id";?>','showGradients','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showGradients.php?mode=list','showGradients','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_gradient_id=$_GET["gradient_id"];
			$sqlDelete="DELETE FROM p2erls_gradients where gradient_id='$var_gradient_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		 // After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$gradient_id=$_GET["gradient_id"];
			$gradient_name=$_GET["gradient_name"];
			$gradient_desc=$_GET["gradient_desc"];
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_gradients` VALUES (
				'".$gradient_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$gradient_name."',
				'".$gradient_desc."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_gradients` VALUES (
				'".$gradient_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$gradient_name."',
				'".$gradient_desc."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_gradient_id=$_GET["prev_gradient_id"];
			$gradient_id=$_GET["gradient_id"]; 
			$gradient_name=$_GET["gradient_name"];
			$gradient_desc=$_GET["gradient_desc"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_gradients SET
				gradient_id='".$gradient_id."',
				last_updated='".$db_date."',
				gradient_name='".$gradient_name."',
				gradient_desc='".$gradient_desc."'
				WHERE gradient_id='".$prev_gradient_id."'";
				mysql_query($query_update);
				
				$query_update_sites="UPDATE p2erls_sites SET gradient_id='".$gradient_id."' WHERE gradient_id='".$prev_gradient_id."'";
				mysql_query($query_update_sites);
				
				 
					require("includes/update_saved_searches.php");
					updateSavedSearches($prev_gradient_id,$gradient_id,'select_multiple_gradients');
				 
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_gradients` VALUES (
				'".$prev_gradient_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$gradient_name."',
				'".$gradient_desc."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="4%"><b> ID </b></td>
			<td width="17%"><b> Gradient Name </b></td> 
			<td width="65%"><b> Gradient Description</b></td> 
			<td width="8%">&nbsp;  </td>
			<td width="6%">&nbsp;  </td>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_gradients = "SELECT * FROM p2erls_gradients WHERE pending_change != 'Yes' ORDER BY gradient_id ASC";
			$result_gradients = mysql_query($query_gradients);
			$num_results_gradients = mysql_num_rows($result_gradients);
			
			for ($i=0; $i < $num_results_gradients; $i++) {
				$gradient_id_curr= mysql_result($result_gradients,$i,"gradient_id"); 
				$gradient_name_curr= mysql_result($result_gradients,$i,"gradient_name");
				$gradient_desc_curr= mysql_result($result_gradients,$i,"gradient_desc"); 
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$gradient_id_updating=$_GET["gradient_id"];
				
			}
			if($gradient_id_updating!=$gradient_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$gradient_id_curr";?></td> 
				<td><?php echo"$gradient_name_curr";?></td>
				<td><?php echo"$gradient_desc_curr";?></td> 
				<td> <a href="javascript:requestInfo('showGradients.php?mode=update&gradient_id=<?php echo"$gradient_id_curr";?>','showGradients','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="6%"><a href="javascript:requestInfo('showGradients.php?mode=delete&gradient_id=<?php echo"$gradient_id_curr";?>','showGradients','');" onclick="return confirmLink(this, 'gradient', '<?php echo"$gradient_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 