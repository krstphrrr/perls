//function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }

//var http = getHTTPObject();

//function GetXmlHttpObject(){ var xmlHttp=null; try { xmlHttp=new XMLHttpRequest(); } catch (e) { try  { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } } return xmlHttp; }

function init_table()
{
		requestInfo('showApprovals.php?mode=list','showApprovals','');
}
function updateDB(table_name, pkey, pkey_value, assc_pkey, approval_field, approval_fields_count, previous, proposed, action) 
{
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
 	var url="includes/update_approvals.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+pkey_value;
	url=url+"&assc_pkey="+assc_pkey;
	url=url+"&approval_field="+approval_field;
	url=url+"&approval_fields_count="+approval_fields_count;
	url=url+"&previous="+previous;
	url=url+"&proposed="+proposed;
	url=url+"&action="+action;
	url=url+"&sid="+Math.random();
	
	//alert (url);
	prompt ("",url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			var jabba_the_hut = xmlHttp.responseText;
			requestInfo('showApprovals.php?mode=update_data','showApprovals','');
			//requestInfo('showApprovals.php?mode=list&text='+jabba_the_hut,'showApprovals','');
		}
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);	
}

function update_data(table_name, pkey, pkey_value, assc_pkey, approvals)
{
	if (approvals == '')
	{
		alert('No approvals chosen!');
		return;
	}
	else
	{
		var approval_fields_array=approvals.split(",");
		var i = 0;
		var approval_fields_count=approval_fields_array.length-1;
		
		for (i = 0; i < approval_fields_array.length; i++)
		{
 			var approval_field = approval_fields_array[i];
			
			//prompt ("",assc_pkey);
			if (assc_pkey == '')
			{
				var previous = document.getElementById('previous_'+approval_field).value;
				var proposed = document.getElementById('proposed_'+approval_field).value;
			}
			else
			{
				var previous = '';
				var proposed = document.getElementById('proposed_'+approval_field).innerHTML;
			}
			var action = document.getElementById('action_'+approval_field).value;
			alert (action);
			if (action != '')
			{
				updateDB(table_name, pkey, pkey_value, assc_pkey, approval_field, approval_fields_count, previous, proposed, action);
				approval_fields_count--;
			}
		}
	}
}

/*
function updateDB(table_name, pkey, pkey_value, field_name, previous, proposed, action) 
{
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
 	var url="update_approvals.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+pkey_value;
	url=url+"&field_name="+field_name;
	url=url+"&previous="+previous;
	url=url+"&proposed="+proposed;
	url=url+"&action="+action;
	url=url+"&sid="+Math.random();
	
	//alert (url);
	//prompt ("",url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			var jabba_the_hut = xmlHttp.responseText;
			//requestInfo('showApprovals.php?mode=update_data','showApprovals','');
			requestInfo('showApprovals.php?mode=list','showApprovals','');
		}  
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);	
}

function updateAsscDB(table_name, pkey, pkey_value, field_name, previous, proposed, action) 
{
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
 	var url="update_approvals.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+pkey_value;
	url=url+"&field_name="+field_name;
	url=url+"&previous="+previous;
	url=url+"&proposed="+proposed;
	url=url+"&action="+action;
	url=url+"&sid="+Math.random();
	
	//alert (url);
	//prompt ("",url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			var jabba_the_hut = xmlHttp.responseText;
			//requestInfo('showApprovals.php?mode=update_data','showApprovals','');
			requestInfo('showApprovals.php?mode=list','showApprovals','');
		}  
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);	
}

function update_data(table_name, pkey, pkey_value, approval_fields)
{
	//var check = pendingCheck(table_name, pkey, pkey_value);
	 
	if (approval_fields == '')
	{
		alert('No approvals chosen!');
	}
	else
	{
		var fields=approval_fields.split(",");
		var i = 0;
		
		for (i = 0; i < fields.length; i++)
		{
 			var field_name=fields[i];
			var previous = document.getElementById('previous_'+field_name).value;
			var proposed = document.getElementById('proposed_'+field_name).value;
			var action = document.getElementById('action_'+field_name).value;
			
			if (action != '') { updateDB(table_name, pkey, pkey_value, field_name, previous, proposed, action); }
		}
	}
}

function update_assc_data(table_name, pkey, pkey_value, assc_pkey, approval_ids)
//p2erls_site_landowner, site_id, 'BBP', landowner_id, 'AAMU,ABCRC'
{
	if (approval_ids == '')
	{
		alert('No approvals chosen!');
	}
	else
	{
		var ids=approval_ids.split(",");
		var i = 0;
		
		for (i = 0; i < ids.length; i++)
		{
 			var id_name=ids[i];
			var proposed = document.getElementById('proposed_'+id_name).innerHTML;
			var action = document.getElementById('action_'+id_name).value;
			
			if (action != '') { updateAsscDB(table_name, pkey, pkey_value, assc_pkey, id_name, proposed, action); }
		}
	}
}
*/