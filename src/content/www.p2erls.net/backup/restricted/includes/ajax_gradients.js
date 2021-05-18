function init_table()
{
	requestInfo('showGradients.php?mode=list','showGradients','');
}

function save_data(table_name,pkey)
{
	var check;
	var gradient_id=document.getElementById("gradient_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+gradient_id;
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
				var gradient_name=document.getElementById("gradient_name").value;
				var gradient_desc=document.getElementById("gradient_desc").value;
				var checkValidation=emptyValidation('gradient_id~gradient_name');
				
				if(checkValidation == true)
				{
					requestInfo('showGradients.php?mode=save_new&gradient_id='+gradient_id+'&gradient_name='+gradient_name+'&gradient_desc='+gradient_desc,'showGradients','');
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
	var prev_gradient_id=document.getElementById("prev_gradient_id").value;
	var gradient_id=document.getElementById("gradient_id").value;
	
	if (prev_gradient_id != gradient_id && access_level != 1)
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
	url=url+"&pkey_value="+gradient_id;
	url=url+"&pkey_value_prev="+prev_gradient_id;
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
				var gradient_name=document.getElementById("gradient_name").value;
				var gradient_desc=document.getElementById("gradient_desc").value; 
				var checkValidation=emptyValidation('gradient_id~gradient_name');
				
				if (checkValidation == true)
				{
					requestInfo('showGradients.php?mode=update_data&gradient_id='+gradient_id+'&gradient_name='+gradient_name+'&gradient_desc='+gradient_desc+'&prev_gradient_id='+prev_gradient_id,'showGradients','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}