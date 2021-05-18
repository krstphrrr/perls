function GetXmlHttpObject(){ var xmlHttp=null; try { xmlHttp=new XMLHttpRequest(); } catch (e) { try  { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } } return xmlHttp; }

var xmlHttp;

function refresh_preview()
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	

	var site_id = document.getElementById("site_id").value;
	//var num = document.getElementById(floorplan_image).value;
	if (site_id != '')
	{

		var url = "http://www.p2erls.net/web/restricted/includes/pdf/preview.pdf"; 
		url	= url+"?site_id="+site_id;
		url = url+"&sid="+Math.random();
		//prompt("",url);
		
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.readyState == 4)
			{ 
				var result = xmlHttp.responseText;
				//prompt("",result);
				if(result != '')
				{
					document.getElementById("preview").innerHTML = result;
				}
				else
				{
					document.getElementById("preview").innerHTML = "No Picture Available";
					return;
				}
				
						
			}
		}
		 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	else
	{
		document.getElementById("preview").innerHTML = "";
		return;
	}
}