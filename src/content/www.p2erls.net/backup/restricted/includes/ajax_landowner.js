function init_table()
{
	requestInfo('showLandowner.php?mode=list','showLandowner','');
}
				
function save_data(table_name,pkey)
{
	var check;
	var landowner_id=document.getElementById("landowner_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+landowner_id;
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
				var landowner_name=document.getElementById("landowner_name").value;
				var landowner_url=document.getElementById("landowner_url").value;
				var lb_id=document.getElementById("lb_id").value; 
				var state_id=document.getElementById("state_id").value;
				var checkValidation=emptyValidation('landowner_id~landowner_name');
				
				if(checkValidation == true)
				{
					requestInfo('showLandowner.php?mode=save_new&landowner_id='+landowner_id+'&landowner_name='+landowner_name+'&landowner_url='+landowner_url+'&lb_id='+lb_id+'&state_id='+state_id,'showLandowner','');
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
	var prev_landowner_id=document.getElementById("prev_landowner_id").value;
	var landowner_id=document.getElementById("landowner_id").value;
	
	if (prev_landowner_id != landowner_id && access_level != 1)
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
	url=url+"&pkey_value="+landowner_id;
	url=url+"&pkey_value_prev="+prev_landowner_id;
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
				var landowner_name=document.getElementById("landowner_name").value;
				var landowner_url=document.getElementById("landowner_url").value;
				var lb_id=document.getElementById("lb_id").value;
				var state_id=document.getElementById("state_id").value;				
				var checkValidation=emptyValidation('landowner_id~landowner_name');
				
				if (checkValidation == true)
				{
					requestInfo('showLandowner.php?mode=update_data&landowner_id='+landowner_id+'&landowner_name='+landowner_name+'&landowner_url='+landowner_url+'&lb_id='+lb_id+'&state_id='+state_id+'&prev_landowner_id='+prev_landowner_id,'showLandowner','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}