function init_table()
{
	requestInfo('showLandowner_bounds.php?mode=list','showLandowner_bounds','');
}

function save_data(table_name,pkey)
{
	var check;
	var lb_id=document.getElementById("lb_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+lb_id;
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
				var lb_description=document.getElementById("lb_description").value;
				var checkValidation=emptyValidation('lb_id~lb_description');
				
				if(checkValidation == true)
				{
					requestInfo('showLandowner_bounds.php?mode=save_new&lb_id='+lb_id+'&lb_description='+lb_description,'showLandowner_bounds','');
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
	var prev_lb_id=document.getElementById("prev_lb_id").value;
	var lb_id=document.getElementById("lb_id").value;
	
	if (prev_lb_id != lb_id && access_level != 1)
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
	url=url+"&pkey_value="+lb_id;
	url=url+"&pkey_value_prev="+prev_lb_id;
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
				var lb_description=document.getElementById("lb_description").value; 
				var checkValidation=emptyValidation('lb_id~lb_description');
				
				if (checkValidation == true)
				{
					requestInfo('showLandowner_bounds.php?mode=update_data&lb_id='+lb_id+'&lb_description='+lb_description+'&prev_lb_id='+prev_lb_id,'showLandowner_bounds','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}