/*
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Copyright (C) 2007 Cro-Cec, Inc. dba Digital Solutions.
//	A complete description of Digital Solutionsâ€™ copyright notice can be found online at: 
//	http://www.digitalsolutionslc.com/copyright_notice.php 
//		
//	Digital Solutions is a premier marketing and web development company in Las Cruces, New Mexico. 
//	We offer professional web design including flash and database web sites, graphic design, marketing materials, 
//	and video production. 
//
//	If you enjoyed this website and are looking for custom web development, give us a call at (505) 523-7661.
//		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/
//<![CDATA[ 
var map = null;	var geocoder = null;	var xmlHttp; var xmlHttp2; var xmlHttp3;	var current_sites_queried; var search_sites_criteria; var search_type;

var site_name = [];var site_url = [];var site_lat = [];var site_long = [];var site_elevlow = [];var site_elevhigh = [];var site_elevmean = [];var site_temp = [];var site_precip = [];var site_desc = [];var ecosystem_id = [];var site_id = [];var country_id = [];var site_flyer = [];
				
var zz =0;	var MyMarkers =[];	var markers =[];		var changed_marker = null;	var point = [];

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Reset Map
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mapReset()
{
	map.setCenter(new GLatLng(32.311740, -106.782026), 2 ,G_HYBRID_TYPE);
	//document.getElementById('searchSites').innerHTML = "";
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Reset Map
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Map Stuff
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function load() 
{ 
	if (GBrowserIsCompatible()) 
	{
		
		
		
		map = new GMap2(document.getElementById("map")); 
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl()); 
		map.setCenter(new GLatLng(32.311740, -106.782026), 2 );
		map.setMapType(G_HYBRID_TYPE);  
		map.addControl(new GOverviewMapControl());
		map.addControl(new GScaleControl());
		
		var blueIcon = new GIcon(G_DEFAULT_ICON);
  		blueIcon.image = "http://www.p2erls.net/images/marker_beige.png";
		
		// Set up our GMarkerOptions object
		markerOptions = { icon:blueIcon };
	
		var url = 'google_maps/generate_xml_map_results_all.php';
		GDownloadUrl(url, function(data) {
		var xml = GXml.parse(data);
		markers = xml.documentElement.getElementsByTagName("marker");
        var current_id;
		//alert(markers.length);
		for (zz = 0; zz < markers.length; zz++) 
			{
				current_id 					= markers[zz].getAttribute("site_id");
            	site_id[current_id] 		= markers[zz].getAttribute("site_id");
				site_name[current_id] 		= markers[zz].getAttribute("site_name");
				site_url[current_id] 		= markers[zz].getAttribute("site_url");
				site_lat[current_id]		= markers[zz].getAttribute("site_lat");
				site_long[current_id] 		= markers[zz].getAttribute("site_long");
				site_elevlow[current_id] 	= markers[zz].getAttribute("site_elevlow");
				site_elevhigh[current_id] 	= markers[zz].getAttribute("site_elevhigh");
				site_elevmean[current_id] 	= markers[zz].getAttribute("site_elevmean");
				site_temp[current_id] 		= markers[zz].getAttribute("site_temp");
				site_precip[current_id] 	= markers[zz].getAttribute("site_precip");
				site_desc[current_id] 		= markers[zz].getAttribute("site_desc");
				ecosystem_id[current_id] 	= markers[zz].getAttribute("ecosystem_id");
				country_id[current_id] 		= markers[zz].getAttribute("country_id");
				site_flyer[current_id] 		= markers[zz].getAttribute("site_flyer");
				
				if (site_lat[current_id] > 90 || site_lat[current_id] < -90 || site_long[current_id] > 180 || site_long[current_id] < -180) {
					//alert(current_id);
				} else {				
					point[current_id] = new GLatLng(site_lat[current_id],site_long[current_id]);
					MyMarkers[current_id] = createMarker(point[current_id], site_name[current_id], site_url[current_id], current_id, markerOptions, site_flyer[current_id]);
					map.addOverlay(MyMarkers[current_id]);
				}

			}
		});
		
				//searchSiteCriteria();  //Change Markers
				//searchSiteCriteriaTable();
	}
}

function myclick(i) 
{
	GEvent.trigger(MyMarkers[i], "click");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Map Stuff
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Create Marker
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function createMarker(point, site_name, site_url, site_id, markerOptions, site_flyer) 
{
	if(site_flyer != ''){ var pdfhtml = "<br/> <a href='http://www.p2erls.net/flyers/" + site_id + "/" + site_flyer + "' target='_blank'>Site Pdf &raquo;</a>";} else { pdfhtml = '';}
  	var marker = new GMarker(point, markerOptions);
  	var html = "<b>" + site_name + "</b><br/><br/><a href='site.php?site_id=" + site_id + "' target='_blank'>More &raquo;</a><br/><a href='" + site_url + "' target='_blank'>View Website &raquo;</a>" + pdfhtml;
  	
	GEvent.addListener(marker, 'click', function() 
	{
    	marker.openInfoWindowHtml(html);
  	});
  	// Switch icon on marker mouseover and mouseout
        GEvent.addListener(marker, "mouseover", function() {
          marker.setImage("http://www.p2erls.net/images/marker_white.png");
        });
        GEvent.addListener(marker, "mouseout", function() {
          marker.setImage("http://www.p2erls.net/images/marker_beige.png");
        });
	return marker;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Create Marker
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Search Site Criteria
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function searchSiteCriteria(search_type)
{ 
	//prompt ("",search_type);
	removeAll();
	
	document.getElementById('searchSites').innerHTML = "";
	document.getElementById('loadingMarkers').innerHTML = "Searching for Sites...  Please Wait";
	
	if(search_type=='Sites')//only for the sites.php page
	{
		var select_multiple_sites=document.getElementById("select_multiple_sites").value;
	}
	
	if(search_type=='Search')//only for the sites.php page
	{
		var search_term=document.getElementById("search_term").value;
		search_term.replace(" ","_");
		//prompt ("",search_term);
		
	}
	
	if(search_type=='Main')// the following are the default search criteria
	{		
		var select_multiple_programs=document.getElementById("select_multiple_programs").value;
		var select_multiple_networks=document.getElementById("select_multiple_networks").value;
		var select_multiple_gradients=document.getElementById("select_multiple_gradients").value;
		var select_multiple_regions=document.getElementById("select_multiple_regions").value;
		var select_multiple_ecosystems=document.getElementById("select_multiple_ecosystems").value;
		var site_elev_min=document.getElementById("site_elev_min").value;
		var site_elev_max=document.getElementById("site_elev_max").value;
		var site_temp_min=document.getElementById("site_temp_min").value;
		var site_temp_max=document.getElementById("site_temp_max").value; 
		var site_precip_min=document.getElementById("site_precip_min").value;
		var site_precip_max=document.getElementById("site_precip_max").value; 
	}
	if(search_type=='savedEmpty')// the following are the default search criteria
	{		
		var select_multiple_programs = "";
		var select_multiple_networks = "";
		var select_multiple_gradients = "";
		var select_multiple_regions = "";
		var select_multiple_ecosystems = "";
		var site_elev_min = "";
		var site_elev_max = "";
		var site_temp_min = "";
		var site_temp_max = ""; 
		var site_precip_min = "";
		var site_precip_max = "";  
	}
	
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	} 

	//Form Url
	var url="includes/searchSiteCriteriaMarkers.php"
	url=url+"?sid="+Math.random() 
	url=url+"&search_type="+search_type  
	
	if(search_type=='Sites')//only for the sites.php page
	{
		url=url+"&select_multiple_sites="+select_multiple_sites
	}
	
	else if(search_type=='Search')//only for the sites.php page
	{
		url=url+"&search_term="+search_term
	}
	
	else// the following are the default search criteria
	{
		url=url+"&select_multiple_programs="+select_multiple_programs
		url=url+"&select_multiple_networks="+select_multiple_networks
		url=url+"&select_multiple_gradients="+select_multiple_gradients
		url=url+"&select_multiple_regions="+select_multiple_regions
		url=url+"&select_multiple_ecosystems="+select_multiple_ecosystems
		url=url+"&site_elev_min="+site_elev_min
		url=url+"&site_elev_max="+site_elev_max
		url=url+"&site_temp_min="+site_temp_min
		url=url+"&site_temp_max="+site_temp_max 
		url=url+"&site_precip_min="+site_precip_min 
		url=url+"&site_precip_max="+site_precip_max 
	}  
	//prompt("",url);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			search_results = xmlHttp.responseText;
			
			if (search_results != '')
			{
				//prompt ("",search_results);
				addNew(search_results, search_type);
				if (search_type == 'Search')
				{
					searchSiteCriteriaTable(search_type,search_results,select_multiple_programs,select_multiple_networks,select_multiple_gradients,select_multiple_regions,select_multiple_ecosystems,site_elev_min,site_elev_max,site_temp_min,site_temp_max,site_precip_min,site_precip_max);
				}
				else
				{
					searchSiteCriteriaTable(search_type,'',select_multiple_programs,select_multiple_networks,select_multiple_gradients,select_multiple_regions,select_multiple_ecosystems,site_elev_min,site_elev_max,site_temp_min,site_temp_max,site_precip_min,site_precip_max);
				}
				document.getElementById('loadingMarkers').innerHTML = "";
			}
			else
			{
				alert("Sorry, there are no results for your search criteria.");
			}
		}
	}   
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null); 
}

function searchSiteCriteriaTable(search_type,search_results,select_multiple_programs,select_multiple_networks,select_multiple_gradients,select_multiple_regions,select_multiple_ecosystems,site_elev_min,site_elev_max,site_temp_min,site_temp_max,site_precip_min,site_precip_max)
{ 
	//prompt ("",search_type);
	//prompt ("",search_results);
	if(search_type=='Sites')//only for the sites.php page
	{
		var select_multiple_sites=document.getElementById("select_multiple_sites").value;
		//prompt("",select_multiple_sites);
	}
	
	if(search_type=='Main')// the following are the default search criteria
	{		
		var select_multiple_programs=document.getElementById("select_multiple_programs").value;
		var select_multiple_networks=document.getElementById("select_multiple_networks").value;
		var select_multiple_gradients=document.getElementById("select_multiple_gradients").value;
		var select_multiple_regions=document.getElementById("select_multiple_regions").value;
		var select_multiple_ecosystems=document.getElementById("select_multiple_ecosystems").value;
		var site_elev_min=document.getElementById("site_elev_min").value;
		var site_elev_max=document.getElementById("site_elev_max").value;
		var site_temp_min=document.getElementById("site_temp_min").value;
		var site_temp_max=document.getElementById("site_temp_max").value; 
		var site_precip_min=document.getElementById("site_precip_min").value;
		var site_precip_max=document.getElementById("site_precip_max").value; 
	}
	if(search_type=='savedEmpty')// the following are the default search criteria
	{		
		var select_multiple_programs = "";
		var select_multiple_networks = "";
		var select_multiple_gradients = "";
		var select_multiple_regions = "";
		var select_multiple_ecosystems = "";
		var site_elev_min = "";
		var site_elev_max = "";
		var site_temp_min = "";
		var site_temp_max = ""; 
		var site_precip_min = "";
		var site_precip_max = "";  
	}
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	}
	
	//Form Url	 
	var url2="includes/searchSiteCriteriaTable.php"
	url2=url2+"?sid="+Math.random() 
	url2=url2+"&search_type="+search_type  
	
	if(search_type=='Sites')//only for the sites.php page
	{
		url2=url2+"&select_multiple_sites="+select_multiple_sites
	}
	
	else if(search_type=='Search')//only for the sites.php page
	{
		url2=url2+"&search_results="+search_results
	}
	
	else// the following are the default search criteria
	{
		url2=url2+"&select_multiple_programs="+select_multiple_programs
		url2=url2+"&select_multiple_networks="+select_multiple_networks
		url2=url2+"&select_multiple_gradients="+select_multiple_gradients
		url2=url2+"&select_multiple_regions="+select_multiple_regions
		url2=url2+"&select_multiple_ecosystems="+select_multiple_ecosystems
		url2=url2+"&site_elev_min="+site_elev_min
		url2=url2+"&site_elev_max="+site_elev_max
		url2=url2+"&site_temp_min="+site_temp_min
		url2=url2+"&site_temp_max="+site_temp_max 
		url2=url2+"&site_precip_min="+site_precip_min 
		url2=url2+"&site_precip_max="+site_precip_max 
	}  
	//prompt("",url2);
	// Run Ajax
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			//prompt ("",xmlHttp.responseText);
			document.getElementById('searchSites').innerHTML = xmlHttp.responseText;
			 
		}  
	}   
	
	xmlHttp.open("GET",url2,true); 
	xmlHttp.send(null);
	 
}


function searchSiteCriteriaTable2(table_url)
{  
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	}
	
	 
	 
	var url="includes/searchSiteCriteriaTable.php" 
	url=url+table_url 
	url=url+"&sid="+Math.random()  
	
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4)
		{
			document.getElementById('searchSites').innerHTML = xmlHttp.responseText;
		}  
	}   
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	 
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Search Sites Criteria
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Ajax Stuff
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function GetXmlHttpObject(){var xmlHttp=null;try{ xmlHttp=new XMLHttpRequest();}catch (e){ try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}}return xmlHttp;}
function GetXmlHttpObject2(){var xmlHttp2=null;try{ xmlHttp2=new XMLHttpRequest();}catch (e){ try{xmlHttp2=new ActiveXObject("Msxml2.XMLHTTP");}catch (e){xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");}}return xmlHttp2;}
function GetXmlHttpObject3(){var xmlHttp3=null;try{ xmlHttp3=new XMLHttpRequest();}catch (e){ try{xmlHttp3=new ActiveXObject("Msxml2.XMLHTTP");}catch (e){xmlHttp3=new ActiveXObject("Microsoft.XMLHTTP");}}return xmlHttp3;}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Remove All Markers
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function removeAll() 
{
	var dd = 0;

	for (dd = 0; dd < markers.length; dd++) 
	{
		var current_id =  markers[dd].getAttribute("site_id");
		map.removeOverlay(MyMarkers[current_id]);
 	}
	return;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Remove All Markers
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add New Markers
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function addNew(search_sites, search_type) 
{ 
//alert("sites to add " + search_sites);
	if(search_sites=='')
	{
		var ff = 0;
		for (ff = 0; dd < MyMarkers.length; ff++) 
		{
			var current_id =  markers[ff].getAttribute("site_id");
			map.addOverlay(MyMarkers[current_id]);
		}
		return;
	}
	if(search_sites!='')
	{
		if (search_type == 'Search')
		{
			var brokenstring=search_sites.split("_");
		}
		else
		{
			var brokenstring=search_sites.split(",");
		}
		//alert(brokenstring.length);
		var ee = 0;
		var search_site_id = null;
		
		for (ee = 0; ee < brokenstring.length; ee++)		 
		{ 
			var search_site_id = brokenstring[ee];
			map.addOverlay(MyMarkers[search_site_id]);
			//alert(search_site_id);			 
		}
		return;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Add New Markers
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Saved Searches
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
function saveSearch(account_num)
{  
	if(account_num==''){ alert("You must be logged in to save your search"); return; }
	
	document.getElementById('showSavedSearches').innerHTML = "Saving Search...  Please Wait";
	
	var select_multiple_programs=document.getElementById("select_multiple_programs").value;
	var select_multiple_networks=document.getElementById("select_multiple_networks").value;
	var select_multiple_gradients=document.getElementById("select_multiple_gradients").value;
	var select_multiple_regions=document.getElementById("select_multiple_regions").value;
	var select_multiple_ecosystems=document.getElementById("select_multiple_ecosystems").value;
	var site_elev_min=document.getElementById("site_elev_min").value;
	var site_elev_max=document.getElementById("site_elev_max").value;
	var site_temp_min=document.getElementById("site_temp_min").value;
	var site_temp_max=document.getElementById("site_temp_max").value; 
	var site_precip_min=document.getElementById("site_precip_min").value;
	var site_precip_max=document.getElementById("site_precip_max").value; 
	
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	} 

	var search_name = prompt('Please enter the name of your Search. Special Characters  are not allowed.  \n\n', '');
	if(search_name == null ){ alert("Cancelled Saving of Search"); return;}
	
	//Form Url
	var url="includes/saveSearch.php"
	url=url+"?sid="+Math.random() 
	
	url=url+"&select_multiple_programs="+select_multiple_programs
	url=url+"&select_multiple_networks="+select_multiple_networks
	url=url+"&select_multiple_gradients="+select_multiple_gradients
	url=url+"&select_multiple_regions="+select_multiple_regions
	url=url+"&select_multiple_ecosystems="+select_multiple_ecosystems
	url=url+"&site_elev_min="+site_elev_min
	url=url+"&site_elev_max="+site_elev_max
	url=url+"&site_temp_min="+site_temp_min
	url=url+"&site_temp_max="+site_temp_max 
	url=url+"&site_precip_min="+site_precip_min 
	url=url+"&site_precip_max="+site_precip_max 
	url=url+"&account_num="+account_num 
	url=url+"&search_name="+search_name 
	
	//prompt("",url);
	xmlHttp.onreadystatechange = function(){if(xmlHttp.readyState == 4)
	{
		//prompt("",xmlHttp.responseText);
		//showSavedSearches(account_num);
		alert(search_name+" Has Been Saved");
		document.getElementById('showSavedSearches').innerHTML = "";
	}}   
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null); 
} 
function showSavedSearches(account_num)
{  
	document.getElementById('showSavedSearches').innerHTML = "Loading Saved Searches...  Please Wait";
	
	 
	xmlHttp3=GetXmlHttpObject();	if (xmlHttp3==null)	{	alert ("Browser does not support HTTP Request");	return;	} 

	//Form Url
	var url="includes/showSavedSearches.php"
	url=url+"?sid="+Math.random() 
	
	url=url+"&account_num="+account_num 
	 
	//prompt("",url);
	xmlHttp3.onreadystatechange = function(){if(xmlHttp3.readyState == 4)
	{
		document.getElementById('showSavedSearches').innerHTML = xmlHttp3.responseText;
	}}   
	
	xmlHttp3.open("GET",url,true);
	xmlHttp3.send(null); 
} 

function loadSearch(select_multiple_programs,select_multiple_networks,select_multiple_gradients,select_multiple_regions,select_multiple_ecosystems,site_elev_min,site_elev_max,site_temp_min,site_temp_max,site_precip_min,site_precip_max)
{  
/*
	document.getElementById("select_multiple_programs").value 	= select_multiple_programs;
	document.getElementById("select_multiple_networks").value 	= select_multiple_networks;
	document.getElementById("select_multiple_gradients").value	= select_multiple_gradients;
	document.getElementById("select_multiple_regions").value 	= select_multiple_regions;
	document.getElementById("select_multiple_ecosystems").value = select_multiple_ecosystems;
	document.getElementById("site_elev_min").value 			= site_elev_min;
	document.getElementById("site_elev_max").value 			= site_elev_max;
	document.getElementById("site_temp_min").value 				= site_temp_min;
	document.getElementById("site_temp_max").value 				= site_temp_max;
	document.getElementById("site_precip_min").value 			= site_precip_min;
	document.getElementById("site_precip_max").value 			= site_precip_max;
*/	
	removeAll();
	
	document.getElementById('searchSites').innerHTML = "";
	document.getElementById('loadingMarkers').innerHTML = "Searching for Sites...  Please Wait";
	 
	 
	
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	} 

	//Form Url
	var url="includes/searchSiteCriteriaMarkers.php"
	url=url+"?sid="+Math.random() 
	url=url+"&search_type=Main" 
	 
	 
		url=url+"&select_multiple_programs="+select_multiple_programs
		url=url+"&select_multiple_networks="+select_multiple_networks
		url=url+"&select_multiple_gradients="+select_multiple_gradients
		url=url+"&select_multiple_regions="+select_multiple_regions
		url=url+"&select_multiple_ecosystems="+select_multiple_ecosystems
		url=url+"&site_elev_min="+site_elev_min
		url=url+"&site_elev_max="+site_elev_max
		url=url+"&site_temp_min="+site_temp_min
		url=url+"&site_temp_max="+site_temp_max 
		url=url+"&site_precip_min="+site_precip_min 
		url=url+"&site_precip_max="+site_precip_max 
	
	//prompt("",url);
	xmlHttp.onreadystatechange = function(){if(xmlHttp.readyState == 4)
	{
		search_sites_criteria = xmlHttp.responseText; 
		addNew(search_sites_criteria, search_type);
		searchSiteCriteriaTable('Saved',select_multiple_programs,select_multiple_networks,select_multiple_gradients,select_multiple_regions,select_multiple_ecosystems,site_elev_min,site_elev_max,site_temp_min,site_temp_max,site_precip_min,site_precip_max);
		document.getElementById('loadingMarkers').innerHTML = "";
	}}   
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);  
} 
function removeSearch(saved_search_num,search_name,account_num)
{  
 
	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null)	{	alert ("Browser does not support HTTP Request");	return;	} 

	if(confirm("Are you sure you want to delete "+search_name+"?")){
	//Form Url
	var url="includes/removeSearch.php"
	url=url+"?sid="+Math.random() 
	url=url+"&saved_search_num="+saved_search_num
	
	//prompt("",url);
	xmlHttp.onreadystatechange = function(){if(xmlHttp.readyState == 4)
	{
		alert(search_name+" Has Been Removed");
		showSavedSearches(account_num);
	}}   
	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);  
	}
	else{ return; }
} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// End Saved Searches
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function clearSearchCriteria()
{  
	document.getElementById("select_multiple_programs").value 	= '';
	document.getElementById("select_multiple_networks").value 	= '';
	document.getElementById("select_multiple_gradients").value	= '';
	document.getElementById("select_multiple_regions").value 	= '';
	document.getElementById("select_multiple_ecosystems").value = '';
	document.getElementById("site_elev_min").value 				= '';
	document.getElementById("site_elev_max").value 				= '';
	document.getElementById("site_temp_min").value 				= '';
	document.getElementById("site_temp_max").value 				= '';
	document.getElementById("site_precip_min").value 			= '';
	document.getElementById("site_precip_max").value 			= '';
}
