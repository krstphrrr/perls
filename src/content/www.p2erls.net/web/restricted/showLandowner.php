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
				$landowner_id=$_GET["landowner_id"];
				
				// Display all the data from the table 
				$query_landowners = "SELECT * FROM p2erls_landowners WHERE landowner_id='$landowner_id' AND pending_change != 'Yes' AND account_num='0' ORDER BY landowner_id ASC";
				$result_landowners = mysql_query($query_landowners);
				$num_results_landowners = mysql_num_rows($result_landowners);
				
				for ($i=0; $i < $num_results_landowners; $i++) {
					$landowner_id= mysql_result($result_landowners,$i,"landowner_id"); 
					$landowner_name= mysql_result($result_landowners,$i,"landowner_name");				
					$landowner_url= mysql_result($result_landowners,$i,"landowner_url");
					$lb_id= mysql_result($result_landowners,$i,"lb_id"); 
					$state_id= mysql_result($result_landowners,$i,"state_id");
				}
			}
				?> <tr>
		  <td colspan=11>
			<div align="center">
				  <h3> 
				   <?php if($mode=='new') {?>Add <?php } else { ?>Update<?php }?>
				    Landowner <?php echo"$landowner_id";?>
                    <br />
                  </h3>
			</div><table width="456" align="center" cellpadding="5" cellspacing="0">
			<tr bgcolor="#ffffff">
			
				<input type="hidden" value="<?php echo"$landowner_id";?>" name="prev_landowner_id" id="prev_landowner_id">
				<td width="153">ID </td>
				<td width="281"><input type="text" value="<?php echo"$landowner_id";?>" name="landowner_id" id="landowner_id" size="20"></td>
			  </tr>
			<tr bgcolor="#ffffff">
               <td>Landowner Name </td>
              <td><input type="text" value="<?php echo"$landowner_name";?>" name="landowner_name" id="landowner_name" size="35"></td>
			  </tr>
			<tr bgcolor="#ffffff">
               <td>Landowner Url </td>
              <td><input type="text" value="<?php echo"$landowner_url";?>" name="landowner_url" id="landowner_url" size="35"></td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
			  </tr>
			<tr bgcolor="#ffffff">
              <td>Landowner Bounds </td>
              <td><?php
    
require ("Security_Dept/config.php");
@ $db2 = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

  $query = "SELECT * FROM p2erls_landowner_bounds ORDER BY lb_id ASC";
  $result = mysql_query($query);
 $num_results = mysql_num_rows($result); 

