function init_table()
{
	requestInfo('showStates.php?mode=list','showStates','');
}
	
function save_data(table_name,pkey)
{		
	var check;
	var state_id=document.getElementById("state_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+state_id;
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
				var state_id=document.getElementById("state_id").value; 
				var state_name=document.getElementById("state_name").value; 
				var checkValidation=emptyValidation('state_id~state_name');
		
				if (checkValidation == true)
				{
					requestInfo('showStates.php?mode=save_new&state_id='+state_id+'&state_name='+state_name,'showStates','');
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
	var prev_state_id=document.getElementById("prev_state_id").value;
	var state_id=document.getElementById("state_id").value;
	
	if (prev_state_id != state_id && access_level != 1)
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
	url=url+"&pkey_value="+state_id;
	url=url+"&pkey_value_prev="+prev_state_id;
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
				var prev_state_id=document.getElementById("prev_state_id").value;
				var state_id=document.getElementById("state_id").value; 
				var state_name=document.getElementById("state_name").value; 
				var checkValidation=emptyValidation('state_id~state_name');
				
				if (checkValidation == true)
				{
					requestInfo('showStates.php?mode=update_data&state_id='+state_id+'&state_name='+state_name+'&prev_state_id='+prev_state_id,'showStates','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}