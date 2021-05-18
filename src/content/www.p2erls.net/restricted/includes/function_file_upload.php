<?php
function do_file_upload($upload_dir, $e)
{
	$temp_name = $_FILES["$e"]["tmp_name"];
	$file_name = $_FILES["$e"]["name"]; 
  	$file_name = str_replace("\\","",$file_name);
	$file_name = str_replace("'","",$file_name);
	$file_path = $upload_dir.$file_name;
  	
	if ($file_name == "")
	{ 
  		$message = "Invalid File Name Specified";
  		return $message;
	}
	$result = move_uploaded_file($temp_name, $file_path);  	
	if (!chmod($file_path,0777))
	{
   		$message = "change permission to 777 failed.";
  	}
	else
	{
		if ($result == 1) { $message = "$file_path"; }  
		if ($result == 0) {	$message = ''; }
	}
	return $message;
}

function do_photo_upload($upload_dir, $e)
{
	$temp_name = $_FILES["$e"]["tmp_name"];
	$file_name = $_FILES["$e"]["name"]; 
  	$file_name = str_replace("\\","",$file_name);
	$file_name = str_replace("'","",$file_name);
	$file_path = $upload_dir.$file_name;
  	
	if ($file_name == "") { 
  		$message = "Invalid File Name Specified";
  		return $message;
	}
	
	// Get the current info on the file
	$current_size = getimagesize($file_path);
	$current_img_width = $current_size[0];
	$current_img_height = $current_size[1];
	
	// Specify your file details
	if ($current_img_width > $current_img_height) {
		$max_width = '1800';
	} else {
		$max_width = '1200';
	}
	
	// Determine if the image actually needs to be resized
	if ($current_img_width > $max_width) {
		$too_big_diff_ratio = $current_img_width/$max_width;
    	$new_img_width = $max_width;
    	//$new_img_height = round($current_img_height/$too_big_diff_ratio);
		if ($max_width == '1800') { $new_img_height = '1200'; } else { $new_img_height = '1800'; }

    	// Convert the file
    	$make_magick = system("convert -geometry $new_img_width x $new_img_height $file_path $file_path");
	}
	
	$result = move_uploaded_file($temp_name, $file_path);  	
	if (!chmod($file_path,0777)) {
   		$message = "change permission to 777 failed.";
  	} else {
		if ($result == 1) { $message = "$file_path"; }  
		if ($result == 0) {	$message = "Something is wrong with uploading a file.<br />"; }
	}
	return $message;
}

function file_uploader($upload_dir, $num_files, $file_mimes, $file_exts)
{
	$new_message ="";
	
	// Loop through files
	for ($k=0; $k < $num_files; $k++)
	{
		$e = "userfile".$k; 
		$p[]=$_FILES["$e"]["name"];	
	
		// If photo is not blank
		if ($p[$k] != '')
		{
			// Define variables		
			$maxsize = 10000000;
			$m_size = $maxsize / 1000000;
			$max_size = round($m_size, 2);		
			$message ="";			
			
			// Create Upload Directory
			if (!is_dir($upload_dir))
			{
				if (!mkdir($upload_dir))
				{
					die ("Sorry, the directory ($upload_dir) doesn't exist and creation failed");
				}
				if (!chmod($upload_dir,0755))
				{
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
					$message = "Sorry, the file type ($file_type) is not allowed to be uploaded.";
					echo "$message <br />";
				}
				
				// File Size Check
				else if ($_FILES["$e"]["size"] > $maxsize)
				{
					$filesize = $_FILES["$e"]["size"];
	
					$f_size = $filesize / 1000000;
					$file_size = round($f_size, 2);
					$message = "The file size of $file_size MB is too large. It must be less than $max_size MB.";
					echo "$message <br />";
				}
				
				// Call upload function if file is OK
				else
				{
					// Return $file_path as $message
					$message = do_file_upload($upload_dir, $e);
					
					// Check if file path is not blank
					if ($message != '')
					{
						echo "$file_name uploaded successfully.<br />";
					}
					else
					{
						echo "Sorry, an error occurred while trying to upload $file_name.<br />";
					}
				}
			} // End process user's request
		} // End if photo is not blank
		if ($k == 0)
		{
			$new_message = $message;
		}
		else
		{
			$new_message = $new_message.$message;
		}
	} // End loop through files
	return $new_message;
}
?>