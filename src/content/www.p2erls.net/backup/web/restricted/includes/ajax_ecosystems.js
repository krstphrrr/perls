function init_table()
{
	requestInfo('showEcosystems.php?mode=list','showEcosystems','');
}

function save_data(table_name,pkey)
{
	var check;
	var ecosystem_id=document.getElementById("ecosystem_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+ecosystem_id;
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
				var ecosystem_name=document.getElementById("ecosystem_name").value;
				var ecosystem_description=document.getElementById("ecosystem_description").value;
				var checkValidation=emptyValidation('ecosystem_id~ecosystem_name');
				
				if(checkValidation == true)
				{
					requestInfo('showEcosystems.php?mode=save_new&ecosystem_id='+ecosystem_id+'&ecosystem_name='+ecosystem_name+'&ecosystem_description='+ecosystem_description,'showEcosystems','');
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
	var prev_ecosystem_id=document.getElementById("prev_ecosystem_id").value;
	var ecosystem_id=document.getElementById("ecosystem_id").value;
	
	if (prev_ecosystem_id != ecosystem_id && access_level != 1)
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
	url=url+"&pkey_value="+ecosystem_id;
	url=url+"&pkey_value_prev="+prev_ecosystem_id;
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
				var ecosystem_name=document.getElementById("ecosystem_name").value;
				var ecosystem_description=document.getElementById("ecosystem_description").value; 
				var checkValidation=emptyValidation('ecosystem_id~ecosystem_name');
				
				if (checkValidation == true)
				{
					requestInfo('showEcosystems.php?mode=update_data&ecosystem_id='+ecosystem_id+'&ecosystem_name='+ecosystem_name+'&ecosystem_description='+ecosystem_description+'&prev_ecosystem_id='+prev_ecosystem_id,'showEcosystems','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}