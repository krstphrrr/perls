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
				if ($mode=="update")
				{
					$state_id=$_GET["state_id"];
					 
					// Display all the data from the table 
					$query_states = "SELECT state_name FROM p2erls_states WHERE state_id='$state_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY state_id ASC";
					$result_states = mysql_query($query_states);
					$state_name= mysql_result($result_states,0,"state_name");
				} ?>
			<tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    State <?php echo"$state_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$state_id";?>" name="prev_state_id" id="prev_state_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$state_id";?>" name="state_id" id="state_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>State Name </td>
			  <td><input type="text" value="<?php echo"$state_name";?>" name="state_name" id="state_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showStates.php?mode=list&state_id=<?php echo"$state_id";?>','showStates','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_states','state_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_states','state_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showStates.php?mode=new&state_id=<?php echo"$state_id";?>','showStates','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showStates.php?mode=list','showStates','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_state_id=$_GET["state_id"];
			$sqlDelete="DELETE FROM p2erls_states where state_id='$var_state_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		<?php 
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$state_id=$_GET["state_id"]; 
			$state_name=$_GET["state_name"];			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_states` VALUES (
				'".$state_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$state_name."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_states` VALUES (
				'".$state_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$state_name."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_state_id=$_GET["prev_state_id"];
			$state_id=$_GET["state_id"]; 
			$state_name=$_GET["state_name"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_states SET
				state_id='".$state_id."',
				last_updated='".$db_date."',
				state_name='".$state_name."'
				WHERE state_id='".$prev_state_id."'";
				mysql_query($query_update);
				
				$query_update_sites="UPDATE p2erls_sites SET state_id='".$state_id."' WHERE state_id='".$prev_state_id."'";
				mysql_query($query_update_sites);
				
				$query_update_landowners="UPDATE p2erls_landowners SET state_id='".$state_id."' WHERE state_id='".$prev_state_id."'";
				mysql_query($query_update_landowners);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_states` VALUES (
				'".$prev_state_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$state_name."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="9%"><b> ID </b></td>
			<td width="75%"><b> State Name </b></td> 
			<td width="8%">&nbsp;  </td>
			<?php if ($_SESSION[p2erls_access_level] == "1") { ?><td width="8%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_states = "SELECT * FROM p2erls_states WHERE pending_change != 'Yes' ORDER BY state_id ASC";
			$result_states = mysql_query($query_states);
			$num_results_states = mysql_num_rows($result_states);
			
			for ($i=0; $i < $num_results_states; $i++) {
				$state_id_curr= mysql_result($result_states,$i,"state_id"); 
				$state_name_curr= mysql_result($result_states,$i,"state_name");
			
				// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
				if($mode=="update") {
					$state_id_updating=$_GET["state_id"];
					
				}
			if($state_id_updating!=$state_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$state_id_curr";?></td> 
				<td><?php echo"$state_name_curr";?></td> 
				<td> <a href="javascript:requestInfo('showStates.php?mode=update&state_id=<?php echo"$state_id_curr";?>','showStates','')">Update</a> </td>
				<?php if ($_SESSION[p2erls_access_level] == "1") { ?><td><a href="javascript:requestInfo('showStates.php?mode=delete&state_id=<?php echo"$state_id_curr";?>','showStates','');" onclick="return confirmLink(this, 'state', '<?php echo"$state_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 