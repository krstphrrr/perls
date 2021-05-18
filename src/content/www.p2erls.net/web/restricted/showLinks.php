<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
?>
<script type="text/JavaScript" src="../includes/jump_menu.js"></script>
<script type="text/javascript" src="../includes/javascript/prototype.js"></script>
<script type="text/javascript" language="javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" language="javascript" djConfig="parseOnLoad: true, isDebug: true" src="../includes/dojo/dojo/dojo.js"></script>
<script type="text/javascript" language="javascript">
dojo.require("dojo.io.iframe"); 
dojo.require("dijit.ProgressBar"); 
dojo.require("dijit.form.Button"); 
dojo.require("dojo.parser");
</script>
<script type="text/javascript" language="javascript" src="../includes/ajax_photo_insert.js"></script>

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
					$link_id=$_GET["link_id"];
					 
					// Display all the data from the table 
					$query_links = "SELECT * FROM p2erls_links WHERE link_id='$link_id' AND pending_change != 'Yes' ORDER BY link_id ASC";
					$result_links = mysql_query($query_links);
					$num_results_links = mysql_num_rows($result_links); 
					 for ($i_links=0; $i_links <$num_results_links; $i_links++)
					 {
						$link_name= mysql_result($result_links,$i_links,"link_name");
						$link_url= mysql_result($result_links,$i_links,"link_url");
						$link_cat= mysql_result($result_links,$i_links,"link_cat");
						$link_global= mysql_result($result_links,$i_links,"link_global");
						$link_homepg= mysql_result($result_links,$i_links,"link_homepg");
					 }
				} ?>
				<tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?> Link <?php echo"$link_name";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
				<input type="hidden" value="<?php echo"$link_id";?>" name="link_id" id="link_id">
				<input type="hidden" value="<?php echo"$link_id";?>" name="prev_link_id" id="prev_link_id">
				<td width="153">Link Name  </td>
				<td width="281"><input type="text" value="<?php echo"$link_name";?>" name="link_name" id="link_name" size="20"></td>
				</tr>
			<tr bgcolor="#ffffff">
			  <td>Link Url  </td>
			  <td><input type="text" value="<?php echo"$link_url";?>" name="link_url" id="link_url" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			    <td>Category:</td>
			    <td><select name="link_cat" id="link_cat">
				<option value="" selected="selected">Select</option>
				<option value="U.S. National" <?php if($link_cat == "U.S. National"){ ?> selected="selected"<?php } ?>>U.S. National</option>
				<option value="U.S. Regional" <?php if($link_cat == "U.S. Regional"){ ?> selected="selected"<?php } ?>>U.S. Regional</option>
				<option value="International" <?php if($link_cat == "International"){ ?> selected="selected"<?php } ?>>International</option>

			        </select>
			    </td>
			    </tr>
			<tr bgcolor="#ffffff">
			  <td>Global Link </td>
			  <td><input type="checkbox" value="Yes" name="link_global" id="link_global" <?php if($link_global == "Yes"){ ?> checked<?php } ?>></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Show on Homepage </td>
			  <td><input type="checkbox" value="Yes" name="link_homepg" id="link_homepg" <?php if($link_homepg == "Yes"){ ?> checked<?php } ?>></td>
			  </tr>
			
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showLinks.php?mode=list&link_id=<?php echo"$link_id";?>','showLinks','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_links','link_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_links','link_id');">Save</a>
				<?php } ?>			  </td>
            </tr>
		  </table>  
		  </td></tr>
		<tr>
		  <td colspan=11>&nbsp;</td>
		  </tr>
		<?php } ?>
		
		
		<tr>
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showLinks.php?mode=new&link_id=<?php echo"$link_id";?>','showLinks','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showLinks.php?mode=list','showLinks','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_link_id=$_GET["link_id"];
			$sqlDelete="DELETE FROM p2erls_links where link_id='$var_link_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$link_id		=$_GET["link_id"]; 
			$link_name		=$_GET["link_name"];	
			$link_url		=$_GET["link_url"];		
			$link_cat		=$_GET["link_cat"];		
			$link_global	=$_GET["link_global"];	
			$link_homepg	=$_GET["link_homepg"];	
			$db_date 		= date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_links` VALUES (
				'".$link_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$link_name."',
				'".$link_url."',
				'".$link_cat."',
				'".$link_global."',
				'".$link_homepg."'
				)";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_links` VALUES (
				'".$link_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'".$link_name."',
				'".$link_url."',
				'".$link_cat."',
				'".$link_global."',
				'".$link_homepg."'
				')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_link_id	=$_GET["prev_link_id"];
			$link_id		=$_GET["link_id"]; 
			$link_name		=$_GET["link_name"];
			$link_url		=$_GET["link_url"];
			$link_cat		=$_GET["link_cat"];	
			$link_global	=$_GET["link_global"];	
			$link_homepg	=$_GET["link_homepg"];	

			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_links SET
				link_id='".$link_id."',
				last_updated='".$db_date."',
				link_name='".$link_name."',
				link_url='".$link_url."',
				link_cat='".$link_cat."',
				link_global='".$link_global."',
				link_homepg='".$link_homepg."'
				WHERE link_id='$prev_link_id'";
				//echo"$query_update";
				mysql_query($query_update);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_links` VALUES (
				'".$prev_link_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$link_name."',
				'".$link_url."',
				'".$link_cat."',
				'".$link_global."',
				'".$link_homepg."'
				)";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="9%"><b> Name </b></td>
			<td width="75%"><b> URL </b></td> 
			<td width="8%">&nbsp;</td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="8%">&nbsp;</td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table
			$query_links = "SELECT * FROM p2erls_links WHERE pending_change != 'Yes' ORDER BY link_id ASC";
			$result_links = mysql_query($query_links);
			$num_results_links = mysql_num_rows($result_links);
			
			for ($i=0; $i < $num_results_links; $i++) {
				$link_id_curr= mysql_result($result_links,$i,"link_id"); 
				$link_name_curr= mysql_result($result_links,$i,"link_name");
				$link_url_curr= mysql_result($result_links,$i,"link_url");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$link_id_updating=$_GET["link_id"];
				
			}
			if($link_id_updating!=$link_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$link_name_curr";?></td> 
				<td><?php echo"$link_url_curr";?></td> 
				<td> <a href="javascript:requestInfo('showLinks.php?mode=update&link_id=<?php echo"$link_id_curr";?>','showLinks','');">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showLinks.php?mode=delete&link_id=<?php echo"$link_id_curr";?>','showLinks','');" onclick="return confirmLink(this, 'links', '<?php echo"$link_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 