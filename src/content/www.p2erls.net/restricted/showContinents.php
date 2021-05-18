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
					$co_id=$_GET["co_id"];
					 
					// Display all the data from the table 
					$query_continents = "SELECT co_name FROM p2erls_continents_oceans WHERE co_id='$co_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY co_id ASC";
					$result_continents = mysql_query($query_continents);
					$co_name= mysql_result($result_continents,0,"co_name");
				} ?>
				<tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?> Continent <?php echo"$co_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$co_id";?>" name="prev_co_id" id="prev_co_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$co_id";?>" name="co_id" id="co_id" size="20"></td>
				</tr>
			<tr bgcolor="#ffffff">
			  <td>Continent / Ocean Name </td>
			  <td><input type="text" value="<?php echo"$co_name";?>" name="co_name" id="co_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showContinents.php?mode=list&co_id=<?php echo"$co_id";?>','showContinents','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_continents_oceans','co_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_continents_oceans','co_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showContinents.php?mode=new&co_id=<?php echo"$co_id";?>','showContinents','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showContinents.php?mode=list','showContinents','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_co_id=$_GET["co_id"];
			$sqlDelete="DELETE FROM p2erls_continents_oceans where co_id='$var_co_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$co_id=$_GET["co_id"]; 
			$co_name=$_GET["co_name"];			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_continents_oceans` VALUES (
				'".$co_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$co_name."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_continents_oceans` VALUES (
				'".$co_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$co_name."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_co_id=$_GET["prev_co_id"];
			$co_id=$_GET["co_id"]; 
			$co_name=$_GET["co_name"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_continents_oceans SET
				co_id='".$co_id."',
				last_updated='".$db_date."',
				co_name='".$co_name."'
				WHERE co_id='".$prev_co_id."'";
				mysql_query($query_update);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_continents_oceans` VALUES (
				'".$prev_co_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$co_name."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="9%"><b> ID </b></td>
			<td width="75%"><b> Continent / Ocean Name </b></td> 
			<td width="8%">&nbsp;</td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="8%">&nbsp;</td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table
			$query_continents = "SELECT * FROM p2erls_continents_oceans WHERE pending_change != 'Yes' ORDER BY co_id ASC";
			$result_continents = mysql_query($query_continents);
			$num_results_continents = mysql_num_rows($result_continents);
			
			for ($i=0; $i < $num_results_continents; $i++) {
				$co_id_curr= mysql_result($result_continents,$i,"co_id"); 
				$co_name_curr= mysql_result($result_continents,$i,"co_name");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$co_id_updating=$_GET["co_id"];
				
			}
			if($co_id_updating!=$co_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$co_id_curr";?></td> 
				<td><?php echo"$co_name_curr";?></td> 
				<td> <a href="javascript:requestInfo('showContinents.php?mode=update&co_id=<?php echo"$co_id_curr";?>','showContinents','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showContinents.php?mode=delete&co_id=<?php echo"$co_id_curr";?>','showContinents','');" onclick="return confirmLink(this, 'continent/ocean', '<?php echo"$co_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 