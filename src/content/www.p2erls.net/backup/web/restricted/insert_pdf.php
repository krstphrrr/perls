<?php
// require json class
require("includes/pdf/class_json.php");
$JSON = new Services_JSON(); 

// Connect to DB
require ("Security_Dept/config.php");
@ $db = mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error()); mysql_select_db($db_name);


/////////
// Retrieve all values posted by ajax script
////////

//sonoma_photos relevant values
$site_flyer				= $_FILES["userfile0"]["name"];
$site_id				= $_POST["site_id"];
$site_flyer_old			= $_POST["site_flyer_old"];
$delete_flyer			= $_POST["userfile0_delete"];
echo "convert '../flyers/$site_id/$site_flyer'[0] -colorspace RGB -geometry 200 '../flyers/$site_id/preview.jpeg'";


	// Insert information into table
	
	if($site_flyer != '')
		{
		$query_update="UPDATE p2erls_sites SET
				site_flyer='".$site_flyer."'
				WHERE site_id='".$site_id."'";
	mysql_query($query_update);
	echo"$query_update";
		}
	
	if($delete_flyer == "Yes")
		{ $query_no_flyer="UPDATE p2erls_sites SET
				site_flyer=''
				WHERE site_id='".$site_id."'";
				mysql_query($query_no_flyer);
		}

// Call file upload functions
include ("includes/function_delete_failed_upload_entry.php");
include ("includes/function_file_upload.php");

// Create main directory
mkdir("../flyers/$site_id/", 0755);

// Delete old flyer if it exists
if($site_flyer != $site_flyer_old)
	{
	unlink("../flyers/$site_id/$site_flyer_old");
	}

// Directory being uploaded to
$upload_dir = "../flyers/$site_id/";

// Create dynamic directory for files
mkdir($upload_dir, 0755);

// Number and field names of files being uploaded
$num_files = 1;
$upload_fields = array('site_flyer');
	
// Delete failed function variables
$table_name = 'p2erls_sites';
$pkey 		= 'site_id';
$pkey_value = $site_id;

// Allowable file Mime Types. Add more mime types if you want
$file_mimes = array('image/jpeg','image/jpg','image/gif', 'application/pdf');

// Allowable file ext. names. you may add more extension names.            
$file_exts  = array('.jpg','.JPG','.gif','.GIF','.PDF','.pdf'); 

// Loop through files
for ($k=0; $k < $num_files; $k++)
{
	$e = "userfile".$k; 
	$p[]=$_FILES["$e"]["name"];	

	// If photo is not blank
	if ($p[$k] != '')
	{
		// Define file size variables		
		$maxsize = 10000000;
		$m_size = $maxsize / 1000000;
		$max_size = round($m_size, 2);		
		
		// Create Upload Directory
		if (!is_dir($upload_dir))
		{
			if (!mkdir($upload_dir))
			{
				delete_failed_upload_entry($table_name, $pkey, $pkey_value, $upload_fields[$k]);
				die ("Sorry, the directory ($upload_dir) doesn't exist and creation failed.");
			}
			if (!chmod($upload_dir,0755))
			{
				delete_failed_upload_entry($table_name, $pkey, $pkey_value, $upload_fields[$k]);
				die ("Sorry, the attempt to change directory permissions to 755 failed.");
			}
		}
		
		// Process User's Request
		if ($_FILES["$e"])
		{
			$file_type = $_FILES["$e"]['type']; 
			$file_name = $_FILES["$e"]['name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			// File Type/Extension Check
			if (!in_array($file_type, $file_mimes) && !in_array($file_ext, $file_exts))
			{
				delete_failed_upload_entry($table_name, $pkey, $pkey_value, $upload_fields[$k]);
				$message = "Sorry, the file type ($file_type) is not allowed to be uploaded.";
				echo "$message <br />";
			}
			
			// File Size Check
			else if ($_FILES["$e"]["size"] > $maxsize)
			{
				$filesize = $_FILES["$e"]["size"];
				$f_size = $filesize / 1000000;
				$file_size = round($f_size, 2);
				
				delete_failed_upload_entry($table_name, $pkey, $pkey_value, $upload_fields[$k]);
				$message = "The file size of $file_size MB is too large. It must be less than $max_size MB.";
				echo "$message <br />";
			}
			
			// upload file if it is OK
			else
			{
				// Call upload function and return file path
				$message = do_file_upload($upload_dir, $e);
				
				// Check if file path is not blank
				if ($message != '')
				{
					echo "$file_name uploaded successfully.<br />";
				}
				else
				{
					delete_failed_upload_entry($table_name, $pkey, $pkey_value, $upload_fields[$k]);
					echo "Sorry, an error occurred while trying to upload $file_name.";
				}
			}
		} // End process user's request
	} // End if photo is not blank
} // End loop through files






// Make users think something is happening
sleep(2);


//echo "convert '../flyers/$site_id/$site_flyer'[0] -colorspace RGB -geometry 200 '../flyers/$site_id/preview.jpeg'";
exec("convert '../flyers/$site_id/$site_flyer'[0] -colorspace RGB -geometry 200 '../flyers/$site_id/$site_flyer.jpg'"); 

//Make Array to encode into javascript object
 
$leet = array(
	'details' => $_FILES["userfile0"],
	'status' => "success"
);

// 
$result = $JSON->encode($leet); 

// IFRAME IO Goes into txtarea
?><textarea><?php
echo "$result"; 
?></textarea>




