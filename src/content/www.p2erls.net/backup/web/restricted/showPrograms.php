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
		  <?php if($mode=='assc_program_networks') {
		  $program_id= $_GET["program_id"];
		  ?>
         <h3 align="center">Networks for this Program </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showPrograms.php?mode=list&program_id=<?php echo"$program_id";?>','showPrograms','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Networks</b></td>
          <td colspan="2" ><b>Check if Program Contains Network </b></td>
          </tr>
		<?php 
 
   	
 $query_program_network = "SELECT * FROM p2erls_networks WHERE pending_change != 'Yes' ORDER BY network_name ASC"; 

$result_program_network = mysql_query($query_program_network);
$num_results_program_network= mysql_num_rows($result_program_network); 
?>
        <?php  
		 for ($i_program_network=0; $i_program_network <$num_results_program_network; $i_program_network++)
  {

$network_id= mysql_result($result_program_network,$i_program_network,"network_id");
$network_name= mysql_result($result_program_network,$i_program_network,"network_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_program_networks WHERE pending_change!='Yes' AND program_id='$program_id' AND network_id='$network_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="563" ><?php echo"$network_name";?></td>
          <td width="219" ><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_program_networks WHERE pending_change='Yes' AND account_num!='0' AND program_id='$program_id' AND network_id='$network_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$network_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_program_networks','program_id','<?php echo "$program_id"; ?>','network_id','<?php echo "$network_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$network_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_program_networks','program_id','<?php echo "$program_id"; ?>','network_id','<?php echo "$network_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$network_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
        <td width="276" ><div id="result_action_<?php echo "$network_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		} ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showPrograms.php?mode=list&program_id=<?php echo"$program_id";?>','showPrograms','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		<?php if($mode=='assc_program_sites') {
		  $program_id= $_GET["program_id"];
		  ?>
         <h3 align="center">Sites for this Program </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showPrograms.php?mode=list&program_id=<?php echo"$program_id";?>','showPrograms','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Sites</b></td>
          <td colspan="2" ><b>Check if Program Contains Site</b></td>
          </tr>
		<?php 
 
   	
 $query_program_site = "SELECT * FROM p2erls_sites ORDER BY site_name ASC"; 

$result_program_site = mysql_query($query_program_site);
$num_results_program_site= mysql_num_rows($result_program_site); 
?>
        <?php  
		 for ($i_program_site=0; $i_program_site <$num_results_program_site; $i_program_site++)
  {

$site_id= mysql_result($result_program_site,$i_program_site,"site_id");
$site_name= mysql_result($result_program_site,$i_program_site,"site_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_program_sites WHERE pending_change!='Yes' AND program_id='$program_id' AND site_id='$site_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="563" ><?php echo"$site_name";?></td>
          <td width="219" ><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_program_sites WHERE pending_change='Yes' AND account_num!='0' AND program_id='$program_id' AND site_id='$site_id'";
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
				
				<input onClick="showCheckResult(this.checked,'p2erls_program_sites','program_id','<?php echo "$program_id"; ?>','site_id','<?php echo "$site_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$site_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_program_sites','program_id','<?php echo "$program_id"; ?>','site_id','<?php echo "$site_id"; ?>');" type="checkbox" name="region_checkbox_<?php echo "$site_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
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
          <td colspan="3" ><a href="javascript:requestInfo('showPrograms.php?mode=list&program_id=<?php echo"$program_id";?>','showPrograms','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
			
				if($mode=="update"){
					$program_id=$_GET["program_id"]; 
					
					// Display all the data from the table 
					$query_programs = "SELECT * FROM p2erls_programs WHERE program_id='$program_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY program_id ASC";
					$result_programs = mysql_query($query_programs);
					$num_results_programs = mysql_num_rows($result_programs);
					
					for ($i=0; $i < $num_results_programs; $i++) {
						$program_name= mysql_result($result_programs,$i,"program_name");
						$program_url= mysql_result($result_programs,$i,"program_url");
					} 
				}
				?>  
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Program <?php echo"$program_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$program_id";?>" name="prev_program_id" id="prev_program_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$program_id";?>" name="program_id" id="program_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>Program Name </td>
			  <td><input type="text" value="<?php echo"$program_name";?>" name="program_name" id="program_name" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>Program URL </td>
              <td><input type="text" value="<?php echo"$program_url";?>" name="program_url" id="program_url" size="30"></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td colspan="2"><a href="javascript:requestInfo('showPrograms.php?mode=assc_program_networks&program_id=<?php echo"$program_id";?>','showPrograms','')">Modify Networks </a></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td colspan="2"><a href="javascript:requestInfo('showPrograms.php?mode=assc_program_sites&program_id=<?php echo"$program_id";?>','showPrograms','')">Modify Sites </a></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showPrograms.php?mode=list&program_id=<?php echo"$program_id";?>','showPrograms','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_programs','program_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_programs','program_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showPrograms.php?mode=new&program_id=<?php echo"$program_id";?>','showPrograms','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showPrograms.php?mode=list','showPrograms','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_program_id=$_GET["program_id"];
			$sqlDelete="DELETE FROM p2erls_programs where program_id='$var_program_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database
		if($mode=="save_new") {
			$program_id=$_GET["program_id"];
			$program_name=$_GET["program_name"];
			$program_url=$_GET["program_url"];
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_programs` VALUES (
				'".$program_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$program_name."',
				'".$program_url."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_programs` VALUES (
				'".$program_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$program_name."',
				'".$program_url."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_program_id=$_GET["prev_program_id"];
			$program_id=$_GET["program_id"]; 
			$program_name=$_GET["program_name"];
			$program_url=$_GET["program_url"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_programs SET
				program_id='".$program_id."',
				last_updated='".$db_date."',
				program_name='".$program_name."',
				program_url='".$program_url."'
				WHERE program_id='".$prev_program_id."'";
				mysql_query($query_update);
				
				$query_update_site_assc="UPDATE p2erls_program_sites SET program_id='".$program_id."' WHERE program_id='".$prev_program_id."'";
				mysql_query($query_update_site_assc);
								
				$query_update_program_assc="UPDATE p2erls_program_networks SET program_id='".$program_id."' WHERE program_id='".$prev_program_id."'";
				mysql_query($query_update_program_assc);
				
				
					require("includes/update_saved_searches.php");
					updateSavedSearches($prev_program_id,$program_id,'select_multiple_programs');
				
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_programs` VALUES (
				'".$prev_program_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$program_name."',
				'".$program_url."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="5%"><b> ID </b></td>
			<td width="27%"><b> Program Name </b></td> 
			<td width="56%"><b> Program  Url </b></td> 
			<td width="5%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="7%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table 
			$query_programs = "SELECT * FROM p2erls_programs WHERE pending_change != 'Yes' ORDER BY program_id ASC";
			$result_programs = mysql_query($query_programs);
			$num_results_programs = mysql_num_rows($result_programs);
			
			for ($i=0; $i < $num_results_programs; $i++) {
				$program_id_curr= mysql_result($result_programs,$i,"program_id"); 
				$program_name_curr= mysql_result($result_programs,$i,"program_name");
				$program_url_curr= mysql_result($result_programs,$i,"program_url");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$program_id_updating=$_GET["program_id"];
				
			}
			if($program_id_updating!=$program_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$program_id_curr";?></td> 
				<td><?php echo"$program_name_curr";?></td>
				<td><?php echo"$program_url_curr";?></td> 
				<td> <a href="javascript:requestInfo('showPrograms.php?mode=update&program_id=<?php echo"$program_id_curr";?>','showPrograms','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showPrograms.php?mode=delete&program_id=<?php echo"$program_id_curr";?>','showPrograms','');" onclick="return confirmLink(this, 'program', '<?php echo"$program_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 