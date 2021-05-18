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
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
			
				if($mode=="update"){
					$lb_id=$_GET["lb_id"]; 
					
					// Display all the data from the table 
					$query_landowner_bounds = "SELECT * FROM p2erls_landowner_bounds WHERE lb_id='$lb_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY lb_id ASC";
					$result_landowner_bounds = mysql_query($query_landowner_bounds);
					$num_results_landowner_bounds = mysql_num_rows($result_landowner_bounds);
					
					for ($i=0; $i < $num_results_landowner_bounds; $i++) {
						$lb_description= mysql_result($result_landowner_bounds,$i,"lb_description");
					} 
				}
				?> <tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Landowner Bounds<?php echo"$lb_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$lb_id";?>" name="prev_lb_id" id="prev_lb_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$lb_id";?>" name="lb_id" id="lb_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td colspan="2">Landowner Bounds Description               </td>
              </tr>
			<tr bgcolor="#ffffff">
			  <td colspan="2"><textarea name="lb_description" id="lb_description" cols="40" rows="10"><?php echo"$lb_description";?></textarea></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showLandowner_bounds.php?mode=list&lb_id=<?php echo"$lb_id";?>','showLandowner_bounds','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_landowner_bounds','lb_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_landowner_bounds','lb_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showLandowner_bounds.php?mode=new&lb_id=<?php echo"$lb_id";?>','showLandowner_bounds','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showLandowner_bounds.php?mode=list','showLandowner_bounds','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_lb_id=$_GET["lb_id"];
			$sqlDelete="DELETE FROM p2erls_landowner_bounds where lb_id='$var_lb_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database
		if($mode=="save_new") {
			$lb_id=$_GET["lb_id"]; 
			$db_date = date("Y-m-d H:i:s");
			$lb_description=$_GET["lb_description"];
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_landowner_bounds` VALUES (
				'".$lb_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$lb_description."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_landowner_bounds` VALUES (
				'".$lb_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$lb_description."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_lb_id=$_GET["prev_lb_id"];
			$lb_id=$_GET["lb_id"]; 
			$lb_description=$_GET["lb_description"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_landowner_bounds SET
				lb_id='".$lb_id."',
				last_updated='".$db_date."',
				lb_description='".$lb_description."'
				WHERE lb_id='".$prev_lb_id."'";
				mysql_query($query_update);
				
				$query_update_landowners="UPDATE p2erls_landowners SET lb_id='".$lb_id."' WHERE lb_id='".$prev_lb_id."'";
				mysql_query($query_update_landowners);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_landowner_bounds` VALUES (
				'".$prev_lb_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$lb_description."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="5%"><b> ID </b></td>
			<td width="69%"><b> Landowner  Bounds Description </b></td> 
			<td width="5%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="7%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_landowner_bounds = "SELECT * FROM p2erls_landowner_bounds WHERE pending_change != 'Yes' ORDER BY lb_id ASC";
			$result_landowner_bounds = mysql_query($query_landowner_bounds);
			$num_results_landowner_bounds = mysql_num_rows($result_landowner_bounds);
			
			for ($i=0; $i < $num_results_landowner_bounds; $i++) {
				$lb_id_curr= mysql_result($result_landowner_bounds,$i,"lb_id"); 
				$lb_description_curr= mysql_result($result_landowner_bounds,$i,"lb_description");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$lb_id_updating=$_GET["lb_id"];
				
			}
			if($lb_id_updating!=$lb_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$lb_id_curr";?></td> 
				<td><?php echo"$lb_description_curr";?></td> 
				<td> <a href="javascript:requestInfo('showLandowner_bounds.php?mode=update&lb_id=<?php echo"$lb_id_curr";?>','showLandowner_bounds','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showLandowner_bounds.php?mode=delete&lb_id=<?php echo"$lb_id_curr";?>','showLandowner_bounds','');" onclick="return confirmLink(this, 'landowner bound', '<?php echo"$lb_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 