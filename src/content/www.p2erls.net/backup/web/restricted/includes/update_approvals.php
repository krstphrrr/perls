<?php
include("../Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);

$table_name=$_GET["table_name"];
$pkey=$_GET["pkey"];
$pkey_value=$_GET["pkey_value"];
$assc_pkey=$_GET["assc_pkey"];
$approval_fields_count=$_GET["approval_fields_count"];
$approval_field=$_GET["approval_field"];
$previous=$_GET["previous"];
$proposed=$_GET["proposed"];
$action=$_GET["action"];

$last_updated = date("Y-m-d H:i:s");

if ($assc_pkey == '')
{
	$query_total_pkey_approvals_count = "SELECT * FROM $table_name WHERE $pkey='$pkey_value'";
	$result_total_pkey_approvals_count = mysql_query($query_total_pkey_approvals_count);
	$num_results_total_pkey_approvals_count = mysql_num_rows($result_total_pkey_approvals_count);
	
	if ($num_results_total_pkey_approvals_count > 1) { $approval_field_status = 'Existing'; } else { $approval_field_status = 'New'; } //pkey_status
}
else
{
	$query_total_assc_pkey_approvals_count = "SELECT * FROM $table_name WHERE $pkey='$pkey_value' AND $assc_pkey='$approval_field'";
	$result_total_assc_pkey_approvals_count = mysql_query($query_total_assc_pkey_approvals_count);
	$num_results_total_assc_pkey_approvals_count = mysql_num_rows($result_total_assc_pkey_approvals_count);
	
	if ($num_results_total_assc_pkey_approvals_count > 1) { $assc_approval_field_status = 'Existing'; } else { $assc_approval_field_status = 'New'; } //assc_pkey_status
}

//echo "pkey = $pkey<br>";
//echo "pkey_value = $pkey_value<br>";
//echo "action = $action<br>";
//echo "approval_field = $approval_field<br>";
//echo "approval_field_status = $approval_field_status<br>";
//echo "approval_fields_count = $approval_fields_count<br>";

// If parameter is approved, update the current DB table row to reflect the its proposed value
if ($action == 'Approve')
{
	if ($assc_pkey == '')
	{		
		if ($approval_field_status == 'Existing')
		{
			$query_update_approval_approve_existing = "UPDATE $table_name SET
			$approval_field='".$proposed."',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND pending_change='No'";
			mysql_query($query_update_approval_approve_existing);
			//echo "query_update_approval_approve_existing = $query_update_approval_approve_existing<br>";
		}
		if ($approval_field_status == 'New')
		{
			$query_update_approval_approve_new = "UPDATE $table_name SET
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND pending_change='Yes'";
			mysql_query($query_update_approval_approve_new);
			//echo "query_update_approval_approve_new = $query_update_approval_approve_new<br>";
			/*
			if ($approval_fields_count == 0)
			{
				$query_no_more_new_approvals = "UPDATE $table_name SET pending_change='No' WHERE $pkey='$pkey_value' AND pending_change='Yes'";
				//mysql_query($query_no_more_new_approvals);
				echo "query_no_more_new_approvals = $query_no_more_new_approvals<br>";
			}
			*/
		}

		if ($approval_fields_count == 0)
		{
			$query_no_more_pkey_approvals = "DELETE FROM $table_name WHERE pending_change='Yes' AND $pkey='$pkey_value'";
			mysql_query($query_no_more_pkey_approvals);
			//echo "query_no_more_pkey_approvals = $query_no_more_pkey_approvals<br>";
		}
	}
	else
	{
		if ($proposed == 'Add')
		{
			$query_approve_add = "UPDATE $table_name SET
			delete_assc='',
			pending_change='No',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND $assc_pkey='$approval_field'";
			mysql_query($query_approve_add);
			//echo "query_approve_add = $query_approve_add<br>";			
		}
		if ($proposed == 'Remove')
		{
			$query_approve_remove = "DELETE FROM $table_name WHERE pending_change='Yes' AND $pkey='$pkey_value' AND $assc_pkey='$approval_field'";
			mysql_query($query_approve_remove);
			//echo "query_approve_remove = $query_approve_remove<br>";
		}
	}
}
// End If

// If parameter is denied, change the proposed DB row to reflect the its current value
if ($action == 'Deny')
{
	if ($assc_pkey == '')
	{
		if ($approval_field_status == 'Existing')
		{
			$query_update_approval_deny_existing = "UPDATE $table_name SET
			$approval_field='".$previous."',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND pending_change='Yes'";
			mysql_query($query_update_approval_deny_existing);
			//echo "query_update_approval_deny_existing = $query_update_approval_deny_existing<br>";
		}
		
		//START HERE ON THIS FILE! NEED TO FIGURE OUT WHY THE FOLLOWING IS GETTING IGNORED!
		if ($approval_field_status == 'New')
		{
			$query_update_approval_deny_new = "UPDATE $table_name SET
			$approval_field='',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND pending_change='Yes'";
			mysql_query($query_update_approval_deny_new);
			//echo "query_update_approval_deny_new = $query_update_approval_deny_new<br>";
			/*
			if ($approval_fields_count == 0)
			{
				$query_no_more_new_approvals = "UPDATE $table_name SET pending_change='No' WHERE $pkey='$pkey_value' AND pending_change='Yes'";
				//mysql_query($query_no_more_new_approvals);
				echo "query_no_more_new_approvals = $query_no_more_new_approvals<br>";
			}
			*/
		}
		
		if ($approval_fields_count == 0)
		{
			$query_no_more_pkey_approvals = "DELETE FROM $table_name WHERE pending_change='Yes' AND $pkey='$pkey_value'";
			mysql_query($query_no_more_pkey_approvals);
			//echo "query_no_more_pkey_approvals = $query_no_more_pkey_approvals<br>";
		}
	}
	else
	{
		if ($proposed == 'Add')
		{
			$query_deny_add = "DELETE FROM $table_name WHERE delete_assc!='Yes' AND pending_change='Yes' AND $pkey='$pkey_value' AND $assc_pkey='$approval_field'";
			mysql_query($query_deny_add);
			//echo "query_deny_add = $query_deny_add<br>";
						
			/*
			$query_add_proposed = "UPDATE $table_name SET
			pending_change='No',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND $assc_pkey='$parameter'";
			mysql_query($query_add_proposed);
			*/
		}
		if ($proposed == 'Remove')
		{
			$query_deny_remove = "DELETE FROM $table_name WHERE delete_assc='Yes' AND pending_change='Yes' AND $pkey='$pkey_value' AND $assc_pkey='$approval_field'";
			mysql_query($query_deny_remove);
			//echo "query_deny_remove = $query_deny_remove<br>";
			
			/*
			$query_deny_remove = "UPDATE $table_name SET
			pending_change='No',
			last_updated='".$last_updated."'
			WHERE $pkey='$pkey_value' AND $assc_pkey='$parameter'";
			mysql_query($query_deny_remove);
			*/
		}
	}
}
// End If

/*
// Check to see if there are any more fields up for approval and, if not, delete the pending row
$same_fields = 0;

if ($assc_pkey == '')
{
	$result_fields = mysql_query("SELECT * FROM $table_name WHERE $pkey='$pkey_value'");
	$num_results_fields = mysql_num_fields($result_fields);
	
	for ($i=0; $i < $num_results_fields; $i++)
	{
		$db_field = mysql_field_name($result_fields, $i);
		
		if ($db_field != 'pending_change' && $db_field != 'account_num' && $db_field != 'proposed_date' && $db_field != 'last_updated')
		{
			if ($approval_field_status == 'Existing')
			{
				$query_previous = "SELECT $db_field FROM $table_name WHERE pending_change='No' AND $pkey='$pkey_value'";
				$result_previous = mysql_query($query_previous);
				$num_results_previous = mysql_num_rows($result_previous);
				
				if ($num_results_previous != 0) { $field_value_previous = mysql_result($result_previous,0,"$db_field"); }
				//echo "query_previous = $query_previous<br>";
				//echo "field_value_previous = $field_value_previous<br>";
			}
			
			$query_proposed = "SELECT $db_field FROM $table_name WHERE pending_change='Yes' AND $pkey='$pkey_value'";
			$result_proposed = mysql_query($query_proposed);
			$num_results_proposed = mysql_num_rows($result_proposed);

			if ($num_results_proposed != 0) { $field_value_proposed = mysql_result($result_proposed,0,"$db_field"); }
			
			if ($field_value_previous != $field_value_proposed)
			{
				$same_fields++;
			}
		}
	}
	
	if ($same_fields == 0)
	{
		$query_delete_approval = "DELETE FROM $table_name WHERE $pkey='$pkey_value' AND pending_change='Yes'";
		//mysql_query($query_delete_approval);
		echo "query_delete_approval = $query_delete_approval<br>";
	}
}
else
{
	$result_fields = mysql_query("SELECT * FROM $table_name WHERE $pkey='$pkey_value' AND pending_change='Yes'");
	$num_results_fields = mysql_num_fields($result_fields);
	
	if ($num_results_fields != 0)
	{
		$same_fields++;
	}
}
// End Check
*/

//echo "$same_fields";
//echo "<br><br>";	
//echo "$query_update_approval";
?>