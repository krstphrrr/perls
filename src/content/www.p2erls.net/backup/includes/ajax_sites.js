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
function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }
var http = getHTTPObject();  // We create the HTTP Object

/*
	Funtion Name=requestInfo 
	Param = url >> Url to call : site_id = Passing div site_id for multiple use ~ as a seprator for eg. div1~div2 :
	redirectPage >> if you like to redirect to other page once the event success then 
	the response text = 1 and the redirectPage not left empty
*/

    function requestInfo(url,site_id,redirectPage) {      
		var temp=new Array();
			http.open("GET", url, true);
			http.onreadystatechange = function() {
				if (http.readyState == 4) {
				  if(http.status==200) {
			  		var results=http.responseText;
					if(redirectPage=="" || results!="1") {
						
						var temp=site_id.split("~"); // To display on multiple div 
						//alert(temp.length);
						var r=results.split("~"); // To display multiple data into the div 
						//alert(temp.length);
						if(temp.length>1) {
							for(i=0;i<temp.length;i++) {	
								//alert(temp[i]);
								document.getElementById(temp[i]).innerHTML=r[i];
							}
						} else {
							document.getElementById(site_id).innerHTML = results;
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

function init_table() {
		requestInfo('showSites.php?mode=list','showSites','');
	}
				
	function save_data() {
			var site_id=document.getElementById("site_id").value; 
			var site_name=document.getElementById("site_name").value;
			var site_url=document.getElementById("site_url").value;
			var site_lat=document.getElementById("site_lat").value;
			var site_long=document.getElementById("site_long").value;
			var site_elevlow=document.getElementById("site_elevlow").value;
			var site_elevhigh=document.getElementById("site_elevhigh").value;
			var site_elevmean=document.getElementById("site_elevmean").value;
			var site_temp=document.getElementById("site_temp").value;
			var site_precip=document.getElementById("site_precip").value;
			var site_desc=document.getElementById("site_desc").value;
			var ecosystem_id=document.getElementById("ecosystem_id").value;
			var state_id=document.getElementById("state_id").value; 
			var country_id=document.getElementById("country_id").value;
			var checkValidation=emptyValidation('site_id~site_name');
	
		if(checkValidation==true) {
			requestInfo('showSites.php?mode=save_new&site_id='+'&site_name='+site_name+'&site_url='+site_url+'&site_lat='+site_lat+'&site_long='+site_long+'&site_elevlow='+site_elevlow+'&site_elevhigh='+site_elevhigh+'&site_elevmean='+site_elevmean+'&site_temp='+site_temp+'&site_precip='+site_precip+'&site_desc='+site_desc+'&ecosystem_id='+ecosystem_id+'&state_id='+state_id+'&country_id='+country_id,'showSites','');
		} 
	}
	
	function update_data() {
			var site_id=document.getElementById("site_id").value; 
			var site_name=document.getElementById("site_name").value;
			var site_url=document.getElementById("site_url").value;
			var site_lat=document.getElementById("site_lat").value;
			var site_long=document.getElementById("site_long").value;
			var site_elevlow=document.getElementById("site_elevlow").value;
			var site_elevhigh=document.getElementById("site_elevhigh").value;
			var site_elevmean=document.getElementById("site_elevmean").value;
			var site_temp=document.getElementById("site_temp").value;
			var site_precip=document.getElementById("site_precip").value;
			var site_desc=document.getElementById("site_desc").value;
			var ecosystem_id=document.getElementById("ecosystem_id").value;
			var state_id=document.getElementById("state_id").value; 
			var country_id=document.getElementById("country_id").value;
			var checkValidation=emptyValidation('site_id~site_name');
	
		if(checkValidation==true) {
			requestInfo('showSites.php?mode=update_data&site_id='+site_id+'&site_name='+site_name+'&site_url='+site_url+'&site_lat='+site_lat+'&site_long='+site_long+'&site_elevlow='+site_elevlow+'&site_elevhigh='+site_elevhigh+'&site_elevmean='+site_elevmean+'&site_temp='+site_temp+'&site_precip='+site_precip+'&site_desc='+site_desc+'&ecosystem_id='+ecosystem_id+'&state_id='+state_id+'&country_id='+country_id+'&prev_site_id='+prev_site_id,'showSites','');
		} 
	}
	
// Update Site Landowner
function updateSiteLandowner(site_id,landowner_id,value){	
	xmlHttp = getHTTPObject();
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4){
			document.getElementById('showSites').innerHTML = xmlHttp.responseText;
			document.getElementById('site_landowner_'+landowner_id).innerHTML = 'Saved!';
			setTimeout("document.getElementById('status_change').innerHTML = ''",3000);
		}
	}
	requestInfo('showSites.php?mode=site_landowner&site_id='+site_id+'&landowner_id='+landowner_id+'&value='+value,'showSites','');
} 

function confirmLink(theLink)
{
   
    var is_confirmed = confirm('Are you sure to delete this record?\n\nThis will permanently delete the Record!');
    if (is_confirmed) {
        theLink.href += '';
    }

    return is_confirmed;
}