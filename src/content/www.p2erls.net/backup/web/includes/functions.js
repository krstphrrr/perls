
function createMarker(point, site_name, site_url) 
{
  	var marker = new GMarker(point);
  	var html = "<b>" + site_name + "</b> <br/>" + site_url;
  	
	GEvent.addListener(marker, 'click', function() 
	{
    	marker.openInfoWindowHtml(html);
  	});
  	
	return marker;
}

 
function searchSiteCriteria()
{ 
	removeAll();
	
	var site_elevlow=document.getElementById("site_elevlow").value;
	var site_elevhigh=document.getElementById("site_elevhigh").value;
	var site_templow=document.getElementById("site_templow").value;
	var site_temphigh=document.getElementById("site_temphigh").value;
	var site_preciplow=document.getElementById("site_preciplow").value;
	var site_preciphigh=document.getElementById("site_preciphigh").value;
	 
	alert(site_preciphigh);
	
	xmlHttp=GetXmlHttpObject();

	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 

	var url="includes/searchSiteCriteriaMarkers.php" 
	url=url+"?site_elevlow="+site_elevlow 
	url=url+"&site_elevhigh="+site_elevhigh 
	url=url+"&site_templow="+site_templow 
	url=url+"&site_temphigh="+site_temphigh 
	url=url+"&site_preciplow="+site_preciplow 
	url=url+"&site_preciphigh="+site_preciphigh 
	url=url+"&sid="+Math.random()
	
	 prompt("url",url);

	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			var search_sites_criteria = xmlHttp.responseText;
		}  
	}   
	
	//alert (search_sites_criteria);
	
	addNew(search_sites_criteria);
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	var url2="includes/searchSiteCriteriaTable.php" 
	url2=url2+"?site_elevlow="+site_elevlow 
	url2=url2+"&site_elevhigh="+site_elevhigh 
	url2=url2+"&site_templow="+site_templow 
	url2=url2+"&site_temphigh="+site_temphigh 
	url2=url2+"&site_preciplow="+site_preciplow 
	url2=url2+"&site_preciphigh="+site_preciphigh 
	url2=url2+"&sid="+Math.random()
	 

	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			document.getElementById('searchSites').innerHTML = xmlHttp.responseText;
		}  
	}   
	
	xmlHttp.open("GET",url2,true);
	xmlHttp.send(null); 
}
function GetXmlHttpObject(){var xmlHttp=null;try{ xmlHttp=new XMLHttpRequest();}catch (e){ try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}}return xmlHttp;}

function removeAll() 
{

	var dd = 0;
	for (dd = 0; dd < 5; dd++) 
	{
		current_id =  markers[dd];
		alert(current_id)
		map.removeOverlay(MyMarkers[current_id]);
 	}
	return;
}

function addNew(search_sites) 
{ 
	 if(search_sites==''){
	var ff = 0;
	for (ff = 0; dd < MyMarkers.length; ff++) 
	{
		map.addOverlay(MyMarkers[ff]);
 	}
	return;
	}
	if(search_sites!=''){
	var brokenstring=search_sites.split(",");
	//alert(brokenstring.length);
	var ee = 0;
	var search_site_id = null;
	
	for (ee = 0; ee < brokenstring.length; ee++)
	 
	{ 
	
		search_site_id = brokenstring[ee];
		 alert(search_site_id);
		map.addOverlay(MyMarkers[search_site_id]);
 	}
	return;
	}
}