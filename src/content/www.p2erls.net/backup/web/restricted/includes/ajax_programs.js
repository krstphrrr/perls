function init_table()
{
	requestInfo('showPrograms.php?mode=list','showPrograms','');
}
				
function save_data(table_name,pkey)
{
	var check;
	var program_id=document.getElementById("program_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+program_id;
	url=url+"&sid="+Math.random();
	
	//alert (url)
	//prompt ("hey there", url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			check = xmlHttp.responseText;
			if (check == "Yes")
			{
				alert('Sorry, this ID already exists. Try using a different ID before clicking Save again.');
				return;
			}
			else
			{
				var program_name=document.getElementById("program_name").value;
				var program_url=document.getElementById("program_url").value;
				var checkValidation=emptyValidation('program_id~program_name');
				
				if(checkValidation == true)
				{
					requestInfo('showPrograms.php?mode=save_new&program_id='+program_id+'&program_name='+program_name+'&program_url='+program_url,'showPrograms','');
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
	var prev_program_id=document.getElementById("prev_program_id").value;
	var program_id=document.getElementById("program_id").value;
	
	if (prev_program_id != program_id && access_level != 1)
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
	url=url+"&pkey_value="+program_id;
	url=url+"&pkey_value_prev="+prev_program_id;
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
				var program_name=document.getElementById("program_name").value;
				var program_url=document.getElementById("program_url").value;
				var checkValidation=emptyValidation('program_id~program_name');
				
				if (checkValidation == true)
				{
					requestInfo('showPrograms.php?mode=update_data&program_id='+program_id+'&program_name='+program_name+'&program_url='+program_url+'&prev_program_id='+prev_program_id,'showPrograms','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}