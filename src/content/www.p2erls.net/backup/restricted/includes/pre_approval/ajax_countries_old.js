function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }
var http = getHTTPObject();  // We create the HTTP Object

/*
	Funtion Name=requestInfo 
	Param = url >> Url to call : country_id = Passing div country_id for multiple use ~ as a seprator for eg. div1~div2 :
	redirectPage >> if you like to redirect to other page once the event success then 
	the response text = 1 and the redirectPage not left empty
*/

function requestInfo(url,div_id,redirectPage) 
{ 
	document.getElementById(div_id).innerHTML = "<div id='loading_indicator' align='center'><h1><b><font color='#FFFFFF'><br />LOADING</font></b></h1><h1><b><font color='#FFFFFF'><img src='../images/ajax-load-indicator.gif' width='32' height='32' /></font></b></h1><h1><b><font color='#FFFFFF'>PLEASE WAIT </font></b></h1></div>";
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
	Desc = This function is used to valcountry_idation for the empty field 
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
		requestInfo('showCountries.php?mode=list','showCountries','');
	}
	
	function save_data() {
			var country_id=document.getElementById("country_id").value; 
			var country_name=document.getElementById("country_name").value; 
			var checkValidation=emptyValidation('country_id~country_name');
	
		if(checkValidation==true) {
			requestInfo('showCountries.php?mode=save_new&country_id='+country_id+'&country_name='+country_name,'showCountries','');
		} 
	}
	
	function update_data(country_id,access_level) 
	{
		if(access_level==1)
		{
			var country_id=document.getElementById("country_id").value;
		}
			var prev_country_id=document.getElementById("prev_country_id").value;
			var country_name=document.getElementById("country_name").value; 
			var checkValidation=emptyValidation('country_id~country_name');
	
		if(checkValidation==true) {
			requestInfo('showCountries.php?mode=update_data&country_id='+country_id+'&country_name='+country_name+'&prev_country_id='+prev_country_id,'showCountries','');
		} 
	}
	
	
function confirmLink(theLink)
{
   
    var is_confirmed = confirm('Are you sure to delete this record?\n\nThis will permanently delete the record!\n\nThis will permanently remove this from any associated record!');
    if (is_confirmed) {
        theLink.href += '';
    }

    return is_confirmed;
}