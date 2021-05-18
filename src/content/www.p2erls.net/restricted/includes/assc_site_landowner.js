function showCheckResult(checkbox_condition,table_name,pkey,pkey_value,assc_pkey,assc_pkey_value)
{ 
	var xmlHttp=GetXmlHttpObject();
	
	if (xmlHttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	
	var turn = '';
	if (checkbox_condition) { turn = 'On'; }
	if (!checkbox_condition) { turn = 'Off'; }
	
	var account_num = document.getElementById('result_account_'+assc_pkey_value).innerHTML;
	
	//var div_id = 'site_landowner2_'+landowner_id;
	var url="includes/update_assc.php";	
	url=url+"?account_num="+account_num;
	url=url+"&table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+pkey_value;
	url=url+"&assc_pkey="+assc_pkey;
	url=url+"&assc_pkey_value="+assc_pkey_value;
	url=url+"&turn="+turn;
	url=url+"&sid="+Math.random();
	prompt("",url);
	
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{ 
			var check_result_text = '';
			var check_result = xmlHttp.responseText;
			var check_result_array=check_result.split(",");
			
			if (check_result_array[0] == 1) { check_result_text = 'Saved!'; }
			if (check_result_array[0] == 2) { check_result_text = 'Addition Submitted For Approval!'; }
			if (check_result_array[0] == 3) { check_result_text = 'Removal Request Deleted!'; }			
			if (check_result_array[0] == 4) { check_result_text = 'Deleted!'; }
			if (check_result_array[0] == 5) { check_result_text = 'Removal Submitted For Approval!'; }
			if (check_result_array[0] == 6) { check_result_text = 'Addition Request Deleted!'; }			
			
			//alert("check_result_text");
			var acct_num = check_result_array[1];
			//alert(acct_num);
			document.getElementById('result_account_'+assc_pkey_value).innerHTML = acct_num;
			
			var result_div = document.getElementById('result_action_'+assc_pkey_value);			
			result_div.innerHTML = check_result_text;			
			//setTimeout('changeText(result_div)',3000);
			setTimeout("result_div.innerHTML = 'Click To Modify Again'",3000);
		}  
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}


function showGradient(thisCheckbox,site_id,gradient_id)
{ 

 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
  

		var url="assc_site_gradient.php";
		url=url+"?site_id="+site_id;
		url=url+"&gradient_id="+gradient_id; 
		url=url+"&v="+thisCheckbox;
		url=url+"&sid="+Math.random();
		//alert(url);
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4)
			{
				 
				if (thisCheckbox) {
						document.getElementById('site_gradient_'+gradient_id).innerHTML = xmlHttp.responseText;
						document.getElementById('site_gradient2_'+gradient_id).innerHTML = 'Saved!'; 
						
				}
				if (!thisCheckbox) {
						document.getElementById('site_gradient_'+gradient_id).innerHTML = xmlHttp.responseText;
						document.getElementById('site_gradient2_'+gradient_id).innerHTML = 'Deleted!'; 
				}
				 
			}  
		}   
xmlHttp.open("GET",url,true);
xmlHttp.send(null); 
}


 

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}