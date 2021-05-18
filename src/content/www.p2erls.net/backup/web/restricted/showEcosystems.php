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
				$ecosystem_id=$_GET["ecosystem_id"]; 
				
				// Display all the data from the table 
				$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE ecosystem_id='$ecosystem_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY ecosystem_id ASC";
				$result_ecosystems = mysql_query($query_ecosystems);
				$num_results_ecosystems = mysql_num_rows($result_ecosystems);
				
				for ($i=0; $i < $num_results_ecosystems; $i++) {
					$ecosystem_name= mysql_result($result_ecosystems,$i,"ecosystem_name");
					$ecosystem_description= mysql_result($result_ecosystems,$i,"ecosystem_description");
				} 
			}
				?> <tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?> Ecosystem <?php echo"$ecosystem_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$ecosystem_id";?>" name="prev_ecosystem_id" id="prev_ecosystem_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$ecosystem_id";?>" name="ecosystem_id" id="ecosystem_id" size="20"></td>
				</tr>
			<tr bgcolor="#ffffff">
			  <td>Ecosystem Name </td>
			  <td><input type="text" value="<?php echo"$ecosystem_name";?>" name="ecosystem_name" id="ecosystem_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>Ecosystem Description </td>
              <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td colspan="2"><textarea name="ecosystem_description" cols="40" rows="10" id="ecosystem_description"><?php echo"$ecosystem_description";?></textarea></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showEcosystems.php?mode=list&ecosystem_id=<?php echo"$ecosystem_id";?>','showEcosystems','')">Cancel</a> ||
			   <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_ecosystems','ecosystem_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_ecosystems','ecosystem_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showEcosystems.php?mode=new&ecosystem_id=<?php echo"$ecosystem_id";?>','showEcosystems','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showEcosystems.php?mode=list','showEcosystems','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_ecosystem_id=$_GET["ecosystem_id"];
			$sqlDelete="DELETE FROM p2erls_ecosystems where ecosystem_id='$var_ecosystem_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$ecosystem_id=$_GET["ecosystem_id"];
			$ecosystem_name=$_GET["ecosystem_name"];
			$ecosystem_description=$_GET["ecosystem_description"];
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_ecosystems` VALUES (
				'".$ecosystem_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$ecosystem_name."',
				'".$ecosystem_description."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_ecosystems` VALUES (
				'".$ecosystem_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$ecosystem_name."',
				'".$ecosystem_description."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_ecosystem_id=$_GET["prev_ecosystem_id"];
			$ecosystem_id=$_GET["ecosystem_id"]; 
			$ecosystem_name=$_GET["ecosystem_name"];
			$ecosystem_description=$_GET["ecosystem_description"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_ecosystems SET
				ecosystem_id='".$ecosystem_id."',
				last_updated='".$db_date."',
				ecosystem_name='".$ecosystem_name."',
				ecosystem_description='".$ecosystem_description."'
				WHERE ecosystem_id='".$prev_ecosystem_id."'";
				mysql_query($query_update);
				
				$query_update_sites="UPDATE p2erls_sites SET ecosystem_id='".$ecosystem_id."' WHERE ecosystem_id='".$prev_ecosystem_id."'";
				mysql_query($query_update_sites);
				
				 
					require("includes/update_saved_searches.php");
					updateSavedSearches($prev_ecosystem_id,$ecosystem_id,'select_multiple_ecosystems');
				 
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_ecosystems` VALUES (
				'".$prev_ecosystem_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$ecosystem_name."',
				'".$ecosystem_description."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="6%"><b> ID </b></td>
			<td width="18%"><b> Ecosystem Name </b></td> 
			<td width="62%"><b>Ecosystem Description </b></td>
			<td width="7%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="7%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE pending_change != 'Yes' ORDER BY ecosystem_id ASC";
			$result_ecosystems = mysql_query($query_ecosystems);
			$num_results_ecosystems = mysql_num_rows($result_ecosystems);
			
			for ($i=0; $i < $num_results_ecosystems; $i++) {
				$ecosystem_id_curr= mysql_result($result_ecosystems,$i,"ecosystem_id"); 
				$ecosystem_name_curr= mysql_result($result_ecosystems,$i,"ecosystem_name");
				$ecosystem_description_curr= mysql_result($result_ecosystems,$i,"ecosystem_description"); 
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$ecosystem_id_updating=$_GET["ecosystem_id"];
				
			}
			if($ecosystem_id_updating!=$ecosystem_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$ecosystem_id_curr";?></td> 
				<td><?php echo"$ecosystem_name_curr";?></td>
				<td><?php echo"$ecosystem_description_curr";?></td> 
				<td> <a href="javascript:requestInfo('showEcosystems.php?mode=update&ecosystem_id=<?php echo"$ecosystem_id_curr";?>','showEcosystems','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="7%"><a href="javascript:requestInfo('showEcosystems.php?mode=delete&ecosystem_id=<?php echo"$ecosystem_id_curr";?>','showEcosystems','');" onclick="return confirmLink(this, 'ecosystem', '<?php echo"$ecosystem_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 