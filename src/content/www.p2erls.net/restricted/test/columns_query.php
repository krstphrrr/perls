<?php
@ $db = mysql_connect('localhost', 'digitaz4_sites', 'digital7');if (!$db){echo 'Error: Could not connect to database.  Please try again later.';exit;}mysql_select_db('digitaz4_dslcsites');
/*
$query_curr = "SHOW COLUMNS FROM p2erls_sites";
$result_curr = mysql_query($query_curr);
$num_results_curr = mysql_num_rows($result_curr);

if ($num_results_curr > 0)
{
	while ($row = mysql_fetch_assoc($result_curr)) {
        print_r($row);
    }
}
*/

$result = mysql_query("SELECT * FROM p2erls_sites");
$num_results = mysql_num_fields($result);

echo "$num_results<br>";

for ($i=0; $i < $num_results; $i++) {
	$field = mysql_field_name($result, $i);
	
	$column = str_replace("_", " ", $field);
	$column_name = ucwords($column);
	
	echo "$column<br />";
	
	//if (strpbrk($column, " id") == true) { echo "Dynamic too!<br><br>"; } else { echo "<br>"; }
	//$ans=strstr($column," id");
	if (strstr($column, " id") == true) { echo "Dynamic too!<br><br>"; } else { echo "<br>"; }
}
//echo mysql_field_name($res, 0) . "\n";
//echo mysql_field_name($res, 2);
?>