<?php
function delete_failed_upload_entry($table_name, $pkey, $pkey_value, $field)
{
	$query_delete_failed_upload_entry = "UPDATE $table_name SET $field = '' WHERE $pkey = '$pkey_value'";
	mysql_query($query_delete_failed_upload_entry); 
}
?>