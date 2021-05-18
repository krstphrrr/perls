var xmlHttp;  
 
 
function showGradients(thisCheckbox,gradient_id,region_id)
{ 

 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
  

		var url="assc_gradient_region.php";
		url=url+"?gradient_id="+gradient_id;
		url=url+"&region_id="+region_id; 
		url=url+"&v="+thisCheckbox;
		url=url+"&sid="+Math.random();
		// alert(url);
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4)
			{
				 
				if (thisCheckbox) {
						document.getElementById('gradient_region_'+region_id).innerHTML = xmlHttp.responseText;
						document.getElementById('gradient_region2_'+region_id).innerHTML = 'Saved!'; 
						
				}
				if (!thisCheckbox) {
						document.getElementById('gradient_region_'+region_id).innerHTML = xmlHttp.responseText;
						document.getElementById('gradient_region2_'+region_id).innerHTML = 'Deleted!'; 
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