function init_table()
{
	requestInfo('showContinents.php?mode=list','showContinents','');
}
	
function save_data(table_name,pkey)
{		
	var check;
	var co_id=document.getElementById("co_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+co_id;
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
				var co_id=document.getElementById("co_id").value; 
				var co_name=document.getElementById("co_name").value; 
				var checkValidation=emptyValidation('co_id~co_name');
		
				if (checkValidation == true)
				{
					requestInfo('showContinents.php?mode=save_new&co_id='+co_id+'&co_name='+co_name,'showContinents','');
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
	var prev_co_id=document.getElementById("prev_co_id").value;
	var co_id=document.getElementById("co_id").value;
	
	if (prev_co_id != co_id && access_level != 1)
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
	url=url+"&pkey_value="+co_id;
	url=url+"&pkey_value_prev="+prev_co_id;
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
				var prev_co_id=document.getElementById("prev_co_id").value;
				var co_id=document.getElementById("co_id").value; 
				var co_name=document.getElementById("co_name").value; 
				var checkValidation=emptyValidation('co_id~co_name');
				
				if (checkValidation == true)
				{
					requestInfo('showContinents.php?mode=update_data&co_id='+co_id+'&co_name='+co_name+'&prev_co_id='+prev_co_id,'showContinents','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}