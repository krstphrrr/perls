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
					$country_id=$_GET["country_id"];
					 
					// Display all the data from the table 
					$query_countries = "SELECT country_name FROM p2erls_countries WHERE country_id='$country_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY country_id ASC";
					$result_countries = mysql_query($query_countries);
					$country_name= mysql_result($result_countries,0,"country_name");
				} ?>
			<tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Country <?php echo"$country_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$country_id";?>" name="prev_country_id" id="prev_country_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$country_id";?>" name="country_id" id="country_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Country Name </td>
			  <td><input type="text" value="<?php echo"$country_name";?>" name="country_name" id="country_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showCountries.php?mode=list&country_id=<?php echo"$country_id";?>','showCountries','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_countries','country_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_countries','country_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showCountries.php?mode=new&country_id=<?php echo"$country_id";?>','showCountries','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showCountries.php?mode=list','showCountries','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_country_id=$_GET["country_id"];
			$sqlDelete="DELETE FROM p2erls_countries where country_id='$var_country_id'";
			$obj->query($sqlDelete);
			$sqlUpdate="UPDATE p2erls_countries set 
				country_id=''
			WHERE country_id='$var_country_id'";
			
			$obj->query($sqlUpdate);
			?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$country_id=$_GET["country_id"]; 
			$country_name=$_GET["country_name"];			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_countries` VALUES (
				'".$country_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$country_name."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_countries` VALUES (
				'".$country_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$country_name."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_country_id=$_GET["prev_country_id"];
			$country_id=$_GET["country_id"]; 
			$country_name=$_GET["country_name"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_countries SET
				country_id='".$country_id."',
				last_updated='".$db_date."',
				country_name='".$country_name."'
				WHERE country_id='".$prev_country_id."'";
				mysql_query($query_update);
				
				$query_update_sites="UPDATE p2erls_sites SET country_id='".$country_id."' WHERE country_id='".$prev_country_id."'";
				mysql_query($query_update_sites);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_countries` VALUES (
				'".$prev_country_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$country_name."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="9%"><b> ID </b></td>
			<td width="75%"><b> Country Name </b></td> 
			<td width="8%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="8%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_countries = "SELECT * FROM p2erls_countries WHERE pending_change != 'Yes' ORDER BY country_id ASC";
			$result_countries = mysql_query($query_countries);
			$num_results_countries = mysql_num_rows($result_countries);
			
			for ($i=0; $i < $num_results_countries; $i++) {
				$country_id_curr= mysql_result($result_countries,$i,"country_id"); 
				$country_name_curr= mysql_result($result_countries,$i,"country_name");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$country_id_updating=$_GET["country_id"];
				
			}
			if($country_id_updating!=$country_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$country_id_curr";?></td> 
				<td><?php echo"$country_name_curr";?></td> 
				<td> <a href="javascript:requestInfo('showCountries.php?mode=update&country_id=<?php echo"$country_id_curr";?>','showCountries','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showCountries.php?mode=delete&country_id=<?php echo"$country_id_curr";?>','showCountries','');" onclick="return confirmLink(this, 'country', '<?php echo"$country_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 