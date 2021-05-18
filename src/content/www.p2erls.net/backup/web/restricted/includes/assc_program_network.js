var xmlHttp;  
 
 
function showProgramNetworks(thisCheckbox,program_id,network_id)
{ 

 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
  

		var url="assc_program_network.php";
		url=url+"?program_id="+program_id;
		url=url+"&network_id="+network_id; 
		url=url+"&v="+thisCheckbox;
		url=url+"&sid="+Math.random();
		// alert(url);
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4)
			{
				 
				if (thisCheckbox) {
						document.getElementById('program_network_'+network_id).innerHTML = xmlHttp.responseText;
						document.getElementById('program_network2_'+network_id).innerHTML = 'Saved!'; 
						
				}
				if (!thisCheckbox) {
						document.getElementById('program_network_'+network_id).innerHTML = xmlHttp.responseText;
						document.getElementById('program_network2_'+network_id).innerHTML = 'Deleted!'; 
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