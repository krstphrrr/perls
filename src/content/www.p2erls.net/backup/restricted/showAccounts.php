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
			if($mode=="update" || $mode=="new") 
			{
			
				if($mode=="update")
				{
					$account_num=$_GET["account_num"]; 
					// Display all the data from the table 
					$sql="SELECT * FROM p2erls_accounts where account_num='$account_num' ORDER BY account_num ASC";
					$obj->query($sql);	
					while($row=$obj->query_fetch(0)) 
					{ 	
						$account_num		=$row["account_num"]; 
						$username			=$row["username"]; 
						$password			=$row["password"];
						$active_user		=$row["active_user"]; 
						$member_since_db	=$row["member_since"]; 
						$last_login_db		=$row["last_login"];
						$first_name			=$row["first_name"]; 
						$last_name			=$row["last_name"]; 
						$phone_num			=$row["phone_num"];
						$address1			=$row["address1"];
						$address2			=$row["address2"];
						$city				=$row["city"];
						$state_id			=$row["state_id"];
						$zip				=$row["zip"];
						$email				=$row["email"]; 
						$website			=$row["website"]; 
						$access_level		=$row["access_level"];
						$affiliation		=$row["affiliation"];
						$institution		=$row["institution"];
						$affil_role			=$row["affil_role"];
						$comments			=$row["comments"];
						
						require_once ("includes/function_convert_db_date.php");
						$d = new date_functions;
						$member_since = $d->convert_db_date($member_since_db);
						$last_login = $d->convert_db_date($last_login_db);
					} 
				}
				?>
  <tr>
    <td colspan=11><div align="center">
        <h3>
          <?php if($mode=='new') {?>
          Add
          <?php } else { ?>
          Update
          <?php }?>
          Account <?php echo"$account_num";?> <br />
        </h3>
      </div>
      <table width="456" align="center" cellpadding="5" cellspacing="0">
        <tr bgcolor="#ffffff">
          <td width="153"><input type="hidden" value="<?php echo"$account_num";?>" name="account_num" id="account_num" ecosystem_id="account_num">
            Account Number </td>
          <td width="281"><?php echo"$account_num";?></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Username</td>
          <td><input type="text" value="<?php echo"$username";?>" name="username" id="username" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Password</td>
          <td><input type="text" value="<?php echo"$password";?>" name="password" id="password" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Active User </td>
          <td><?php echo"$active_user";?></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Member Since </td>
          <td><?php echo"$member_since";?></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Last Login </td>
          <td><?php echo"$last_login";?></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>First Name </td>
          <td><input type="text" value="<?php echo"$first_name";?>" name="first_name" id="first_name" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Last Name </td>
          <td><input type="text" value="<?php echo"$last_name";?>" name="last_name" id="last_name" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Phone Number </td>
          <td><input type="text" value="<?php echo"$phone_num";?>" name="phone_num" id="phone_num" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>Address 1 </td>
            <td><input type="text" value="<?php echo"$address1";?>" name="address1" id="address1" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>Address 2 </td>
            <td><input type="text" value="<?php echo"$address2";?>" name="address2" id="address2" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>City</td>
            <td><input type="text" value="<?php echo"$city";?>" name="city" id="city" size="30"></td>
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
              <option value="<?php echo"$state_id2"; ?>" selected="selected"><?php echo"$state_name2"; ?> </option>
              <?php } ?>
              <?php if($state_id!=$state_id2){?>
              <option value="<?php echo"$state_id2"; ?>"><?php echo"$state_name2"; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
			
			</td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>Zip</td>
            <td><input type="text" value="<?php echo"$zip";?>" name="zip" id="zip" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Email</td>
          <td><input type="text" value="<?php echo"$email";?>" name="email" id="email" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Website</td>
          <td><input type="text" value="<?php echo"$website";?>" name="website" id="website" size="30"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Access Level</td>
          <td align="left"><select name="access_level" id="access_level">
              <?php 
			if ( $access_level == '0'){	echo '  <option value="" selected>Select</option>';} 
			else { echo '  <option value="0">Select</option>';}
			if ( $access_level == '1'){	echo '  <option value="1" selected>Main Admin</option>';} 
			else { echo '  <option value="1">Main Admin</option>';}
			if ( $access_level == '2'){	echo '  <option value="2" selected>Moderator</option>';} 
			else { echo '  <option value="2">Moderator</option>';}
			if ( $access_level == '3'){	echo '  <option value="3" selected>Basic User</option>';} 
			else { echo '  <option value="3">Basic User</option>';}
	  ?>
            </select></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Affiliation Type </td>
          <td align="left"><select name="affiliation" id="affiliation">
		  <option value="None" <?php if($affiliation == ""){ ?>selected="selected"<?php } ?>>None</option>
		  <option value="K-12" <?php if($affiliation == "K-12"){ ?>selected="selected"<?php } ?>>K-12</option>
		  <option value="College or University" <?php if($affiliation == "College or University"){ ?>selected="selected"<?php } ?>>College or University</option>
		  <option value="NPO" <?php if($affiliation == "NPO"){ ?>selected="selected"<?php } ?>>Non-Profit Agency</option>
		  <option value="State or Federal Agency" <?php if($affiliation == "State or Federal Agency"){ ?>selected="selected"<?php } ?>>State or Federal Agency</option>
		  <option value="Private Company" <?php if($affiliation == "Private Company"){ ?>selected="selected"<?php } ?>>Private Company</option>

          </select>          </td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>Institution:</td>
		  <?php $institutions_def = array('NMSU','USDA','Jornada','Ecotrends','EPA'); ?>
          <td align="left">
		  <form name="wrapper"><select name="institution_drop" id="<?php if(!in_array($institution, $institutions_def)){ echo "institution_drop";} else{ echo "institution";} ?>" onchange="toggle_affiliation2();">
              <option value="none" <?php if($institution == "none"){ ?>selected="selected" <?php } ?>>None</option>
              <option value="NMSU" <?php if($institution == "NMSU"){ ?> selected="selected" <?php } ?>>NMSU</option>
              <option value="USDA" <?php if($institution == "USDA"){ ?> selected="selected" <?php } ?>>USDA</option>
              <option value="Jornada" <?php if($institution == "Jornada"){ ?> selected="selected" <?php } ?>>Jornada</option>
              <option value="Ecotrends" <?php if($institution == "Ecotrends"){ ?> selected="selected" <?php } ?>>Ecotrends</option>
              <option value="EPA" <?php if($institution == "EPA"){ ?> selected="selected" <?php } ?>>EPA</option>
              <option value="other" <?php if(!in_array($institution, $institutions_def)){ ?> selected="selected" <?php } ?>>Other</option>
            </select>
                <input name="institution_other" id="<?php if(!in_array($institution, $institutions_def)){ echo "institution";} else{ echo "institution_other";} ?>" type="text" style="display:<?php if(!in_array($institution , $institutions_def)){ echo "block";} else{ echo "none";} ?>" value="<?php if(!in_array($institution , $institutions_def)){ echo "$institution";} ?>" /></form>              </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td>Role at Institution: </td>
          <td align="left"><input name="affil_role" id="affil_role" type="text" value="<?php echo "$affil_role"; ?>" />
            &nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td>Comments:</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td colspan="2"><textarea name="comments" id="comments" cols="56" rows="15"><?php echo "$comments"; ?></textarea></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center" bgcolor="#ffffff">
          <td colspan="2"><a href="javascript:requestInfo('showAccounts.php?mode=list&account_num=<?php echo"$account_num";?>','showAccounts','')">Cancel</a> ||
            <?php if($mode!='new') {?>
            <a href="javascript:update_data('<?php echo"$account_num";?>');">Save</a>
            <?php } ?>
            <?php if($mode=='new') {?>
            <a href="javascript:save_data();">Save</a>
        <?php } ?>        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan=11>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan=20 bgcolor="#FFFFFF"><a href="javascript:requestInfo('showAccounts.php?mode=new&account_num=<?php echo"$account_num";?>','showAccounts','')">Add New Data</a> || <a href="javascript:requestInfo('showAccounts.php?mode=list','showAccounts','')">Refresh</a></td>
  </tr>
  <?php
		// For Delete 
		if($mode=="delete") 
		{		
			$var_account_num=$_GET["account_num"];
			$sqlDelete="DELETE FROM p2erls_accounts where account_num='$var_account_num'";
			$obj->query($sqlDelete);?>
  <tr>
    <td colspan=3>Data Deleted</td>
  </tr>
  <?php } ?>
  <?php
		// After Click on Add >> Save option the data is save into the database 
		if($mode=="save_new") 
		{
				
				$account_num		=$_GET["account_num"]; 
				$username			=$_GET["username"]; 
				$password			=$_GET["password"];
				$active_user		=$_GET["active_user"]; 
				$member_since		=$_GET["member_since"]; 
				$last_login			=$_GET["last_login"];
				$first_name			=$_GET["first_name"]; 
				$last_name			=$_GET["last_name"]; 
				$phone_num			=$_GET["phone_num"];
				$address1			=$_GET["address1"];
				$address2			=$_GET["address2"];
				$city				=$_GET["city"];
				$state_id			=$_GET["state_id"];
				$zip				=$_GET["zip"];
				$email				=$_GET["email"]; 
				$website			=$_GET["website"]; 
				$access_level		=$_GET["access_level"];
				$affiliation		=$_GET["affiliation"]; 
				$institution		=$_GET["institution"]; 
				$affil_role			=$_GET["affil_role"]; 
				$comments			=$_GET["comments"]; 
				 
			
			$sqlSave="INSERT INTO p2erls_accounts VALUES(
				'$account_num', 
				'$username', 
				'$password', 
				'', 
				'', 
				'', 
				'$first_name', 
				'$last_name', 
				'$phone_num', 
				'$address1', 
				'$address2', 
				'$city', 
				'$state_id', 
				'$zip', 
				'$email', 
				'$website', 
				'$access_level',
				'$affiliation',
				'$institution',
				'$affil_role',
				'$comments'
			)";
			$obj->query($sqlSave); ?>
  <tr>
    <td colspan=3>Data Saved
  </tr>
  <?php }
		// End of save_new 
		
		// For Update save Option
		if($mode=="update_data") 
		{
				$account_num		=$_GET["account_num"]; 
				$username			=$_GET["username"]; 
				$password			=$_GET["password"];
				$active_user		=$_GET["active_user"]; 
				$member_since		=$_GET["member_since"]; 
				$last_login			=$_GET["last_login"];
				$first_name			=$_GET["first_name"]; 
				$last_name			=$_GET["last_name"]; 
				$phone_num			=$_GET["phone_num"];
				$address1			=$_GET["address1"];
				$address2			=$_GET["address2"];
				$city				=$_GET["city"];
				$state_id			=$_GET["state_id"];
				$zip				=$_GET["zip"];
				$email				=$_GET["email"]; 
				$website			=$_GET["website"]; 
				$access_level		=$_GET["access_level"];
				$affiliation		=$_GET["affiliation"]; 
				$institution		=$_GET["institution"]; 
				$affil_role			=$_GET["affil_role"]; 
				$comments			=$_GET["comments"]; 
				 
			$sqlUpdate="UPDATE p2erls_accounts set 
				username='$username', 
				password='$password', 
				first_name='$first_name',
				last_name='$last_name', 
				phone_num='$phone_num',
				address1='$address1',
				address2='$address2',
				city='$city',
				state_id='$state_id',
				zip='$zip',
				email='$email', 
				website='$website',
				access_level='$access_level',
				affiliation='$affiliation',
				institution='$institution',
				affil_role='$affil_role',
				comments='$comments'
			where account_num='$account_num'";
			
			$obj->query($sqlUpdate);?>
  <tr>
    <td colspan=3>Data Updated
  </tr>
  <?php } // End of Update ?>
  <tr>
    <td><table width="100%">
        <tr>
          <td width="18%"><b>Username</b></td>
          <td width="24%"><b>Account Name</b></td>
          <td width="30%"><b>Email</b></td>
          <td width="14%"><b>Access Level</b></td>
          <td width="7%">&nbsp;</td>
          <td width="7%">&nbsp;</td>
        </tr>
        <?php
		
		// Display all the data from the table 
			$sql="SELECT * FROM p2erls_accounts ORDER BY account_num ASC";
			$obj->query($sql);	
			while($row=$obj->query_fetch(0)) {
				$account_num	=$row["account_num"]; 
				$username		=$row["username"]; 
				$password		=$row["password"];
				$active_user	=$row["active_user"]; 
				$member_since	=$row["member_since"]; 
				$last_login		=$row["last_login"];
				$first_name		=$row["first_name"]; 
				$last_name		=$row["last_name"]; 
				$phone_num		=$row["phone_num"];
				$address1		=$row["address1"];
				$address2		=$row["address2"];
				$city			=$row["city"];
				$state_id		=$row["state_id"];
				$zip			=$row["zip"];
				$email			=$row["email"]; 
				$website		=$row["website"]; 
				$access_level	=$row["access_level"];  
				 
			// if Mode is Update then get the ID and display the text field with value Other wise print the data into the table 
			if($mode=="update") {
				$account_num2=$_GET["account_num"];
				
			}
			if($account_num2!=$account_num) { ?>
        <tr bgcolor="#ffffff">
          <td><?php echo"$username";?></td>
          <td><?php echo"$first_name $last_name";?></td>
          <td><?php echo"$email";?></td>
          <td><?php echo"$access_level";?></td>
          <td><a href="javascript:requestInfo('showAccounts.php?mode=update&account_num=<?php echo"$account_num";?>','showAccounts','')">Update</a> </td>
          <td><?php if($_SESSION[p2erls_access_level] == "1"){?><a href="javascript:requestInfo('showAccounts.php?mode=delete&account_num=<?php echo"$account_num";?>','showAccounts','');" onclick="return confirmLink(this, 'username', '<?php echo"$account_num";?>');">Delete</a><?php } ?></td>
        </tr>
        <?php } ?> <?php } ?> 
      </table></td>
  </tr>
</table>
