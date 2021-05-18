function init_table()
{
	requestInfo('showNetworks.php?mode=list','showNetworks','');
}

function save_data(table_name,pkey)
{
	var check;
	var network_id=document.getElementById("network_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+network_id;
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
				var network_name=document.getElementById("network_name").value;
				var network_url=document.getElementById("network_url").value;
				var network_cat=document.getElementById("network_cat").value;
				var checkValidation=emptyValidation('network_id~network_name');
				
				if(checkValidation == true)
				{
					requestInfo('showNetworks.php?mode=save_new&network_id='+network_id+'&network_name='+network_name+'&network_url='+network_url+'&network_cat='+network_cat,'showNetworks','');
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
	var prev_network_id=document.getElementById("prev_network_id").value;
	var network_id=document.getElementById("network_id").value;
	
	if (prev_network_id != network_id && access_level != 1)
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
	url=url+"&pkey_value="+network_id;
	url=url+"&pkey_value_prev="+prev_network_id;
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
				var network_name=document.getElementById("network_name").value;
				var network_url=document.getElementById("network_url").value; 
				var network_cat=document.getElementById("network_cat").value; 
				var checkValidation=emptyValidation('network_id~network_name');
				
				if (checkValidation == true)
				{
					requestInfo('showNetworks.php?mode=update_data&network_id='+network_id+'&network_name='+network_name+'&network_url='+network_url+'&network_cat='+network_cat+'&prev_network_id='+prev_network_id,'showNetworks','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}