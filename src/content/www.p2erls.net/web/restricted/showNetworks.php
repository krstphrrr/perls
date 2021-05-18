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
		  <?php if($mode=='assc_network_sites') {
		  $network_id= $_GET["network_id"];
		  ?>
         <h3 align="center">Sites for this Network </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showNetworks.php?mode=list&network_id=<?php echo"$network_id";?>','showNetworks','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Sites</b></td>
          <td colspan="2" ><b>Check if Network Contains Site</b></td>
          </tr>
		<?php 
 
   	
 $query_network_site = "SELECT * FROM p2erls_sites ORDER BY site_name ASC"; 

$result_network_site = mysql_query($query_network_site);
$num_results_network_site= mysql_num_rows($result_network_site); 
?>
        <?php  
		 for ($i_network_site=0; $i_network_site <$num_results_network_site; $i_network_site++)
  {

$site_id= mysql_result($result_network_site,$i_network_site,"site_id");
$site_name= mysql_result($result_network_site,$i_network_site,"site_name"); 
 
$query_get_exists = "SELECT * FROM p2erls_network_sites WHERE pending_change!='Yes' AND network_id='$network_id' AND site_id='$site_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);
 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="563" ><?php echo"$site_name";?></td>
          <td width="219" ><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_network_sites WHERE pending_change='Yes' AND account_num!='0' AND network_id='$network_id' AND site_id='$site_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$site_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_network_sites','network_id','<?php echo "$network_id"; ?>','site_id','<?php echo "$site_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$site_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_network_sites','network_id','<?php echo "$network_id"; ?>','site_id','<?php echo "$site_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$site_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
        <td width="276" ><div id="result_action_<?php echo "$site_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		} ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showNetworks.php?mode=list&network_id=<?php echo"$network_id";?>','showNetworks','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
				
				if($mode=="update"){
					$network_id=$_GET["network_id"]; 
					
					// Display all the data from the table 
					$query_networks = "SELECT * FROM p2erls_networks WHERE network_id='$network_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY network_id ASC";
					$result_networks = mysql_query($query_networks);
					$num_results_networks = mysql_num_rows($result_networks);
					
					for ($i=0; $i < $num_results_networks; $i++) {
						$network_name	= mysql_result($result_networks,$i,"network_name");
						$network_url	= mysql_result($result_networks,$i,"network_url");
						$network_cat	= mysql_result($result_networks,$i,"network_cat");
					} 
				}
				?> 
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Network <?php echo"$network_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$network_id";?>" name="prev_network_id" id="prev_network_id">
				<td width="153">Network ID </td>
				<td width="281"><input type="text" value="<?php echo"$network_id";?>" name="network_id" id="network_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Network Name </td>
			  <td><input type="text" value="<?php echo"$network_name";?>" name="network_name" id="network_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>Network URL </td>
              <td><input type="text" value="<?php echo"$network_url";?>" name="network_url" id="network_url" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			    <td>Network Category: </td>
			    <td><select name="network_cat" id="network_cat">
                    <option value="" selected="selected">Select</option>
                    <option value="U.S. National" <?php if($network_cat == "U.S. National"){ ?> selected="selected"<?php } ?>>U.S. National</option>
                    <option value="U.S. Regional" <?php if($network_cat == "U.S. Regional"){ ?> selected="selected"<?php } ?>>U.S. Regional</option>
                    <option value="International" <?php if($network_cat == "International"){ ?> selected="selected"<?php } ?>>International</option>
                </select></td>
			    </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td colspan="2"><a href="javascript:requestInfo('showNetworks.php?mode=assc_network_sites&network_id=<?php echo"$network_id";?>','showNetworks','')">Modify Sites </a></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showNetworks.php?mode=list&network_id=<?php echo"$network_id";?>','showNetworks','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_networks','network_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_networks','network_id');">Save</a>
				<?php } ?>			  </td>
              </tr>
		  </table>  
		  </td></tr>
		<tr>
		  <td colspan=11>&nbsp;</td>
		  </tr>
		<?php } ?>
		
		
		<tr>
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showNetworks.php?mode=new&network_id=<?php echo"$network_id";?>','showNetworks','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showNetworks.php?mode=list','showNetworks','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_network_id=$_GET["network_id"];
			$sqlDelete="DELETE FROM p2erls_networks where network_id='$var_network_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {
			$network_id=$_GET["network_id"];
			$network_name=$_GET["network_name"];
			$network_url=$_GET["network_url"];
			$network_cat=$_GET["network_cat"];
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_networks` VALUES (
				'".$network_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$network_name."',
				'".$network_url."',
				'".$network_cat."'
				)";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_networks` VALUES (
				'".$network_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$network_name."',
				'".$network_url."',
				'".$network_cat."'
				)";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_network_id=$_GET["prev_network_id"];
			$network_id=$_GET["network_id"]; 
			$network_name=$_GET["network_name"];
			$network_url=$_GET["network_url"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_networks SET
				network_id='".$network_id."',
				last_updated='".$db_date."',
				network_name='".$network_name."',
				network_url='".$network_url."',
				network_cat='".$network_cat."'
				WHERE network_id='".$prev_network_id."'";
				mysql_query($query_update);
				
				$query_update_site_assc="UPDATE p2erls_network_sites SET network_id='".$network_id."' WHERE network_id='".$prev_network_id."'";
				mysql_query($query_update_site_assc);
				
				$query_update_program_assc="UPDATE p2erls_program_networks SET network_id='".$network_id."' WHERE network_id='".$prev_network_id."'";
				mysql_query($query_update_program_assc);
				
				 
					require("includes/update_saved_searches.php");
					updateSavedSearches($prev_network_id,$network_id,'select_multiple_networks');
				 
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_networks` VALUES (
				'".$prev_network_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$network_name."',
				'".$network_url."',
				'".$network_cat."'
				)";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		
		<tr>
		<td>
		<table width="100%">
		<tr>
			<td width="5%"><b> ID </b></td>
			<td width="32%"><b> Network Name </b></td> 
			<td width="51%"><b> Network  Url </b></td> 
			<td width="5%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="7%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table
			$query_networks = "SELECT * FROM p2erls_networks WHERE pending_change != 'Yes' ORDER BY network_id ASC";
			$result_networks = mysql_query($query_networks);
			$num_results_networks = mysql_num_rows($result_networks);
			
			for ($i=0; $i < $num_results_networks; $i++) {
				$network_id_curr= mysql_result($result_networks,$i,"network_id"); 
				$network_name_curr= mysql_result($result_networks,$i,"network_name");
				$network_url_curr= mysql_result($result_networks,$i,"network_url");
				$network_cat_curr= mysql_result($result_networks,$i,"network_cat");

				
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$network_id_updating=$_GET["network_id"];
				
			}
			if($network_id_updating!=$network_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$network_id_curr";?></td> 
				<td><?php echo"$network_name_curr";?></td>
				<td><?php if ($network_url_curr != '') { ?><a href="<?php echo"$network_url_curr";?>" target="_blank"><?php } echo"$network_url_curr"; if ($network_url_curr != '') { ?></a><?php } ?></td> 
				<td> <a href="javascript:requestInfo('showNetworks.php?mode=update&network_id=<?php echo"$network_id_curr";?>','showNetworks','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showNetworks.php?mode=delete&network_id=<?php echo"$network_id_curr";?>','showNetworks','');" onclick="return confirmLink(this, 'network', '<?php echo"$network_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 