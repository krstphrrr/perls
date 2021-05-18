var xmlHttp;  
 
 
function showRegion(thisCheckbox,region_id,co_id)
{ 

 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
  

		var url="assc_region_co.php";
		url=url+"?region_id="+region_id;
		url=url+"&co_id="+co_id; 
		url=url+"&v="+thisCheckbox;
		url=url+"&sid="+Math.random();
		//alert(url);
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4)
			{
				 
				if (thisCheckbox) {
						document.getElementById('region_co_'+co_id).innerHTML = xmlHttp.responseText;
						document.getElementById('region_co2_'+co_id).innerHTML = 'Saved!'; 
						
				}
				if (!thisCheckbox) {
						document.getElementById('region_co_'+co_id).innerHTML = xmlHttp.responseText;
						document.getElementById('region_co2_'+co_id).innerHTML = 'Deleted!'; 
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