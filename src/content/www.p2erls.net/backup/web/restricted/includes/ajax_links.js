function init_table()
{
	requestInfo('showLinks.php?mode=list','showLinks','');
}
	
function save_data(table_name,pkey)
{		
	var check;
	var co_id=document.getElementById("link_id").value;
	
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
				var link_name=document.getElementById("link_name").value; 
				var link_url=document.getElementById("link_url").value; 
				var link_cat=document.getElementById("link_cat").value; 
				var link_global=document.getElementById("link_global").value; 
				var link_homepg=document.getElementById("link_homepg").value; 
				var checkValidation=emptyValidation('link_name~link_url');
		
				if (checkValidation == true)
				{
					requestInfo('showLinks.php?mode=save_new&link_name='+link_name+'&link_url='+link_url+'&link_cat='+link_cat+'&link_global='+link_global+'&link_homepg='+link_homepg,'showLinks','');
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
	var prev_link_id=document.getElementById("prev_link_id").value;
	var link_id=document.getElementById("link_id").value;
	
	if (prev_link_id != link_id && access_level != 1)
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
	url=url+"&pkey_value="+link_id;
	url=url+"&pkey_value_prev="+prev_link_id;
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
				var prev_link_id=document.getElementById("prev_link_id").value;
				var link_id=document.getElementById("link_id").value; 
				var link_name=document.getElementById("link_name").value; 
				var link_url=document.getElementById("link_url").value; 
				var link_cat=document.getElementById("link_cat").value; 
				var link_global=document.getElementById("link_global").value; 
				var link_homepg=document.getElementById("link_homepg").value; 

				var checkValidation=emptyValidation('link_name~link_url');
				
				if (checkValidation == true)
				{
					requestInfo('showLinks.php?mode=update_data&prev_link_id='+prev_link_id+'&link_id='+link_id+'&link_name='+link_name+'&link_url='+link_url+'&link_cat='+link_cat+'&link_global='+link_global+'&link_homepg='+link_homepg ,'showLinks','');
				} 
			}
		}		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}