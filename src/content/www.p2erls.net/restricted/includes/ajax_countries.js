function init_table()
{
	requestInfo('showCountries.php?mode=list','showCountries','');
}
	
function save_data(table_name,pkey)
{		
	var check;
	var country_id=document.getElementById("country_id").value;
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
	var url="includes/function_id_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+country_id;
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
				var country_id=document.getElementById("country_id").value; 
				var country_name=document.getElementById("country_name").value; 
				var checkValidation=emptyValidation('country_id~country_name');
		
				if (checkValidation == true)
				{
					requestInfo('showCountries.php?mode=save_new&country_id='+country_id+'&country_name='+country_name,'showCountries','');
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
	var prev_country_id=document.getElementById("prev_country_id").value;
	var country_id=document.getElementById("country_id").value;
	
	if (prev_country_id != country_id && access_level != 1)
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
	url=url+"&pkey_value="+country_id;
	url=url+"&pkey_value_prev="+prev_country_id;
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
				var prev_country_id=document.getElementById("prev_country_id").value;
				var country_id=document.getElementById("country_id").value; 
				var country_name=document.getElementById("country_name").value; 
				var checkValidation=emptyValidation('country_id~country_name');
				
				if (checkValidation == true)
				{
					requestInfo('showCountries.php?mode=update_data&country_id='+country_id+'&country_name='+country_name+'&prev_country_id='+prev_country_id,'showCountries','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}