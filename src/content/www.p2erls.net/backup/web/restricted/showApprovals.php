<?php
require("Security_Dept/config.php");
include("includes/mysql.lib.php");
$obj=new connect;
$mode=$_GET["mode"];
?>

<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#eeeeee" align="center" >
	<tr>
		<td>
		<?php if ($mode=='update_assc')
		{
			$cat_id=$_GET["cat_id"];
			$curr_id=$_GET["curr_id"];
			$pkey=$_GET["pkey"];
			
			$cat_id_assc=$_GET["cat_id_assc"]; //site_landowner
			$assc_pkey=$_GET["assc_pkey"]; //landowner_id
			$cat_id_assc_2=$_GET["cat_id_assc_2"]; //site_landowner
			$assc_pkey_2=$_GET["assc_pkey_2"]; //landowner_id
			$main_cat_approvals=$_GET["main_cat_approvals"];
			
			echo "assc_pkey = $assc_pkey<br>";
			echo "assc_pkey_2 = $assc_pkey_2<br>";
			
			//$cat_id_assc = str_replace("_", " ", $cat_id_assc);
			$z = explode("_", $cat_id_assc);
			$cat = $z[0]; $assc = rtrim($z[1],"s");
			
			//$cat_id_assc_2 = str_replace("_", " ", $cat_id_assc_2);
			$zz = explode("_", $cat_id_assc_2);
			$cat_2 = $zz[0]; $assc_2 = rtrim($zz[1],"s");
			
			/*************************************************
			**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
			*************************************************/
			if ($assc == 'co')
			{
				$special_assc = 'continents_ocean';
				$assc_display_name = 'Continents / Oceans';				
			}
			else
			{
				if ($cat_id_assc != '')
				{
					$assc_display_name = ucwords($z[1]);
				}
				if ($cat_id_assc_2 != '')
				{
					$assc_display_name = ucwords($zz[1]);
				}
			}
			/*************************************************
			**					END SCA						**
			*************************************************/
			
			if ($cat_id_assc != '')
			{
				$cat_display_name = ucfirst($cat);
			}
			if ($cat_id_assc_2 != '')
			{
				$cat_display_name = ucfirst($cat_2);
			}
			
			$spare_part_1=$_GET["spare_part_1"]; //site_landowner
			$spare_part_2=$_GET["spare_part_2"]; //landowner_id
			$spare_part_3=$_GET["spare_part_3"]; //site_gradient
			$spare_part_4=$_GET["spare_part_4"]; //gradient_id
			
			//$query_account = "SELECT DISTINCT account_num FROM p2erls_".$cat_id_assc." WHERE pending_change='Yes' AND $pkey='$curr_id'";
			//$result_account = mysql_query($query_account);
			//$account_num= mysql_result($result_account,0,"account_num");		
		?>
		<h3 align="center">Approve <?php echo "$assc_display_name"; ?> For <?php echo "$cat_display_name $curr_id"; ?></h3>
		<p>Please note, if you choose to approve/deny only some of these approvals, all will still be here when you attempt to come back. Thus, it may be in your best interest to decide upon them all at once.</p>
		<table align="center" bgcolor="#ffffff" cellpadding="5" cellspacing="0">
			<tr>
				<td style="padding-right:20px;"><b><?php echo "$assc_display_name"; ?></b></td>
				<td><b>Username</b></td>
				<td style="padding-left:20px;"><b>Proposal</b></td>
				<td style="padding-left:20px;"><b>Action</b></td>
			</tr>
			<?php
			$parameters = '';
			
			/*************************************************
			**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
			*************************************************/
			if ($special_assc == '')
			{
				if ($cat_id_assc != '')
				{
					$query_assc = "SELECT $assc_pkey, ".$assc."_name FROM p2erls_".$assc."s ORDER BY ".$assc."_name ASC";
				}
				if ($cat_id_assc_2 != '')
				{
					$query_assc = "SELECT $assc_pkey_2, ".$assc_2."_name FROM p2erls_".$assc_2."s ORDER BY ".$assc_2."_name ASC";
				}
			}
			else
			{
				if ($cat_id_assc != '')
				{
					$query_assc = "SELECT $assc_pkey, ".$assc."_name FROM p2erls_".$special_assc."s ORDER BY ".$assc."_name ASC";
				}
				if ($cat_id_assc_2 != '')
				{
					$query_assc = "SELECT $assc_pkey_2, ".$assc_2."_name FROM p2erls_".$special_assc."s ORDER BY ".$assc_2."_name ASC";
				}
			}
			/*************************************************
			**					END SCA						**
			*************************************************/
			
			$result_assc = mysql_query($query_assc);
			$num_results_assc = mysql_num_rows($result_assc);
			//echo "query_assc = $query_assc<br>";
			//echo "num_results_assc = $num_results_assc<br>";
			
			if ($num_results_assc != 0)
			{
				for ($s=0; $s < $num_results_assc; $s++)
				{
					if ($cat_id_assc != '')
					{
						$assc_id_db= mysql_result($result_assc,$s,"$assc_pkey");
						$assc_name_db= mysql_result($result_assc,$s,"$assc"."_name");
						//echo "assc_name_db = $assc_name_db<br>";
					}
					if ($cat_id_assc_2 != '')
					{
						$assc_id_db_2= mysql_result($result_assc,$s,"$assc_pkey_2");
						$assc_name_db_2= mysql_result($result_assc,$s,"$assc_2"."_name");
						//echo "assc_name_db_2 = $assc_name_db_2<br>";
					}
					
					if ($cat_id_assc != '')
					{
						$query_assc_cat = "SELECT delete_assc, account_num FROM p2erls_".$cat_id_assc." WHERE pending_change='Yes' AND $pkey='$curr_id' AND $assc_pkey='$assc_id_db'";
					}
					if ($cat_id_assc_2 != '')
					{
						$query_assc_cat = "SELECT delete_assc, account_num FROM p2erls_".$cat_id_assc_2." WHERE pending_change='Yes' AND $pkey='$curr_id' AND $assc_pkey_2='$assc_id_db_2'";
					}
					$result_assc_cat = mysql_query($query_assc_cat);
					$num_results_assc_cat = mysql_num_rows($result_assc_cat);
					//echo "query_assc_cat = $query_assc_cat<br>";
					//echo "num_results_assc_cat = $num_results_assc_cat<br><br>";
					
					if ($num_results_assc_cat != 0)
					{
						$delete_assc= mysql_result($result_assc_cat,0,"delete_assc");
						$account_num= mysql_result($result_assc_cat,0,"account_num");
					
						$query_username = "SELECT username FROM p2erls_accounts WHERE account_num='$account_num'";
						$result_username = mysql_query($query_username);
						$acct_username= mysql_result($result_username,0,"username");
						//echo "delete_assc = $delete_assc<br>";
					?>
				<tr>
					<td style="padding-right:20px;"><?php if ($cat_id_assc != '') { echo "$assc_name_db"; } if ($cat_id_assc_2 != '') { echo "$assc_name_db_2"; } ?></td>
					<td><a href="accounts.php?mode=update&account_num=<?php echo "$account_num"; ?>"><?php echo "$acct_username"; ?></a></td>
					<td style="padding-left:20px;"><div id="proposed_<?php if ($cat_id_assc != '') { echo "$assc_id_db"; } if ($cat_id_assc_2 != '') { echo "$assc_id_db_2"; } ?>"><?php if ($delete_assc != 'Yes') { echo 'Add'; } else { echo 'Remove'; } ?></div></td>
					<td style="padding-left:20px;"><select name="action_<?php if ($cat_id_assc != '') { echo "$assc_id_db"; } if ($cat_id_assc_2 != '') { echo "$assc_id_db_2"; } ?>" id="action_<?php if ($cat_id_assc != '') { echo "$assc_id_db"; } if ($cat_id_assc_2 != '') { echo "$assc_id_db_2"; } ?>">
						<option value="" selected="selected">Choose</option>
						<option value="Approve">Approve</option>
						<option value="Deny">Deny</option>
					</select></td>
				</tr>
					<?php if ($cat_id_assc != '') { $parameters .= "$assc_id_db,"; } if ($cat_id_assc_2 != '') { $parameters .= "$assc_id_db_2,"; }
					}
					$approval_ids = rtrim($parameters, ",");
				}
			} ?>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>			
			<tr align="center">
				<td colspan="4"><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=<?php echo "$cat_id"; ?>&curr_id=<?php echo "$curr_id"; ?>&pkey=<?php echo "$pkey"; if ($cat_id_assc != '' || $spare_part_1 != '') { ?>&cat_id_assc=<?php if ($spare_part_1 != '') { echo "$spare_part_1"; } else { echo "$cat_id_assc"; } ?>&assc_pkey=<?php if ($spare_part_2 != '') { echo "$spare_part_2"; } else { echo "$assc_pkey"; } } if ($cat_id_assc_2 != '' || $spare_part_3 != '') { ?>&cat_id_assc_2=<?php if ($spare_part_3 != '') { echo "$spare_part_3"; } else { echo "$cat_id_assc_2"; } ?>&assc_pkey_2=<?php if ($spare_part_4 != '') { echo "$spare_part_4"; } else { echo "$assc_pkey_2"; } } ?>','showApprovals','')">Cancel</a> || <a href="javascript:update_data('p2erls_<?php if ($cat_id_assc != '') { echo "$cat_id_assc"; } if ($cat_id_assc_2 != '') { echo "$cat_id_assc_2"; } ?>','<?php echo "$pkey"; ?>','<?php echo "$curr_id"; ?>','<?php if ($cat_id_assc != '') { echo "$assc_pkey"; } if ($cat_id_assc_2 != '') { echo "$assc_pkey_2"; } ?>','<?php echo "$approval_ids"; ?>');">Save</a></td>
			</tr>
		</table>
		<?php } ?>
		
		<?php // if Mode is Update, get the ID of the category being updated so that it is not included in the main list while updating
		if ($mode == "view")
		{
			$pkey_updating=$_GET["pkey"];				
		}
		
		if ($mode == "update")
		{
			$cat_id=$_GET["cat_id"];
			
			/*************************************************
			**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
			*************************************************/
			
			if ($cat_id == 'Co')
			{
				$cat = str_replace("_", " / ", $cat_id);
			}
			else
			{
				$cat = str_replace("_", " ", $cat_id);
			}
			
			/*************************************************
			**					END SCA						**
			*************************************************/
			$category = ucwords($cat);
			
			$pkey=$_GET["pkey"];
			$curr_id=$_GET["curr_id"];
			
			$cat_id_assc=$_GET["cat_id_assc"]; //gradient_region
			$cat_id_assc_2=$_GET["cat_id_assc_2"];
			$assc_pkey=$_GET["assc_pkey"]; //landowner_id
			$assc_pkey_2=$_GET["assc_pkey_2"]; //gradient_id
			
			$account_num=$_GET["acct"];
			
			$query_username = "SELECT username FROM p2erls_accounts WHERE account_num='$account_num'";			
			$result_username = mysql_query($query_username);
			$account_username= mysql_result($result_username,0,"username");			
		?>
			<h3 align="center">Update <?php echo "$category $curr_id"; ?></h3>
			<p align="center" style="font-size:10px;"><b>Proposed By <a href="accounts.php?mode=update&account_num=<?php echo "$account_num"; ?>"><?php echo "$account_username"; ?></a></b></p>
			<table width="456" align="center" bgcolor="#ffffff" cellpadding="5" cellspacing="0">
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<?php
				$main_cat_approvals=$_GET["main_cat_approvals"];
				if ($main_cat_approvals != 'No')
				{				
					$parameters = '';
					
					$query_fields = "SELECT * FROM p2erls_".$cat_id;
					$result_fields = mysql_query($query_fields);
					$num_results_fields = mysql_num_fields($result_fields);
					
					for ($i=0; $i < $num_results_fields; $i++) {
						$db_field = mysql_field_name($result_fields, $i);
						if ($db_field != 'pending_change' && $db_field != 'account_num' && $db_field != 'proposed_date' && $db_field != 'last_updated')
						{
							$field = str_replace("_", " ", $db_field);							
							$field_name = ucwords($field);							
							$x = explode(" ", $field_name); //ecosystem id
							
							/*************************************************
							**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
							*************************************************/
							
							if ($x[0] == 'Lb') { $x[0] = 'Landowner Bounds'; }
							if ($x[0] == 'Co') { $x[0] = 'Continents / Oceans'; }
							
							/*************************************************
							**					END SCA						**
							*************************************************/
										
							if (strstr($field, " id") == true)
							{
								if ($i > 0) { $element_type = 'dynamic drop-down'; } else { $element_type = 'text'; }
								$field_display_name = $x[0]." ID";
							}
							elseif (strstr($field, " desc") == true)
							{
								$element_type = 'textarea';
								//$x = explode(" ", $field_name);
								$field_display_name = $x[0]." Description";
							}
							else
							{
								$element_type = 'textbox';
								/*************************************************
								**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
								*************************************************/
								
								if (field_name == 'Co') { $field_display_name = 'Continents / Oceans'; }
								else { $field_display_name = $field_name; }
								
								/*************************************************
								**					END SCA						**
								*************************************************/
							}

							$query_total_pkey_approvals_count = "SELECT * FROM p2erls_".$cat_id." WHERE $pkey='$curr_id'";
							$result_total_pkey_approvals_count = mysql_query($query_total_pkey_approvals_count);
							$num_results_total_pkey_approvals_count = mysql_num_rows($result_total_pkey_approvals_count);
							
							if ($num_results_total_pkey_approvals_count > 1)
							{
								$query_curr = "SELECT $db_field FROM p2erls_".$cat_id." WHERE pending_change='No' AND $pkey='$curr_id'";
								$result_curr = mysql_query($query_curr);
								$num_results_curr = mysql_num_fields($result_curr);
								//echo "query_curr = $query_curr<br>";
								
								if ($num_results_curr != 0) { $field_value_curr= mysql_result($result_curr,0,"$db_field"); }
							}
							
							$query_proposed = "SELECT $db_field FROM p2erls_".$cat_id." WHERE pending_change='Yes' AND $pkey='$curr_id'";
							$result_proposed = mysql_query($query_proposed);
							$num_results_proposed = mysql_num_fields($result_proposed);
							//echo "query_proposed = $query_proposed<br>";
							
							if ($num_results_proposed != 0) { $field_value_proposed= mysql_result($result_proposed,0,"$db_field"); }
							
							$field_value_proposed= mysql_result($result_proposed,0,"$db_field");
							
							if ($field_value_curr != $field_value_proposed)
							{
								if ($i != 0)
								{
									echo "<tr><td colspan='2'><hr width='95%' noshade /></td></tr>";
								}
								
								if ($element_type != 'dynamic drop-down')
								{
									if ($field_value_curr != '0') { $field_value_actual = $field_value_curr; } else { $field_value_actual = ''; }
								}
								else
								{
									$y = explode("_", $db_field); //ecosystem id
									$db_id_name = $y[0]; //ecosystem
									//$db_id_field_name = $db_id_name."_name";
									//$id_name = ucfirst($db_id_name);
									
									/*************************************************
									**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
									*************************************************/
									
									if ($db_id_name == 'country') { $db_id_table_name = 'countrie'; }
									elseif ($db_id_name == 'lb') { $db_id_table_name = 'landowner_bound'; }
									elseif ($db_id_name == 'co') { $db_id_table_name = 'continents_ocean'; }
									else { $db_id_table_name = $db_id_name; }
									
									if ($db_id_name == 'lb') { $db_id_field_name = $db_id_name."_id"; }
									else { $db_id_field_name = $db_id_name."_name"; } //ecosystem_name
									
									/*************************************************
									**					END SCA						**
									*************************************************/
									
									$db_id_table = 'p2erls_'.$db_id_table_name.'s';
									
									$field_value_actual = $field_value_curr;
									
									if ($field_value_curr != '')
									{
										$query_curr_id_name = "SELECT $db_id_field_name FROM $db_id_table WHERE $db_field='$field_value_curr'";
										$result_curr_id_name = mysql_query($query_curr_id_name);
										$num_results_curr_id_name = mysql_num_fields($result_curr_id_name);
										
										if ($num_results_curr_id_name != 0) { $field_value_curr_id_name= mysql_result($result_curr_id_name,0,"$db_id_field_name"); }
									}
									
									if ($field_value_proposed != '')
									{
										$query_proposed_id_name = "SELECT $db_id_field_name FROM $db_id_table WHERE $db_field='$field_value_proposed'";
										//echo "query_proposed_id_name = $query_proposed_id_name<br>";
										$result_proposed_id_name = mysql_query($query_proposed_id_name);
										$num_results_proposed_id_name = mysql_num_fields($result_proposed_id_name);
										
										if ($num_results_proposed_id_name != 0) { $field_value_proposed_id_name= mysql_result($result_proposed_id_name,0,"$db_id_field_name"); }
									}
								}						
					?>
				<tr>
					<td width="25%" align="right" valign="top"><div id="<?php echo "$db_field"; ?>"><?php echo "$field_display_name"; ?>:</div></td>
					<td width="75%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
						<tr>
							<td width="22%" valign="top">Previous - </td>
							<td width="78%"><b><?php if ($element_type != 'dynamic drop-down') { echo "$field_value_actual"; } else { echo "$field_value_curr_id_name"; } ?></b>
							<input type="hidden" name="previous_<?php echo "$db_field"; ?>" id="previous_<?php echo "$db_field"; ?>" value="<?php echo "$field_value_actual"; ?>" /></td>
						</tr>
						<tr>
							<td valign="top">Proposed - </td>
							<td><?php if ($element_type != 'dynamic drop-down')
							{
								if ($element_type == 'textbox') { ?>
									<input type="text" name="proposed_<?php echo "$db_field"; ?>" id="proposed_<?php echo "$db_field"; ?>" value="<?php echo "$field_value_proposed"; ?>" size="30" />
								<?php }
								else
								{ ?>
                                	<textarea name="proposed_<?php echo "$db_field"; ?>" id="proposed_<?php echo "$db_field"; ?>" cols="30" rows="10"><?php echo "$field_value_proposed"; ?></textarea>								
                              	<?php }
							}
							if ($element_type == 'dynamic drop-down')
							{
								$query_proposed_id = "SELECT $db_field, $db_id_field_name FROM $db_id_table ORDER BY $db_id_field_name";
								$result_proposed_id = mysql_query($query_proposed_id);
								$num_results_proposed_id = mysql_num_rows($result_proposed_id); ?>						
		
							<select name="proposed_<?php echo "$db_field"; ?>" id="proposed_<?php echo "$db_field"; ?>">
								<?php for ($a=0; $a < $num_results_proposed_id; $a++) {
									$proposed_id= mysql_result($result_proposed_id,$a,"$db_field");
									$proposed_id_name= mysql_result($result_proposed_id,$a,"$db_id_field_name");
								?>
								<option value="<?php echo "$proposed_id"; ?>"<?php if ($field_value_proposed == $proposed_id) { echo " selected='selected'"; } ?>><?php echo "$proposed_id_name"; ?></option>
								<?php } ?>
								<option value=""<?php if ($field_value_proposed == '') { echo " selected='selected'"; } ?>>None</option>
							</select>
							<?php } ?></td>
						</tr>
						<!--						
						<tr>
							<td colspan="2"><input type="radio" name="action_<?php echo "$db_field"; ?>" id="action_<?php echo "$db_field"; ?>" value="Approve" />Approve
							&nbsp;&nbsp;&nbsp;<input type="radio" name="action_<?php echo "$db_field"; ?>" id="action_<?php echo "$db_field"; ?>" value="Deny" />Deny</td>
						</tr>
						-->
						<tr>
							<td><br /><b>Action -</b></td>
							<td><br /><select name="action_<?php echo "$db_field"; ?>" id="action_<?php echo "$db_field"; ?>">
								<option value="" selected="selected">Choose</option>
								<option value="Approve">Approve</option>
								<option value="Deny">Deny</option>
							</select></td>
						</tr>
					</table>
					</td>
				</tr>
					<?php
							$parameters .= "$db_field,";
						}
					}
					$approval_fields = rtrim($parameters, ",");
				}
				?>
				<tr>
					<td colspan="2"><hr width="95%" noshade /></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<?php
				}			
				if ($cat_id_assc != '')
				{
					$query_cat_id_assc_check = "SELECT * FROM p2erls_".$cat_id_assc." WHERE pending_change = 'Yes' AND $pkey = '$curr_id'";
					$result_cat_id_assc_check = mysql_query($query_cat_id_assc_check);
					$num_results_cat_id_assc_check = mysql_num_rows($result_cat_id_assc_check);
					
					if ($num_results_cat_id_assc_check != 0)
					{
						$z = explode("_", $cat_id_assc);
						//$assc_name = ucwords($z[1]).'s';
						$assc_name = ucwords($z[1]);
						if ($assc_name == 'Co') { $assc_name = 'Continents / Oceans'; }
						if ($assc_name == 'Lb') { $assc_name = 'Landowner Bounds'; }
				?>
				<tr>
					<td colspan="2"><a href="javascript:requestInfo('showApprovals.php?mode=update_assc&cat_id=<?php echo "$cat_id"; ?>&curr_id=<?php echo "$curr_id"; ?>&pkey=<?php echo "$pkey"; ?>&cat_id_assc=<?php echo "$cat_id_assc"; ?>&assc_pkey=<?php echo "$assc_pkey"; ?>&spare_part_1=<?php echo "$cat_id_assc"; ?>&spare_part_2=<?php echo "$assc_pkey"; if ($cat_id_assc_2 != '') { ?>&spare_part_3=<?php echo "$cat_id_assc_2"; ?>&spare_part_4=<?php echo "$assc_pkey_2"; } ?>','showApprovals','')">Approve <?php echo "$assc_name"; ?></a></td>
				</tr>
				<?php
					}					
					if ($cat_id_assc_2 != '')
					{
						$query_cat_id_assc_2_check = "SELECT * FROM p2erls_".$cat_id_assc_2." WHERE pending_change = 'Yes' AND $pkey = '$curr_id'";
						$result_cat_id_assc_2_check = mysql_query($query_cat_id_assc_2_check);
						$num_results_cat_id_assc_2_check = mysql_num_rows($result_cat_id_assc_2_check);
						
						if ($num_results_cat_id_assc_2_check != 0)
						{
							$zz = explode("_", $cat_id_assc_2);
							//$assc_name_2 = ucwords($zz[1]).'s';
							$assc_name_2 = ucwords($zz[1]);
				?>
				<tr>
					<td colspan="2"><a href="javascript:requestInfo('showApprovals.php?mode=update_assc&cat_id=<?php echo "$cat_id"; ?>&curr_id=<?php echo "$curr_id"; ?>&pkey=<?php echo "$pkey"; ?>&cat_id_assc=<?php echo "$cat_id_assc_2"; ?>&assc_pkey=<?php echo "$assc_pkey_2"; ?>&spare_part_1=<?php echo "$cat_id_assc"; ?>&spare_part_2=<?php echo "$assc_pkey"; ?>&spare_part_3=<?php echo "$cat_id_assc_2"; ?>&spare_part_4=<?php echo "$assc_pkey_2"; ?>','showApprovals','')">Approve <?php echo "$assc_name_2"; ?></a></td>
				</tr>
				<?php
						}
					}
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<?php } ?>
				<tr align="center">
					<td colspan="2"><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=<?php echo "$cat_id"; ?>&pkey=<?php echo "$pkey"; if ($cat_id_assc != '') { ?>&cat_id_assc=<?php echo "$cat_id_assc"; ?>&assc_pkey=<?php echo "$assc_pkey"; } if ($cat_id_assc_2 != '') { ?>&cat_id_assc_2=<?php echo "$cat_id_assc_2"; ?>&assc_pkey_2=<?php echo "$assc_pkey_2"; } if ($num_results_main_cat == 0) { ?>&main_cat_approvals=No<?php } ?>','showApprovals','')">Cancel</a> || <a href="javascript:update_data('p2erls_<?php echo "$cat_id"; ?>','<?php echo "$pkey"; ?>','<?php echo "$curr_id"; ?>','','<?php echo "$approval_fields"; ?>');">Save</a></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		<?php
			// if Mode is Update, get the ID of the category being updated so that it is not included in the main list while updating
			$cat_id_updating=$_GET["cat_id"];
			$curr_id_updating=$_GET["curr_id"];
			
			$cat_id=$_GET["cat_id"]; //gradients
			$cat = str_replace("_", " ", $cat_id);
			$category = ucwords($cat);
			$pkey=$_GET["pkey"]; //gradient_id
			$col = explode("_", $pkey);
			$column = $col[0]; //gradient			
			$column_name = ucwords($col[0]);
			
			$cat_id_assc=$_GET["cat_id_assc"]; //gradient_region
			$assc_pkey=$_GET["assc_pkey"]; //region_id
			
			$cat_id_assc_2=$_GET["cat_id_assc_2"];
			$assc_pkey_2=$_GET["assc_pkey_2"];
				
			$query_main_cat = "SELECT * FROM p2erls_".$cat_id." WHERE pending_change = 'Yes' ORDER BY $pkey";
			$result_main_cat = mysql_query($query_main_cat);
			$num_results_main_cat = mysql_num_rows($result_main_cat);
		?>	
			<table width="100%">
				<?php
				// For Update save Option
				if ($mode == "update_data")
				{ ?>			
				<tr>
					<td colspan="5"><div id="confirmUpdate">Data Updated</div>
				</tr>			
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="5" bgcolor="#FFFFFF"><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=<?php echo "$cat_id"; ?>&pkey=<?php echo "$pkey"; if ($cat_id_assc != '') { ?>&cat_id_assc=<?php echo "$cat_id_assc"; ?>&assc_pkey=<?php echo "$assc_pkey"; } if ($cat_id_assc_2 != '') { ?>&cat_id_assc_2=<?php echo "$cat_id_assc_2"; ?>&assc_pkey_2=<?php echo "$assc_pkey_2"; } if ($num_results_main_cat == 0) { ?>&main_cat_approvals=No<?php } ?>','showApprovals','')">Refresh <?php echo "$category"; ?></a> || <a href="javascript:requestInfo('showApprovals.php?mode=list','showApprovals','')">Refresh Categories</a></td>
				</tr>
				<tr>
					<td width="15%"><b>Date</b></td>
					<td width="20%"><b>Username</b></td>
					<td width="10%"><b>ID</b></td>
					<td width="48%"><b><?php echo "$column_name"; ?></b></td> 
					<td width="7%">&nbsp;</td>
				</tr>
				<?php for ($i=0; $i < $num_results_main_cat; $i++)
				{ 
					$curr_id= mysql_result($result_main_cat,$i,"$column"."_id");
					if ($curr_id != $curr_id_updating)
					{
						$curr_name= mysql_result($result_main_cat,$i,"$column"."_name");
						$account_num= mysql_result($result_main_cat,$i,"account_num");
						$proposed_date= mysql_result($result_main_cat,$i,"proposed_date");
						
						require_once ("includes/function_convert_db_date.php");
						$d = new date_functions;
						$converted_date = $d->convert_db_date($proposed_date);
						
						$query_username = "SELECT username FROM p2erls_accounts WHERE account_num='$account_num'";
						$result_username = mysql_query($query_username);
						$acct_username= mysql_result($result_username,0,"username");
						
						$query_curr_name = "SELECT ".$column."_name FROM p2erls_".$cat_id." WHERE ".$column."_id='$curr_id' AND pending_change = 'No'";
						$result_curr_name = mysql_query($query_curr_name);
						$curr_display_name= mysql_result($result_curr_name,0,"$column"."_name");					
					?>
				<tr bgcolor="#ffffff">
					<td><?php echo "$converted_date"; ?></td>
					<td><a href="accounts.php?mode=update&account_num=<?php echo "$account_num"; ?>"><?php echo "$acct_username"; ?></a></td>
					<td><?php echo "$curr_id"; ?></td>
					<td><?php echo "$curr_display_name"; ?></td> 
					<td><a href="javascript:requestInfo('showApprovals.php?mode=update&cat_id=<?php echo "$cat_id"; ?>&curr_id=<?php echo "$curr_id"; ?>&pkey=<?php echo "$pkey"; if ($cat_id_assc != '') { ?>&cat_id_assc=<?php echo "$cat_id_assc"; ?>&assc_pkey=<?php echo "$assc_pkey"; } if ($cat_id_assc_2 != '') { ?>&cat_id_assc_2=<?php echo "$cat_id_assc_2"; ?>&assc_pkey_2=<?php echo "$assc_pkey_2"; } ?>','showApprovals','')">Update</a></td>
				</tr>
				<?php } } } ?>
			</table>
		<?php
		}
		
		if ($mode == "view")
		{
			$cat_id=$_GET["cat_id"]; //gradients			
			$cat = str_replace("_", " ", $cat_id);
			
			/*************************************************
			**		SPECIAL CIRCUMSTANCE ALERT (SCA)		**
			*************************************************/
			
			if ($cat == 'continents oceans') { $category = 'Continents / Oceans'; } else if ($cat == 'landowner bounds') { $category = 'Landowner Bounds'; } else { $category = ucwords($cat); }
			
			/*************************************************
			**					END SCA						**
			*************************************************/
			
			$pkey=$_GET["pkey"]; //gradient_id
			$col = explode("_", $pkey);
			$column = $col[0]; //gradient
			$column_name = ucwords($col[0]);
			
			$cat_id_assc=$_GET["cat_id_assc"]; //site_landowner
			$assc_pkey=$_GET["assc_pkey"]; //landowner_id
			
			$cat_id_assc_2=$_GET["cat_id_assc_2"];
			$assc_pkey_2=$_GET["assc_pkey_2"];
			
			$query_main_cat = "SELECT * FROM p2erls_".$cat_id." WHERE pending_change = 'Yes' ORDER BY $pkey";
			$result_main_cat = mysql_query($query_main_cat);
			$num_results_main_cat = mysql_num_rows($result_main_cat);
			//echo "num_results_main_cat = $num_results_main_cat<br>";
			
			$results_to_search = $result_main_cat;
			$num_results_to_search = $num_results_main_cat;
			
			if ($num_results_main_cat == 0)
			{
				if ($cat_id_assc != '' || $cat_id_assc_2 != '')
				{
					if ($cat_id_assc != '')
					{
						$query_cat_assc_1 = "SELECT * FROM p2erls_".$cat_id_assc." WHERE pending_change = 'Yes' GROUP BY $pkey";
						$result_cat_assc_1 = mysql_query($query_cat_assc_1);
						$num_results_cat_assc_1 = mysql_num_rows($result_cat_assc_1);
						//echo "num_results_cat_assc_1 = $num_results_cat_assc_1<br>";
						
						$results_to_search = $result_cat_assc_1;
						$num_results_to_search = $num_results_cat_assc_1;
					}
					
					if ($cat_id_assc_2 != '')
					{
						$query_cat_assc_2 = "SELECT * FROM p2erls_".$cat_id_assc_2." WHERE pending_change = 'Yes' GROUP BY $pkey";
						$result_cat_assc_2 = mysql_query($query_cat_assc_2);
						$num_results_cat_assc_2 = mysql_num_rows($result_cat_assc_2);
						//echo "num_results_cat_assc_2 = $num_results_cat_assc_2<br>";
						
						$results_to_search = $result_cat_assc_2;
						$num_results_to_search = $num_results_cat_assc_2;
					}
				}
			}
		?>	
			<h3 align="center">View <?php echo "$category"; ?> Approvals</h3>			
			<table width="100%">
				<tr>
					<?php if ($num_results_main_cat != 0) { ?><td width="15%"><b>Date</b></td><?php } ?>
					<?php if ($num_results_main_cat != 0) { ?><td width="20%"><b>Username</b></td><?php } ?>
					<td width="10%"><b>ID</b></td>
					<?php if ($cat != 'landowner bounds') { ?><td width="<?php if ($num_results_main_cat != 0) { ?>48%<?php } if ($num_results_main_cat == 0) { echo '83%'; } ?>"><b><?php if ($cat != 'continents oceans') { echo "$column_name"; } else { echo "Continent / Ocean"; } ?></b></td><?php } ?>
					<td width="7%">&nbsp;</td>
				</tr>
				<?php for ($i=0; $i < $num_results_to_search; $i++)
				{ 
					$curr_id= mysql_result($results_to_search,$i,"$column"."_id");
					//$curr_name= mysql_result($result_main_cat,$i,"$column"."_name");
					$account_num= mysql_result($results_to_search,$i,"account_num");
					$proposed_date= mysql_result($results_to_search,$i,"proposed_date");
					
					require_once ("includes/function_convert_db_date.php");
					$d = new date_functions;
					$converted_date = $d->convert_db_date($proposed_date);
					
					$query_username = "SELECT username FROM p2erls_accounts WHERE account_num='$account_num'";
					$result_username = mysql_query($query_username);
					$acct_username=@mysql_result($result_username,0,"username");
					
					if ($cat != 'landowner bounds')
					{
						$query_curr_id_status_check = "SELECT * FROM p2erls_".$cat_id." WHERE pending_change = 'No' AND ".$column."_id='$curr_id'";
						$result_curr_id_status_check = mysql_query($query_curr_id_status_check);
						$num_results_curr_id_status_check = mysql_num_rows($result_curr_id_status_check);
						//echo "query_curr_id_status_check = $query_curr_id_status_check<br>";
						//echo "num_results_curr_id_status_check = $num_results_curr_id_status_check<br>";
						
						if ($num_results_curr_id_status_check == 0) { $curr_id_status = 'New'; } else { $curr_id_status = 'Existing'; }
						
						if ($curr_id_status == 'New')
						{
							$query_curr_name = "SELECT ".$column."_name FROM p2erls_".$cat_id." WHERE ".$column."_id='$curr_id' AND pending_change = 'Yes'";
						}
						if ($curr_id_status == 'Existing')
						{
							$query_curr_name = "SELECT ".$column."_name FROM p2erls_".$cat_id." WHERE ".$column."_id='$curr_id' AND pending_change = 'No'";
						}
						
						$result_curr_name = mysql_query($query_curr_name);
						$num_results_curr_name = mysql_num_rows($result_curr_name);
						//echo "num_results_curr_name =$num_results_curr_name<br>";
						
						$curr_display_name= mysql_result($result_curr_name,0,"$column"."_name");						
					}
					
					//echo "num_results_main_cat = $num_results_main_cat<br>";
					//echo "num_results_cat_assc_1 = $num_results_cat_assc_1<br>";
					//echo "num_results_cat_assc_2 = $num_results_cat_assc_2<br>";
					
					if (($num_results_cat_assc_1 != 0 || $num_results_cat_assc_1 != '') && ($num_results_cat_assc_2 != 0 || $num_results_cat_assc_2 != '')) { $mode_to_send = 'update'; }
					if (($num_results_cat_assc_1 == 0 || $num_results_cat_assc_1 == '') && ($num_results_cat_assc_2 != 0 || $num_results_cat_assc_2 != '')) { $mode_to_send = 'update_assc'; }
					if (($num_results_cat_assc_1 != 0 || $num_results_cat_assc_1 != '') && ($num_results_cat_assc_2 == 0 || $num_results_cat_assc_2 == '')) { $mode_to_send = 'update_assc'; }
					if ($num_results_main_cat != 0 || (($num_results_cat_assc_1 != 0 || $num_results_cat_assc_1 != '') && ($num_results_cat_assc_2 != 0 || $num_results_cat_assc_2 != ''))) { $mode_to_send = 'update'; }					
				?>
				<tr bgcolor="#ffffff">
					<?php if ($num_results_main_cat != 0) { ?><td><?php echo "$converted_date"; ?></td><?php } ?>
					<?php if ($num_results_main_cat != 0) { ?><td><a href="accounts.php?mode=update&account_num=<?php echo "$account_num"; ?>"><?php echo "$acct_username"; ?></a></td><?php } ?>
					<td><?php echo "$curr_id"; ?></td>
					<?php if ($cat != 'landowner bounds') { ?><td><?php echo "$curr_display_name"; ?></td><?php } ?>
					<td><a href="javascript:requestInfo('showApprovals.php?mode=<?php echo "$mode_to_send"; ?>&acct=<?php echo "$account_num"; ?>&cat_id=<?php echo "$cat_id"; ?>&curr_id=<?php echo "$curr_id"; ?>&pkey=<?php echo "$pkey"; if ($cat_id_assc != '') { ?>&cat_id_assc=<?php echo "$cat_id_assc"; ?>&assc_pkey=<?php echo "$assc_pkey"; } if ($cat_id_assc_2 != '') { ?>&cat_id_assc_2=<?php echo "$cat_id_assc_2"; ?>&assc_pkey_2=<?php echo "$assc_pkey_2"; } if ($num_results_main_cat == 0) { ?>&main_cat_approvals=No<?php } ?>','showApprovals','')">Update</a></td>
				</tr>
				<?php } ?>
			</table>
		<?php } ?>
		</td>
	</tr>
	<?php
	// For Update save Option
	if ($mode == "update_data")
	{ ?>			
	<tr>
		<td colspan="5"><div id="confirmUpdate">Data Updated</div>
	</tr>			
	<?php }
	if ($mode == 'list' || $mode == 'view' || $mode == 'update_data')
	{ ?>
	<tr>
		<td bgcolor="#FFFFFF"><a href="javascript:requestInfo('showApprovals.php?mode=list','showApprovals','')">Refresh Categories</a></td>
	</tr>
	<tr>
		<td valign="top"><table width="100%">
			<tr>
				<td width="90%"><b>Category Name</b></td> 
				<td width="10%">&nbsp;</td>
			</tr>
			<?php
			// Query all the main categories
			$query_continents_oceans = "SELECT * FROM p2erls_continents_oceans WHERE pending_change = 'Yes' ORDER BY co_id";
			$result_continents_oceans = mysql_query($query_continents_oceans);
			$num_results_continents_oceans = mysql_num_rows($result_continents_oceans);
			
			$query_countries = "SELECT * FROM p2erls_countries WHERE pending_change = 'Yes' ORDER BY country_id";
			$result_countries = mysql_query($query_countries);
			$num_results_countries = mysql_num_rows($result_countries);
			
			$query_ecosystems = "SELECT * FROM p2erls_ecosystems WHERE pending_change = 'Yes' ORDER BY ecosystem_id";
			$result_ecosystems = mysql_query($query_ecosystems);
			$num_results_ecosystems = mysql_num_rows($result_ecosystems);
			
			$query_gradients = "SELECT * FROM p2erls_gradients WHERE pending_change = 'Yes' ORDER BY gradient_id";
			$result_gradients = mysql_query($query_gradients);
			$num_results_gradients = mysql_num_rows($result_gradients);
			
			$query_landowner_bounds = "SELECT * FROM p2erls_landowner_bounds WHERE pending_change = 'Yes' ORDER BY lb_id";
			$result_landowner_bounds = mysql_query($query_landowner_bounds);
			$num_results_landowner_bounds = mysql_num_rows($result_landowner_bounds);
			
			$query_landowners = "SELECT * FROM p2erls_landowners WHERE pending_change = 'Yes' ORDER BY landowner_id";
			$result_landowners = mysql_query($query_landowners);
			$num_results_landowners = mysql_num_rows($result_landowners);
			
			$query_networks = "SELECT * FROM p2erls_networks WHERE pending_change = 'Yes' ORDER BY network_id";
			$result_networks = mysql_query($query_networks);
			$num_results_networks = mysql_num_rows($result_networks);
			
			$query_programs = "SELECT * FROM p2erls_programs WHERE pending_change = 'Yes' ORDER BY program_id";
			$result_programs = mysql_query($query_programs);
			$num_results_programs = mysql_num_rows($result_programs);
			
			$query_regions = "SELECT * FROM p2erls_regions WHERE pending_change = 'Yes' ORDER BY region_id";
			$result_regions = mysql_query($query_regions);
			$num_results_regions = mysql_num_rows($result_regions);
			
			$query_sites = "SELECT * FROM p2erls_sites WHERE pending_change = 'Yes' ORDER BY site_id";
			$result_sites = mysql_query($query_sites);
			$num_results_sites = mysql_num_rows($result_sites);
			
			$query_states = "SELECT * FROM p2erls_states WHERE pending_change = 'Yes' ORDER BY state_id";
			$result_states = mysql_query($query_states);
			$num_results_states = mysql_num_rows($result_states);
			
			// Query all the main category associations	
			$query_gradient_region = "SELECT * FROM p2erls_gradient_region WHERE pending_change = 'Yes' ORDER BY region_id";
			$result_gradient_region = mysql_query($query_gradient_region);
			$num_results_gradient_region = mysql_num_rows($result_gradient_region);
						
			$query_network_sites = "SELECT * FROM p2erls_network_sites WHERE pending_change = 'Yes' ORDER BY site_id";
			$result_network_sites = mysql_query($query_network_sites);
			$num_results_network_sites = mysql_num_rows($result_network_sites);
			
			$query_program_networks = "SELECT * FROM p2erls_program_networks WHERE pending_change = 'Yes' ORDER BY network_id";
			$result_program_networks = mysql_query($query_program_networks);
			$num_results_program_networks = mysql_num_rows($result_program_networks);
			
			$query_program_sites = "SELECT * FROM p2erls_program_sites WHERE pending_change = 'Yes' ORDER BY site_id";
			$result_program_sites = mysql_query($query_program_sites);
			$num_results_program_sites = mysql_num_rows($result_program_sites);
			
			$query_region_co = "SELECT * FROM p2erls_region_co WHERE pending_change = 'Yes' ORDER BY co_id";
			$result_region_co = mysql_query($query_region_co);
			$num_results_region_co = mysql_num_rows($result_region_co);
			
			$query_site_landowner = "SELECT * FROM p2erls_site_landowner WHERE pending_change = 'Yes' ORDER BY landowner_id";
			$result_site_landowner = mysql_query($query_site_landowner);
			$num_results_site_landowner = mysql_num_rows($result_site_landowner);
			
			$query_site_gradient = "SELECT * FROM p2erls_site_gradient WHERE pending_change = 'Yes' ORDER BY gradient_id";
			$result_site_gradient = mysql_query($query_site_gradient);
			$num_results_site_gradient = mysql_num_rows($result_site_gradient);
			echo "num_results_site_gradient = $num_results_site_gradient<br>";
			
			// if Mode is Update, get the ID of the category being updated so that it is not included in the main list while updating
			if($mode=="view") {
				$cat_id_updating=$_GET["cat_id"];				
			}
			else {
				$cat_id_updating='';
			}
			 
			if ($num_results_continents_oceans != 0 && $cat_id_updating != 'continents_oceans') { ?>
			<tr bgcolor="#ffffff">
				<td>Continents / Oceans</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=continents_oceans&pkey=co_id','showApprovals','')">View</a></td>
			</tr>
			<?php } if ($num_results_countries != 0 && $cat_id_updating != 'countries') { ?>
			<tr bgcolor="#ffffff">
				<td>Countries</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=countries&pkey=country_id','showApprovals','')">View</a></td>
			</tr>
			<?php } if ($num_results_ecosystems != 0 && $cat_id_updating != 'ecosystems') { ?>
			<tr bgcolor="#ffffff">
				<td>Ecosystems</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=ecosystems&pkey=ecosystem_id','showApprovals','')">View</a></td>
			</tr>
			<?php } if (($num_results_gradients != 0 || $num_results_gradient_region != 0) && $cat_id_updating != 'gradients') { ?>
			<tr bgcolor="#ffffff">
				<td>Gradients</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=gradients&pkey=gradient_id<?php if ($num_results_gradient_region != 0) { ?>&cat_id_assc=gradient_region&assc_pkey=region_id<?php } ?>','showApprovals','')">View</a></td>
			</tr>
			<?php } if ($num_results_landowner_bounds != 0 && $cat_id_updating != 'landowner_bounds') { ?>
			<tr bgcolor="#ffffff">
				<td>Landowner Bounds</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=landowner_bounds&pkey=lb_id','showApprovals','')">View</a></td>
			</tr>
			<?php } if ($num_results_landowners != 0 && $cat_id_updating != 'landowners') { ?>
			<tr bgcolor="#ffffff">
				<td>Landowners</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=landowners&pkey=landowner_id','showApprovals','')">View</a></td>
			</tr>
			<?php } if (($num_results_networks != 0 || $num_results_network_sites != 0) && $cat_id_updating != 'networks') { ?>
			<tr bgcolor="#ffffff">
				<td>Networks</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=networks&pkey=network_id<?php if ($num_results_network_sites != 0) { ?>&cat_id_assc=network_sites&assc_pkey=site_id<?php } ?>','showApprovals','')">View</a></td>
			</tr>
			<?php } if (($num_results_programs != 0 || $num_results_program_networks != 0 || $num_results_program_sites != 0) && $cat_id_updating != 'programs') { ?>
			<tr bgcolor="#ffffff">
				<td>Programs</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=programs&pkey=program_id<?php if ($num_results_program_networks != 0) { ?>&cat_id_assc=program_networks&assc_pkey=network_id<?php } if ($num_results_program_sites != 0) { ?>&cat_id_assc_2=program_sites&assc_pkey_2=site_id<?php } ?>','showApprovals','')">View</a></td>
			</tr>
			<?php } if (($num_results_regions != 0 || $num_results_region_co != 0) && $cat_id_updating != 'regions') { ?>
			<tr bgcolor="#ffffff">
				<td>Regions</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=regions&pkey=region_id<?php if ($num_results_region_co != 0) { ?>&cat_id_assc=region_co&assc_pkey=co_id<?php } ?>','showApprovals','')">View</a></td>
			</tr>
			<?php } if (($num_results_sites != 0 || $num_results_site_landowner != 0 || $num_results_site_gradient != 0) && $cat_id_updating != 'sites') { ?>
			<tr bgcolor="#ffffff">
				<td>Sites</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=sites&pkey=site_id<?php if ($num_results_site_landowner != 0) { ?>&cat_id_assc=site_landowner&assc_pkey=landowner_id<?php } if ($num_results_site_gradient != 0) { ?>&cat_id_assc_2=site_gradient&assc_pkey_2=gradient_id<?php } ?>','showApprovals','')">View</a></td>
			</tr>
			<?php } if ($num_results_states != 0 && $cat_id_updating != 'states') { ?>
			<tr bgcolor="#ffffff">
				<td>States</td> 
				<td><a href="javascript:requestInfo('showApprovals.php?mode=view&cat_id=states&pkey=state_id','showApprovals','')">View</a></td>
			</tr>
			<?php } ?>
		</table></td>
	</tr>
	<?php } ?>
</table>