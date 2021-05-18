function init_table()
{
	requestInfo('showRegions.php?mode=list','showRegions','');
}

function save_data(table_name,pkey)
{
	var check;
	var region_id=document.getElementById("region_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+region_id;
	url=url+"&sid="+Math.random();
	
	//alert (url)
	//prompt ("hey there", url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			check = xmlHttp.responseText;
			var check_array=check.split(",");
			var check_bool=check_array[0];
			var check_type=check_array[1];
			
			//alert (check_bool);
			//alert (check_type);
			
			if (check_bool == "Yes")
			{
				alert('Sorry, this ID already exists. Try using a different ID before clicking Save again.');
				return;
			}
			else
			{
				var region_name=document.getElementById("region_name").value;
				var checkValidation=emptyValidation('region_id~region_name');
				
				if(checkValidation == true)
				{
					requestInfo('showRegions.php?mode=save_new&region_id='+region_id+'&region_name='+region_name,'showRegions','');
				}
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
	
function update_data(access_level,table_name,pkey)
{
	var check;
	var prev_region_id=document.getElementById("prev_region_id").value;
	var region_id=document.getElementById("region_id").value;
	
	if (prev_region_id != region_id && access_level != 1)
	{
		alert('Sorry, you do not have permission to change the ID of this entry.');
		return;
	}
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+region_id;
	url=url+"&pkey_value_prev="+prev_region_id;
	url=url+"&sid="+Math.random();
	
	//alert (url)
	//prompt ("hey there", url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			check = xmlHttp.responseText;
			var check_array=check.split(",");
			var check_bool=check_array[0];
			var check_type=check_array[1];
			
			//alert (check_bool);
			//alert (check_type);
			
			if (check_bool == "Yes")
			{
				if (check_type == "p")
				{
					alert('Sorry, this entry already has changes pending. You will have to wait until those changes are approved/denied before you can update it.');
					return;
				}
				if (check_type == "e")
				{
					alert('Sorry, this ID already exists. Try using a different ID before clicking Save again.');
					return;
				}
			}
			else
			{
				var region_name=document.getElementById("region_name").value;
				var checkValidation=emptyValidation('region_id~region_name');
				
				if (checkValidation == true)
				{
					requestInfo('showRegions.php?mode=update_data&region_id='+region_id+'&region_name='+region_name+'&prev_region_id='+prev_region_id,'showRegions','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}