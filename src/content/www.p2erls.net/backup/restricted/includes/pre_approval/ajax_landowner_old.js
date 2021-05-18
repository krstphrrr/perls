function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }
var http = getHTTPObject();  // We create the HTTP Object

/*
	Funtion Name=requestInfo 
	Param = url >> Url to call : landowner_id = Passing div landowner_id for multiple use ~ as a seprator for eg. div1~div2 :
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
	Desc = This function is used to vallandowner_idation for the empty field 
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
		requestInfo('showLandowner.php?mode=list','showLandowner','');
	}
	
	 
	
	function save_data() {
			var landowner_id=document.getElementById("landowner_id").value; 
			var landowner_name=document.getElementById("landowner_name").value;
			var landowner_url=document.getElementById("landowner_url").value;
			var lb_id=document.getElementById("lb_id").value;
			var state_id=document.getElementById("state_id").value; 
			var checkValidation=emptyValidation('landowner_id~landowner_name');
	
		if(checkValidation==true) {
			requestInfo('showLandowner.php?mode=save_new&landowner_id='+'&landowner_name='+landowner_name+'&landowner_url='+landowner_url+'&lb_id='+lb_id+'&state_id='+state_id,'showLandowner','');
		} 
	}
	
	function update_data() {
			var prev_landowner_id=document.getElementById("prev_landowner_id").value;
			var landowner_id=document.getElementById("landowner_id").value; 
			var landowner_name=document.getElementById("landowner_name").value;
			var landowner_url=document.getElementById("landowner_url").value;
			var lb_id=document.getElementById("lb_id").value;
			var state_id=document.getElementById("state_id").value; 
			var checkValidation=emptyValidation('landowner_id~landowner_name');
	
		if(checkValidation==true) {
			requestInfo('showLandowner.php?mode=update_data&landowner_id='+landowner_id+'&landowner_name='+landowner_name+'&landowner_url='+landowner_url+'&lb_id='+lb_id+'&state_id='+state_id+'&prev_landowner_id='+prev_landowner_id,'showLandowner','');
		} 
	}
	
	
function confirmLink(theLink)
{
   
    var is_confirmed = confirm('Are you sure to delete this record?\n\nThis will permanently delete the Record!');
    if (is_confirmed) {
        theLink.href += '';
    }

    return is_confirmed;
}