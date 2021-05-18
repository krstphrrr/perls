var xmlHttp;  
 
 
function showNetworkSites(thisCheckbox,network_id,site_id)
{ 

 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
  

		var url="assc_network_site.php";
		url=url+"?network_id="+network_id;
		url=url+"&site_id="+site_id; 
		url=url+"&v="+thisCheckbox;
		url=url+"&sid="+Math.random();
		// alert(url);
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4)
			{
				 
				if (thisCheckbox) {
						document.getElementById('network_site_'+site_id).innerHTML = xmlHttp.responseText;
						document.getElementById('network_site2_'+site_id).innerHTML = 'Saved!'; 
						
				}
				if (!thisCheckbox) {
						document.getElementById('network_site_'+site_id).innerHTML = xmlHttp.responseText;
						document.getElementById('network_site2_'+site_id).innerHTML = 'Deleted!'; 
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