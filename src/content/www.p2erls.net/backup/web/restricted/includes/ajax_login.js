var xmlHttp; var login_from;

function loginProcess(login_from) 
{
	alert (login_from);
	var var_username=document.getElementById("username").value;
	var var_password=document.getElementById("password").value;
	
	xmlHttp = GetXmlHttpObject();

	if (xmlHttp == null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}  
	
	if (login_from=='front_end')
 	{
 		var url="restricted/Security_Dept/login_check.php";
 	} 
	
	if (login_from=='back_end')
 	{
 		var url="Security_Dept/login_check.php";
 	}
	
	url=url+"?username="+var_username;
	url=url+"&password="+var_password;
	url=url+"&sid="+Math.random();
	
	// alert (url)
	 prompt ("hey there", url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			alert (xmlHttp.readyState);
			if(xmlHttp.responseText == 1)
			{
				window.location.href="http://www.p2erls.net/web/restricted/index2.php?type=1";
			}
			if(xmlHttp.responseText == 2)
			{
				window.location.href="http://www.p2erls.net/web/restricted/index2.php?type=2";
			}
			if(xmlHttp.responseText == 3)
			{
				window.location.href="http://www.p2erls.net/web/index.php";
			}
			if(xmlHttp.responseText != 1 && xmlHttp.responseText != 2 && xmlHttp.responseText != 3)
			{
				document.getElementById('loginDetails').innerHTML = xmlHttp.responseText; 
			}
			
		}  
		
	}   
	

	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Ajax Stuff
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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