<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: post-check=0, pre-check=0",false);session_cache_limiter();session_start();
?>
<?php
require("Security_Dept/config.php");
include("includes/mysql.lib.php");
$obj=new connect;
$mode=$_GET["mode"];
//echo "mode = $mode<br>";
?>

<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#eeeeee" align="center" >
  <tr>
    <td colspan=11><div align="center">
	
         <?php if($mode=='assc_site_landowner') {?>
         <h3>Site Landowners</h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=list&site_id=<?php echo"$site_id";?>','showSites','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Landowner</b></td>
          <td ><b>Check if Landowner</b></td>
          <td >&nbsp;</td>
        </tr>
		<?php
$site_id= $_GET["site_id"];
 
   	
 $query_land_owners = "SELECT * FROM p2erls_landowners WHERE pending_change!='Yes' ORDER BY landowner_id ASC"; 

$result_land_owners = mysql_query($query_land_owners);
$num_results_land_owners= mysql_num_rows($result_land_owners); 
?>
        <?php  
		 for ($i_land_owners=0; $i_land_owners <$num_results_land_owners; $i_land_owners++)
  {

$landowner_id= mysql_result($result_land_owners,$i_land_owners,"landowner_id");
$landowner_name= mysql_result($result_land_owners,$i_land_owners,"landowner_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_site_landowner WHERE pending_change!='Yes' AND site_id='$site_id' AND landowner_id='$landowner_id'";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          	<td width="533"><?php echo"$landowner_name";?></td>
          	<td width="248"><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_site_landowner WHERE pending_change='Yes' AND account_num!='0' AND site_id='$site_id' AND landowner_id='$landowner_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$landowner_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_site_landowner','site_id','<?php echo "$site_id"; ?>','landowner_id','<?php echo "$landowner_id"; ?>');" type="checkbox" name="landowner_checkbox_<?php echo "$landowner_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_site_landowner','site_id','<?php echo "$site_id"; ?>','landowner_id','<?php echo "$landowner_id"; ?>');" type="checkbox" name="landowner_checkbox_<?php echo "$landowner_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
			<td width="219"><div id="result_action_<?php echo "$landowner_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		} ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=list&site_id=<?php echo"$site_id";?>','showSites','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?><?php if($mode=='assc_site_gradient') {?>
         <h3>Site Gradients </h3>
         <table width="100%" align="center" cellpadding="5" cellspacing="0">
		 <tr align="center" valign="top" bgcolor="#FFFFFF" >
		   <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=list&site_id=<?php echo"$site_id";?>','showSites','')">Close</a></td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
		 <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td ><b>Gradient</b></td>
          <td ><b>Check if Gradient </b></td>
          <td >&nbsp;</td>
        </tr>
		<?php
$site_id= $_GET["site_id"];
 
   	
 $query_gradients = "SELECT * FROM p2erls_gradients ORDER BY gradient_id ASC"; 

$result_gradients = mysql_query($query_gradients);
$num_results_gradients= mysql_num_rows($result_gradients); 
?>
        <?php  
		 for ($i_gradients=0; $i_gradients <$num_results_gradients; $i_gradients++)
  {

$gradient_id= mysql_result($result_gradients,$i_gradients,"gradient_id");
$gradient_name= mysql_result($result_gradients,$i_gradients,"gradient_name"); 
 

$query_get_exists = "SELECT * FROM p2erls_site_gradient WHERE pending_change!='Yes' AND site_id='$site_id' AND gradient_id='$gradient_id' ";
$result_get_exists= mysql_query($query_get_exists);
$num_results_get_exists = mysql_num_rows($result_get_exists);

 ?>
        
     
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          	<td width="533"><?php echo"$gradient_name";?></td>
          	<td width="248"><?php
			$query_pending_check = "SELECT delete_assc, account_num FROM p2erls_site_gradient WHERE pending_change='Yes' AND account_num!='0' AND site_id='$site_id' AND gradient_id='$gradient_id'";
			$result_pending_check = mysql_query($query_pending_check);
			$num_results_pending_check = mysql_num_rows($result_pending_check);
			//echo "$query_pending_check<br>";
			
			for ($l=0; $l < $num_results_pending_check; $l++)
			{
				$delete_assc= mysql_result($result_pending_check,$l,"delete_assc");
				$account_num= mysql_result($result_pending_check,$l,"account_num");
			} ?>
			<div id="result_account_<?php echo "$gradient_id"; ?>" style="display:none;"><?php echo "$account_num"; ?></div>
		  	<?php if ($num_results_get_exists != 0)
		  	{ ?>
				
				<input onClick="showCheckResult(this.checked,'p2erls_site_gradient','site_id','<?php echo "$site_id"; ?>','gradient_id','<?php echo "$gradient_id"; ?>');" type="checkbox" name="landowner_checkbox_<?php echo "$gradient_id"; ?>" value="Yes" checked="checked"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
			<?php }
			else
			{ ?>
            	<input onClick="showCheckResult(this.checked,'p2erls_site_gradient','site_id','<?php echo "$site_id"; ?>','gradient_id','<?php echo "$gradient_id"; ?>');" type="checkbox" name="landowner_checkbox_<?php echo "$gradient_id"; ?>" value="Yes"<?php if ($num_results_pending_check != 0) { echo " disabled='disabled'"; } ?> />
            <?php } ?></td>
			<td width="219"><div id="result_action_<?php echo "$gradient_id"; ?>"><?php if ($num_results_pending_check == 0) { echo 'Click to Modify'; } else { if ($delete_assc == 'Yes') { echo 'Pending Removal'; } else { echo 'Pending Addition'; } } ?></div></td>
        </tr>
        <?php $account_num='';
		}
		/*
		?>
		
        <!--
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td width="533" ><?php echo"$gradient_name";?></td>
          <td width="248" ><form> 
<?php if($num_results_get_exists!='0'){?>
            <input  onClick="showGradient(this.checked,'<?php= $site_id; ?>','<?php= $gradient_id; ?>')" type="checkbox" name="site_gradient3_<?php echo"$gradient_id";?>" value="Yes" checked="checked" />
            <?php } ?>
            <?php if($num_results_get_exists=='0'){?>
            <input onClick="showGradient(this.checked,'<?php= $site_id; ?>','<?php= $gradient_id; ?>')" type="checkbox" name="site_gradient3_<?php echo"$gradient_id";?>" value="Yes" />
            <?php } ?>
</form>

 

 
</td>
        <td width="219" ><div id="site_gradient_<?php echo"$gradient_id";?>">Click to Modify </div>
<div id="site_gradient2_<?php echo"$gradient_id";?>"></div></td>
        </tr>
		-->
        <?php }
		*/ ?>
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   <td >&nbsp;</td>
		   </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=list&site_id=<?php echo"$site_id";?>','showSites','')">Close</a></td>
          </tr>
</table>
		
		<?php } ?>
		
		<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update" || $mode=="new") {
			
			if($mode=="update"){
				$site_id=$_GET["site_id"];
				
				// Display all the data from the table 
				$query_sites = "SELECT * FROM p2erls_sites WHERE site_id='$site_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY site_id ASC";
				$result_sites = mysql_query($query_sites);
				$num_results_sites = mysql_num_rows($result_sites);
				
				for ($i=0; $i < $num_results_sites; $i++) {
					$site_id= mysql_result($result_sites,$i,"site_id"); 
					$site_name= mysql_result($result_sites,$i,"site_name");				
					$site_url= mysql_result($result_sites,$i,"site_url");
					$site_lat= mysql_result($result_sites,$i,"site_lat");
					$site_long= mysql_result($result_sites,$i,"site_long");
					$site_elevlow= mysql_result($result_sites,$i,"site_elevlow");
					$site_elevhigh= mysql_result($result_sites,$i,"site_elevhigh");
					$site_elevmean= mysql_result($result_sites,$i,"site_elevmean");
					$site_temp= mysql_result($result_sites,$i,"site_temp");
					$site_precip= mysql_result($result_sites,$i,"site_precip");
					$site_desc= mysql_result($result_sites,$i,"site_desc");
					$ecosystem_id= mysql_result($result_sites,$i,"ecosystem_id");
					$state_id= mysql_result($result_sites,$i,"state_id"); 
					$country_id= mysql_result($result_sites,$i,"country_id");
					
					if ($site_elevlow == 0 || $site_elevlow == NULL) { $site_elevlow = ''; }
					if ($site_elevhigh == 0 || $site_elevhigh == NULL) { $site_elevhigh = ''; }
					if ($site_elevmean == 0 || $site_elevmean == NULL) { $site_elevmean = ''; }
					if ($site_temp == 0 || $site_temp == NULL) { $site_temp = ''; }
					if ($site_precip == 0 || $site_precip == NULL) { $site_precip = ''; }
				}
			}
		
			/*
			$sql="SELECT * FROM p2erls_sites where site_id='$site_id' ORDER BY site_id ASC";
			$obj->query($sql);	
			while($row=$obj->query_fetch(0)) {
				$site_id=$row["site_id"]; 
				$site_name=$row["site_name"];				
				$site_url=$row["site_url"];
				$site_lat=$row["site_lat"];
				$site_long=$row["site_long"];
				$site_elevlow=$row["site_elevlow"];
				$site_elevhigh=$row["site_elevhigh"];
				$site_elevmean=$row["site_elevmean"];
				$site_temp=$row["site_temp"];
				$site_precip=$row["site_precip"];
				$site_desc=$row["site_desc"];
				$ecosystem_id=$row["ecosystem_id"];
				$state_id=$row["state_id"]; 
				$country_id=$row["country_id"];
			} 
			}
			*/
				?>
  
		<h3>
          <?php if($mode=='new') {?>
          Add
          <?php } else { ?>
          Update
          <?php }?>
          Site <?php echo"$site_id";?> <br />
        </h3>
      </div>
	  
      <table width="456" align="center" cellpadding="5" cellspacing="0">
        <tr bgcolor="#ffffff">
          <input type="hidden" value="<?php echo"$site_id";?>" name="prev_site_id" id="prev_site_id">
          <td width="153">ID </td>
          <td width="281"><input type="text" value="<?php echo"$site_id";?>" name="site_id" id="site_id" size="20"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Site Name </td>
          <td><input type="text" value="<?php echo"$site_name";?>" name="site_name" id="site_name" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Site Url </td>
          <td><input type="text" value="<?php echo"$site_url";?>" name="site_url" id="site_url" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Latitude</td>
          <td><input type="text" value="<?php echo"$site_lat";?>" name="site_lat" id="site_lat" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Longitude</td>
          <td><input type="text" value="<?php echo"$site_long";?>" name="site_long" id="site_long" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Elevation Low </td>
          <td><input type="text" value="<?php echo"$site_elevlow";?>" name="site_elevlow" id="site_elevlow" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Elevation High </td>
          <td><input type="text" value="<?php echo"$site_elevhigh";?>" name="site_elevhigh" id="site_elevhigh" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Elevation Mean </td>
          <td><input type="text" value="<?php echo"$site_elevmean";?>" name="site_elevmean" id="site_elevmean" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Temperature</td>
          <td><input type="text" value="<?php echo"$site_temp";?>" name="site_temp" id="site_temp" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Precipitation</td>
          <td><input type="text" value="<?php echo"$site_precip";?>" name="site_precip" id="site_precip" size="35"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td height="32" colspan="2">Site Description</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td colspan="2"><textarea name="site_desc" id="site_desc" cols="40" rows="10"><?php echo"$site_desc";?></textarea></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Ecosystem</td>
          <td><?php
    
require ("Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$query = "SELECT * FROM p2erls_ecosystems ORDER BY ecosystem_id ASC";
$result = mysql_query($query);
$num_results = mysql_num_rows($result); 

?>
            <select name="ecosystem_id" id="ecosystem_id" width="30">
              <?php if($ecosystem_id==''){?>
              <option value="" selected="selected">select</option>
              <?php } ?>
              <?php if($ecosystem_id!=''){?>
              <option value="">select</option>
              <?php } ?>
              <?php   
  for ($i=0; $i <$num_results; $i++)
  {
  	$ecosystem_id2= mysql_result($result,$i,"ecosystem_id");
	$ecosystem_name2= mysql_result($result,$i,"ecosystem_name"); 
			
		
?>
              <?php if($ecosystem_id==$ecosystem_id2){?>
              <option value="<?php echo"$ecosystem_id2"; ?>" selected="selected"><?php echo"$ecosystem_name2"; ?></option>
              <?php } ?>
              <?php if($ecosystem_id!=$ecosystem_id2){?>
              <option value="<?php echo"$ecosystem_id2"; ?>"><?php echo"$ecosystem_name2"; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>State</td>
          <td><?php
    
 $query = "SELECT * FROM p2erls_states ORDER BY state_id ASC";
 $result = mysql_query($query);
 $num_results = mysql_num_rows($result); 

?>
            <select name="state_id" id="state_id" width="30">
              <?php if($state_id==''){?>
              <option value="" selected="selected">select</option>
              <?php } ?>
              <?php if($state_id!=''){?>
              <option value="">select</option>
              <?php } ?>
              <?php   
  for ($i=0; $i <$num_results; $i++)
  {
  	$state_id2= mysql_result($result,$i,"state_id");
	$state_name2= mysql_result($result,$i,"state_name");	 	
			
		
?>
              <?php if($state_id==$state_id2){?>
              <option value="<?php echo"$state_id2"; ?>" selected="selected"><?php echo"$state_name2"; ?></option>
              <?php } ?>
              <?php if($state_id!=$state_id2){?>
              <option value="<?php echo"$state_id2"; ?>"><?php echo"$state_name2"; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Country</td>
          <td><?php
    
 
  $query = "SELECT * FROM p2erls_countries ORDER BY country_id ASC";
  $result = mysql_query($query);
 $num_results = mysql_num_rows($result); 

?>
            <select name="country_id" id="country_id" width="30">
              <?php if($country_id==''){?>
              <option value="" selected="selected">select</option>
              <?php } ?>
              <?php if($country_id!=''){?>
              <option value="">select</option>
              <?php } ?>
              <?php   
  for ($i=0; $i <$num_results; $i++)
  {
  	$country_id2= mysql_result($result,$i,"country_id");
	$country_name2= mysql_result($result,$i,"country_name"); 
			
		
?>
              <?php if($country_id==$country_id2){?>
              <option value="<?php echo"$country_id2"; ?>" selected="selected"><?php echo"$country_name2"; ?></option>
              <?php } ?>
              <?php if($country_id!=$country_id2){?>
              <option value="<?php echo"$country_id2"; ?>"><?php echo"$country_name2"; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
        </tr>
        
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td >&nbsp;</td>
          <td colspan="2" >&nbsp;</td>
        </tr>
		<?php if($mode=='update') {?>
		<tr bgcolor="#ffffff">
          <td>PDF</td>
          <td><div onclick="ajax_showTooltip('tooltip_pdf.php?site=<?php if($site_id != ''){ echo"$site_id";} else { echo "New";} ?>',this,true);return false"><a href="#">Add/Modify PDF</a></div> </td>
        </tr> 
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td >&nbsp;</td>
          <td colspan="2" >&nbsp;</td>
        </tr>      
        <tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=assc_site_landowner&site_id=<?php echo"$site_id";?>','showSites','')">Modify Site Landowners </a></td>
        </tr>         
		<tr align="left" valign="top" bgcolor="#FFFFFF" >
          <td colspan="3" ><a href="javascript:requestInfo('showSites.php?mode=assc_site_gradient&site_id=<?php echo"$site_id";?>','showSites','')">Modify Site Gradients</a></td>
        </tr>
			
        <?php } ?>
         
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center" bgcolor="#ffffff">
          <td colspan="2"><a href="javascript:requestInfo('showSites.php?mode=list&site_id=<?php echo"$site_id";?>','showSites','')">Cancel</a> ||
            <?php if($mode!='new') {?>
            <a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_sites','site_id');">Save</a>
			<?php } ?>
            <?php if($mode=='new') {?>
            <a href="javascript:save_data('p2erls_sites','site_id');">Save</a>
            <?php } ?>		  </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan=11>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showSites.php?mode=new&site_id=<?php echo"$site_id";?>','showSites','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showSites.php?mode=list','showSites','')">Refresh</a></td>
  </tr>
  <?php
		// For Delete 
		if($mode=="delete") {		
			$var_site_id=$_GET["site_id"];
			
			$query_delete="DELETE from p2erls_sites WHERE site_id='$var_site_id'";
			mysql_query($query_delete);
			//$sqlDelete="DELETE FROM p2erls_sites where site_id='$var_site_id'";
			//$obj->query($sqlDelete);
		?>
  <tr>
    <td colspan=3>Data Deleted</td>
  </tr>
  <?php } ?>
  <?php
  /* The following is not necessary and can be deleted */
  if($mode=="site_landowner") {
  	$site_id=$_GET["site_id"]; 
	$landowner_id=$_GET["landowner_id"];
	$value=$_GET["value"];
	  
	if($value='Yes'){
		$query_insert="INSERT INTO `p2erls_site_landowner` VALUES (
		'".$site_id."',
		'".$landowner_id."')";
		$result_insert = mysql_query($query_insert);
		/*
		$sqlSave="INSERT INTO p2erls_site_landowner VALUES(
		'$site_id', 
		'$landowner_id'
		)";
		$obj->query($sqlSave);
		*/
	}
	else
	{
		$var_site_id=$_GET["site_id"];
		$var_landowner_id=$_GET["landowner_id"];
		
		$query_delete="DELETE from p2erls_site_landowner WHERE site_id='$var_site_id' AND landowner_id='$var_landowner_id'";
		mysql_query($query_delete);
		//$sqlDelete="DELETE FROM p2erls_site_landowner where site_id='$var_site_id' and landowner_id='$var_landowner_id'";
		//$obj->query($sqlDelete);
	}
	?>
  <tr>
    <td colspan=3>Data Saved
  </tr>
  <?php }
  /* End Not Necessary */
  ?>
  <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") {	
			$site_id=$_GET["site_id"]; 
			$site_name=$_GET["site_name"];
			$site_url=$_GET["site_url"];
			$site_lat=$_GET["site_lat"];
			$site_long=$_GET["site_long"];
			$site_elevlow=$_GET["site_elevlow"];
			$site_elevhigh=$_GET["site_elevhigh"];
			$site_elevmean=$_GET["site_elevmean"];
			$site_temp=$_GET["site_temp"];
			$site_precip=$_GET["site_precip"];
			$site_desc=$_GET["site_desc"];
			$ecosystem_id=$_GET["ecosystem_id"];
			$state_id=$_GET["state_id"]; 
			$country_id=$_GET["country_id"];			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_sites` VALUES (
				'".$site_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$site_name."',
				'".$site_url."',
				'".$site_lat."',
				'".$site_long."',
				'".$site_elevlow."',
				'".$site_elevhigh."',
				'".$site_elevmean."',
				'".$site_temp."',
				'".$site_precip."',
				'".$site_desc."',
				'".$ecosystem_id."',
				'".$state_id."',
				'".$country_id."',
				''
				
				)";
echo "$query_insert";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_sites` VALUES (
				'".$site_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$site_name."',
				'".$site_url."',
				'".$site_lat."',
				'".$site_long."',
				'".$site_elevlow."',
				'".$site_elevhigh."',
				'".$site_elevmean."',
				'".$site_temp."',
				'".$site_precip."',
				'".$site_desc."',
				'".$ecosystem_id."',
				'".$state_id."',
				'".$country_id."',
				''
				)";
			}
			$result_insert = mysql_query($query_insert);
			?>
  <tr>
    <td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td>
  </tr>
  <?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {		
			$prev_site_id=$_GET["prev_site_id"];			
			$site_id=$_GET["site_id"]; 
			$site_name=$_GET["site_name"];
			$site_url=$_GET["site_url"];
			$site_lat=$_GET["site_lat"];
			$site_long=$_GET["site_long"];
			$site_elevlow=$_GET["site_elevlow"];
			$site_elevhigh=$_GET["site_elevhigh"];
			$site_elevmean=$_GET["site_elevmean"];
			$site_temp=$_GET["site_temp"];
			$site_precip=$_GET["site_precip"];
			$site_desc=$_GET["site_desc"];
			$ecosystem_id=$_GET["ecosystem_id"];
			$state_id=$_GET["state_id"]; 
			$country_id=$_GET["country_id"];			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_sites SET
				site_id='".$site_id."',
				last_updated='".$db_date."',
				site_name='".$site_name."',
				site_url='".$site_url."',
				site_lat='".$site_lat."',
				site_long='".$site_long."',
				site_elevlow='".$site_elevlow."',
				site_elevhigh='".$site_elevhigh."',
				site_elevmean='".$site_elevmean."',
				site_temp='".$site_temp."',
				site_precip='".$site_precip."',
				site_desc='".$site_desc."',
				ecosystem_id='".$ecosystem_id."',
				state_id='".$state_id."',
				country_id='".$country_id."'
				WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update); 
				
				$query_update_network_assc="UPDATE p2erls_network_sites SET site_id='".$site_id."' WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update_network_assc);
				
				$query_update_program_assc="UPDATE p2erls_program_sites SET site_id='".$site_id."' WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update_program_assc);
				
				$query_update_gradient_assc="UPDATE p2erls_site_gradient SET site_id='".$site_id."' WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update_gradient_assc);
				
				$query_update_landowner_assc="UPDATE p2erls_site_landowner SET site_id='".$site_id."' WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update_landowner_assc);
			}
			else
			{
				$query_site_flyer = "SELECT site_flyer FROM p2erls_sites WHERE site_id='$prev_site_id'";
				$result_site_flyer = mysql_query($query_site_flyer);
				$num_results_site_flyer = mysql_num_rows($result_site_flyer);
				
				if ($num_results_site_flyer != 0)
				{
					$old_site_flyer = mysql_result($result_site_flyer,0,"site_flyer");
				}
				else
				{
					$old_site_flyer = '';
				}
 
				$query_insert="INSERT INTO `p2erls_sites` VALUES (
				'".$prev_site_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$site_name."',
				'".$site_url."',
				'".$site_lat."',
				'".$site_long."',
				'".$site_elevlow."',
				'".$site_elevhigh."',
				'".$site_elevmean."',
				'".$site_temp."',
				'".$site_precip."',
				'".$site_desc."',
				'".$ecosystem_id."',
				'".$state_id."',
				'".$country_id."',
				'".$old_site_flyer."')";
				$result_insert = mysql_query($query_insert);
				
			}
			
			/*
			if ($_SESSION["p2erls_access_level"] == 2) {
				$query_update="UPDATE p2erls_sites SET
				pending_change='Yes',
				site_name='".$site_name."',
				site_url='".$site_url."',
				site_lat='".$site_lat."',
				country_id='".$country_id."'
				WHERE site_id='".$prev_site_id."'";
				mysql_query($query_update);
				//echo "$query_update<br>";
			}
			*/
			
			/*
			$sqlUpdate="UPDATE p2erls_sites set 
				site_id='$site_id', 
				site_name='$site_name', 
				site_url='$site_url',
				site_lat='$site_lat',
				site_long='$site_long',
				site_elevlow='$site_elevlow',
				site_elevhigh='$site_elevhigh',
				site_elevmean='$site_elevmean',
				site_temp='$site_temp',
				site_precip='$site_precip',
				site_desc='$site_desc', 
				ecosystem_id='$ecosystem_id',
				state_id='$state_id', 
				country_id='$country_id' 
			where site_id='$prev_site_id'";
			
			echo "$sqlUpdate<br>";
			$obj->query($sqlUpdate);
			*/
			?>
  <tr>
    <td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td>
  </tr>
  <?php } // End of Update
  
  $site_id=$_GET["site_id"]; 
$site_name=$_GET["site_name"];				
$site_url=$_GET["site_url"];
$site_lat=$_GET["site_lat"];
$site_long=$_GET["site_long"];
$site_elevlow=$_GET["site_elevlow"];
$site_elevhigh=$_GET["site_elevhigh"];
$site_elevmean=$_GET["site_elevmean"];
$site_temp=$_GET["site_temp"];
$site_precip=$_GET["site_precip"];
//$site_desc=$_GET["site_desc"];
$ecosystem_id=$_GET["ecosystem_id"];
$state_id=$_GET["state_id"]; 
$country_id=$_GET["country_id"];

			// Display all the data from the table 
			require_once("includes/class.pager_sites_admin.php"); 
	
			$p = new Pager;			
			$listings_page=45; 
			$limit = $listings_page;
			$start = $p->findStart($limit); 

			$query_sites = "SELECT * FROM p2erls_sites WHERE pending_change != 'Yes'";
			$result_sites = mysql_query($query_sites);
			$count = mysql_num_rows($result_sites);
			
			$pages = $p->findPages($count, $limit);
			$pagelist = $p->pageList($_GET["page"], $pages); 		
			$sortby = $_GET["sortby"]; if($sortby == ""){$sortby = "site_name";}
			$result_sites = mysql_query($query_sites." ORDER BY $sortby ASC LIMIT ".$start.", ".$limit);
			$num_results_sites = mysql_num_rows($result_sites);
  ?>
  <tr>
    <td><table width="100%">
        <?php if($count>=$limit){ ?>
		<tr>
		  <td colspan="13" style="padding:8px;"><b>Page</b> <?php echo "$pagelist"; ?></td>
	    </tr>
		<?php } $change_sort_page = $_GET['page']; ?>
		<tr>
          <td width="3%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_id','showSites','')\" ><b>ID </b></a>";?></td>
          <td width="13%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_name','showSites','')\" ><b>Site Name </b></a>";?></td>
          <td width="9%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_lat','showSites','')\" ><b>Latitude </b></a>";?></td>
          <td width="10%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_long','showSites','')\" ><b>Longitude </b></a>";?></td>
          <td width="8%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_elevlow','showSites','')\" ><b>Elevation</b></a>";?></td>
          <td width="6%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_temp','showSites','')\" ><b>Temp</b></a>";?></td>
          <td width="9%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_precip','showSites','')\" ><b>Precipitation </b></a>";?></td>
          <td width="8%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=ecosystem_id','showSites','')\" ><b>Ecosystem </b></a>";?></td>
          <td width="6%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=state_id','showSites','')\" ><b>State </b></a>";?></td>
          <td width="9%"><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=country_id','showSites','')\" ><b>Country </b></a>";?></td>
          <td width="8%"><b><?php echo"<a href=\"javascript:requestInfo('showSites.php?mode=list&page=$change_sort_page&sortby=site_flyer','showSites','')\" ><b>PDF </b></a>";?></b></td>
          <td width="6%">&nbsp;</td>
          <?php if ($_SESSION[p2erls_access_level] == "1") { ?><td width="5%">&nbsp;</td><?php } ?>
        </tr>
        <?php
			for ($i=0; $i < $num_results_sites; $i++) {
				$site_id_curr= mysql_result($result_sites,$i,"site_id"); 
				$site_name_curr= mysql_result($result_sites,$i,"site_name");				
				$site_url_curr= mysql_result($result_sites,$i,"site_url");
				$site_lat_curr= mysql_result($result_sites,$i,"site_lat");
				$site_long_curr= mysql_result($result_sites,$i,"site_long");
				$site_elevlow_curr= mysql_result($result_sites,$i,"site_elevlow");
				$site_elevhigh_curr= mysql_result($result_sites,$i,"site_elevhigh");
				$site_elevmean_curr= mysql_result($result_sites,$i,"site_elevmean");
				$site_temp_curr= mysql_result($result_sites,$i,"site_temp");
				$site_precip_curr= mysql_result($result_sites,$i,"site_precip");
				//$site_desc_curr= mysql_result($result_sites,$i,"site_desc");
				$ecosystem_id_curr= mysql_result($result_sites,$i,"ecosystem_id");
				$state_id_curr= mysql_result($result_sites,$i,"state_id"); 
				$country_id_curr= mysql_result($result_sites,$i,"country_id");
				$site_flyer_curr= mysql_result($result_sites,$i,"site_flyer");
				
				if ($site_elevlow_curr == 0 || $site_elevlow_curr == NULL) { $site_elevlow_curr = ''; }
				if ($site_elevhigh_curr == 0 || $site_elevhigh_curr == NULL) { $site_elevhigh_curr = ''; }
				if ($site_elevmean_curr == 0 || $site_elevmean_curr == NULL) { $site_elevmean_curr = ''; }
				if ($site_temp_curr == 0 || $site_temp_curr == NULL) { $site_temp_curr = ''; }
				if ($site_precip_curr == 0 || $site_precip_curr == NULL) { $site_precip_curr = ''; }
			/*
			$sql="SELECT * FROM p2erls_sites ORDER BY site_id ASC";
			$obj->query($sql);	
			while($row=$obj->query_fetch(0)) {
				//echo "$obj<br>";
				$site_id_curr=$row["site_id"]; 
				$site_name_curr=$row["site_name"];				
				$site_url_curr=$row["site_url"];
				$site_lat_curr=$row["site_lat"];
				$site_long_curr=$row["site_long"];
				$site_elevlow_curr=$row["site_elevlow"];
				$site_elevhigh_curr=$row["site_elevhigh"];
				$site_elevmean_curr=$row["site_elevmean"];
				$site_temp_curr=$row["site_temp"];
				$site_precip_curr=$row["site_precip"];
				$site_desc_curr=$row["site_desc"];
				$ecosystem_id_curr=$row["ecosystem_id"];
				$state_id_curr=$row["state_id"]; 
				$country_id_curr=$row["country_id"];
			*/
				 ?>
        <?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			
			if($mode=="update") {
				$site_id_updating=$_GET["site_id"];				
			}
			
			//echo "site_id_curr = $site_id_curr<br>";
			//echo "site_id_updating = $site_id_updating<br>";
			if($site_id_updating!=$site_id_curr) { ?>
        <tr bgcolor="#ffffff">
          <td><?php echo"$site_id_curr";?></td>
          <td><?php if($site_url_curr!=''){?>
            <a href="<?php echo"$site_url_curr";?>" target="_blank">
            <?php } ?>
            <?php echo"$site_name_curr";?>
            <?php if($site_url_curr!=''){?>
            </a>
            <?php } ?></td>
          <td><?php echo"$site_lat_curr";?></td>
          <td><?php echo"$site_long_curr";?></td>
          <td>Low: <?php echo"$site_elevlow_curr";?><br />
            High: <?php echo"$site_elevhigh_curr";?><br />
            Mean: <?php echo"$site_elevmean_curr";?></td>
          <td><?php echo"$site_temp_curr";?></td>
          <td><?php echo"$site_precip_curr";?></td>
          <td><?php echo"$ecosystem_id_curr";?></td>
          <td><?php echo"$state_id_curr";?></td>
          <td><?php echo"$country_id_curr";?></td>
          <td><?php if($site_flyer_curr != ''){ ?><a href="../flyers<?php echo "$site_id_curr"; ?><?php echo "$site_flyer_curr"; ?>"><?php echo"$site_flyer_curr";?></a><?php } else { echo "No PDF"; } ?></td>
          <td><a href="javascript:requestInfo('showSites.php?mode=update&site_id=<?php echo"$site_id_curr";?>','showSites','')">Update</a> </td>
          <?php if ($_SESSION[p2erls_access_level] == "1") { ?><td><a href="javascript:requestInfo('showSites.php?mode=delete&site_id=<?php echo"$site_id_curr";?>','showSites','');" onclick="return confirmLink(this, 'site', '<?php echo"$site_id_curr";?>');">Delete</a></td><?php } ?>
        </tr>
        <?php } ?>
        <?php } ?>
		<?php if($count>=$limit){ ?>
		<tr>
		  <td colspan="13" style="padding:8px;"><b>Page</b> <?php echo "$pagelist"; ?></td>
	    </tr>
		<?php } ?>
      </table></td>
  </tr>
</table>
