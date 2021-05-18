function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }

function GetXmlHttpObject(){ var xmlHttp=null; try { xmlHttp=new XMLHttpRequest(); } catch (e) { try  { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } } return xmlHttp; }

// We create the HTTP Object
var http = getHTTPObject();

/*
	Funtion Name=requestInfo 
	Param = url >> Url to call : site_id = Passing div site_id for multiple use ~ as a seprator for eg. div1~div2 :
	redirectPage >> if you like to redirect to other page once the event success then 
	the response text = 1 and the redirectPage not left empty
*/

function requestInfo(url,div_id,redirectPage) 
{ 
	document.getElementById(div_id).innerHTML = "<div id='loading_indicator' align='center'><h1><b><font color='#FFFFFF'><br />LOADING</font></b></h1><h1><b><font color='#FFFFFF'><img src='http://www.p2erls.net/images/ajax-load-indicator.gif' width='32' height='32' /></font></b></h1><h1><b><font color='#FFFFFF'>PLEASE WAIT </font></b></h1></div>";
		var temp=new Array();
			http.open("GET", url, true);
			http.onreadystatechange = function() {
				if (http.readyState == 4) {
				  if(http.status==200) {
			  		var results=http.responseText;
					if(redirectPage=="" || results!="1") {
						
						var temp=div_id.split("~"); // To display on multiple div 
						//alert(temp.length);
						var r=results.split("~"); // To display multiple data into the div 
						//alert(temp.length);
						if(temp.length>1) {
							for(i=0;i<temp.length;i++) {	
								//alert(temp[i]);
								document.getElementById(temp[i]).innerHTML=r[i];
							}
						} else {
							document.getElementById(div_id).innerHTML = results;
						}	
					} else {
						//alert(results);
						window.location.href=redirectPage;			
					}
				  } 
  				}
			};
			http.send(null);
}

/*
	Function Name= emptyValidation
	Desc = This function is used to valsite_idation for the empty field 
	Param fieldList = This arguments set as a string varialble. you just need to supply the textbox name
	if the textbox is multiple then supply with ~ separator for eg. username~password
*/
function emptyValidation(fieldList) {
		
		var field=new Array();
		field=fieldList.split("~");
		var counter=0;
		for(i=0;i<field.length;i++) {
			if(document.getElementById(field[i]).value=="") {
				document.getElementById(field[i]).style.backgroundColor="#FF0000";
				counter++;
			} else {
				document.getElementById(field[i]).style.backgroundColor="#FFFFFF";	
			}
		}
		if(counter>0) {
				alert("The Field marked as red could not left empty");
				return false;
				
		}  else {
			return true;
		}
		
}
/*
function pendingCheck(table_name, pkey, pkey_value) 
{
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
	
 	var url="includes/function_pending_check.php";
	url=url+"?table_name="+table_name;
	url=url+"&pkey="+pkey;
	url=url+"&pkey_value="+pkey_value;
	url=url+"&sid="+Math.random();
	
	//alert (url)
	//prompt ("hey there", url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			//alert (xmlHttp.responseText);
			var stuff = xmlHttp.responseText;
			return stuff;
		}  
		
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);	
}
*/
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
	//prompt("",url);
	
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
			//setTimeout(result_div.innerHTML = 'Click To Modify Again',3000);
		}  
	}
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function confirmLink(theLink, pkey, pkey_value)
{   
    var is_confirmed = confirm('You are attempting to delete the '+pkey+' with the ID of '+pkey_value+'.\n\nBy clicking Yes, you will permanently delete this entry and any corresponding information,\nincluding associations and saved search parameters.\n\nAre you sure you wish to delete this?');
    if (is_confirmed)
	{
        theLink.href += '';
    }
    return is_confirmed;
}