?>
                  <select name="lb_id" id="lb_id"> 
				  <?php if($lb_id==''){?><option value="" selected="selected">select</option><?php } ?>
   				<?php if($lb_id!=''){?><option value="">select</option><?php } ?>
                    <?php   
  for ($i=0; $i <$num_results; $i++)
  {
  	$lb_id2= mysql_result($result,$i,"lb_id");
	$lb_description2= mysql_result($result,$i,"lb_description");	 
			
		
?><?php if($lb_id==$lb_id2){?><option value="<?php echo"$lb_id2"; ?>" selected="selected"><?php echo"$lb_description2"; ?></option><?php } ?>
   <?php if($lb_id!=$lb_id2){?><option value="<?php echo"$lb_id2"; ?>"><?php echo"$lb_description2"; ?></option><?php } ?>
                     
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
                  <select name="state_id" id="state_id">
				 <?php if($state_id==''){?><option value="" selected="selected">select</option><?php } ?>
   				<?php if($state_id!=''){?><option value="">select</option><?php } ?> 
                    <?php   
  for ($i=0; $i <$num_results; $i++)
  {
  	$state_id2= mysql_result($result,$i,"state_id");
	$state_name2= mysql_result($result,$i,"state_name");	 	
			
		
?>
   <?php if($state_id==$state_id2){?><option value="<?php echo"$state_id2"; ?>" selected="selected"><?php echo"$state_name2"; ?></option><?php } ?>
   <?php if($state_id!=$state_id2){?><option value="<?php echo"$state_id2"; ?>"><?php echo"$state_name2"; ?></option><?php } ?>
                    <?php } ?>
                  </select></td>
			  </tr>
			<tr bgcolor="#ffffff">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr align="center" bgcolor="#ffffff">
			  <td colspan="2"><a href="javascript:requestInfo('showLandowner.php?mode=list&landowner_id=<?php echo"$landowner_id";?>','showLandowner','')">Cancel</a> ||
			  <?php if($mode!='new') {?>
				<a href="javascript:update_data('<?php echo $_SESSION["p2erls_access_level"]; ?>','p2erls_landowners','landowner_id');">Save</a>
				<?php } ?>
				<?php if($mode=='new') {?>
				<a href="javascript:save_data('p2erls_landowners','landowner_id');">Save</a>
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
			<td colspan=20 bgcolor="#FFFFFF"><?php if ($_SESSION["p2erls_access_level"] < 3) { ?><a href="javascript:requestInfo('showLandowner.php?mode=new&landowner_id=<?php echo"$landowner_id";?>','showLandowner','')">Add New Data</a> || <?php } ?><a href="javascript:requestInfo('showLandowner.php?mode=list','showLandowner','')">Refresh</a></td>
		</tr>
		
		<?php
		// For Delete 
		if($mode=="delete") {		
			$var_landowner_id=$_GET["landowner_id"];
			$sqlDelete="DELETE FROM p2erls_landowners where landowner_id='$var_landowner_id'";
			$obj->query($sqlDelete);?>
			<tr>
				<td colspan=3>Data Deleted</td>
			</tr>
			
		<?php } ?>
		
		
		 <?php
		// After Click on Add >> Save option the data is save into the database
		if($mode=="save_new") {
			$landowner_id=$_GET["landowner_id"]; 
			$landowner_name=$_GET["landowner_name"];
			$landowner_url=$_GET["landowner_url"];
			$lb_id=$_GET["lb_id"];
			$state_id=$_GET["state_id"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_insert="INSERT INTO `p2erls_landowners` VALUES (
				'".$landowner_id."',
				'No',
				'',
				'',
				'".$db_date."',
				'".$landowner_name."',
				'".$landowner_url."',
				'".$lb_id."',
				'".$state_id."')";
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_landowners` VALUES (
				'".$landowner_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$landowner_name."',
				'".$landowner_url."',
				'".$lb_id."',
				'".$state_id."')";
			}
			$result_insert = mysql_query($query_insert);
			?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Added<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") {
			$prev_landowner_id=$_GET["prev_landowner_id"];
			$landowner_id=$_GET["landowner_id"]; 
			$landowner_name=$_GET["landowner_name"];
			$landowner_url=$_GET["landowner_url"];
			$lb_id=$_GET["lb_id"];
			$state_id=$_GET["state_id"];
			
			$db_date = date("Y-m-d H:i:s");
			
			if ($_SESSION["p2erls_access_level"] == 1)
			{
				$query_update="UPDATE p2erls_landowners SET
				landowner_id='".$landowner_id."',
				last_updated='".$db_date."',
				landowner_name='".$landowner_name."',
				landowner_url='".$landowner_url."',
				lb_id='".$lb_id."',
				state_id='".$state_id."'
				WHERE landowner_id='".$prev_landowner_id."'";
				mysql_query($query_update);
				
				$query_update_landowner_assc="UPDATE p2erls_site_landowners SET landowner_id='".$landowner_id."' WHERE landowner_id='".$prev_landowner_id."'";
				mysql_query($query_update_landowner_assc);
			}
			else
			{
				$query_insert="INSERT INTO `p2erls_landowners` VALUES (
				'".$prev_landowner_id."',
				'Yes',
				'".$_SESSION["p2erls_account_num"]."',
				'".$db_date."',
				'',
				'".$landowner_name."',
				'".$landowner_url."',
				'".$lb_id."',
				'".$state_id."')";
				$result_insert = mysql_query($query_insert);
			} ?>
			
			<tr><td colspan=3><?php if ($_SESSION["p2erls_access_level"] == 1) { ?>Data Updated<?php } else { ?>Data Submitted For Approval<?php } ?></td></tr>
			
		<?php } // End of Update ?>
		<tr>
		<td>
		<table width="100%"><tr>
			<td width="10%"><b> ID </b></td>
			<td width="46%"><b> Landowner  Name </b></td> 
			<td width="13%"><b> Landowner  Bounds </b></td>
			<td width="12%"><b> Landowner  State </b></td> 
			<td width="10%">&nbsp;  </td>
			<?php if($_SESSION[p2erls_access_level] == "1"){?><td width="9%">&nbsp;  </td><?php } ?>
		</tr>
		<?php
		
		// Display all the data from the table
			$query_landowners = "SELECT * FROM p2erls_landowners WHERE pending_change != 'Yes' ORDER BY landowner_id ASC";
			$result_landowners = mysql_query($query_landowners);
			$num_results_landowners = mysql_num_rows($result_landowners);
			
			for ($i=0; $i < $num_results_landowners; $i++) {
				$landowner_id_curr= mysql_result($result_landowners,$i,"landowner_id"); 
				$landowner_name_curr= mysql_result($result_landowners,$i,"landowner_name");
				$landowner_url_curr= mysql_result($result_landowners,$i,"landowner_url");
				$lb_id_curr= mysql_result($result_landowners,$i,"lb_id");
				$state_id_curr= mysql_result($result_landowners,$i,"state_id");
				 ?>
			
			<?php
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$landowner_id_updating=$_GET["landowner_id"];
				
			}
			if($landowner_id_updating!=$landowner_id_curr) { ?>
				 <tr bgcolor="#ffffff">
				<td><?php echo"$landowner_id_curr";?></td> 
				<td><?php if($landowner_url_curr!=''){?><a href="<?php echo"$landowner_url_curr";?>" target="_blank"><?php } ?><?php echo"$landowner_name_curr";?><?php if($landowner_url_curr!=''){?></a><?php } ?></td> 
				<td><?php echo"$lb_id_curr";?></td> 
				<td><?php echo"$state_id_curr";?></td> 
				<td> <a href="javascript:requestInfo('showLandowner.php?mode=update&landowner_id=<?php echo"$landowner_id_curr";?>','showLandowner','')">Update</a> </td>
				<?php if($_SESSION[p2erls_access_level] == "1"){?><td><a href="javascript:requestInfo('showLandowner.php?mode=delete&landowner_id=<?php echo"$landowner_id_curr";?>','showLandowner','');" onclick="return confirmLink(this, 'landowner', '<?php echo"$landowner_id_curr";?>');">Delete</a></td><?php } ?>
			</tr> 
			<?php } ?>	
			 
			 
			
		
			<?php } ?></table>
		  </td>
		</tr>
		 </table> 
 