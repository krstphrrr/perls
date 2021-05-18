function getHTTPObject() {  var xmlhttp;  if(window.XMLHttpRequest){    xmlhttp = new XMLHttpRequest();  }  else if (window.ActiveXObject){    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	if (!xmlhttp){        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }}  return xmlhttp; }
var http = getHTTPObject();  
// We create the HTTP Object

/*
	Funtion Name=requestInfo 
	Param = url >> Url to call : account_num = Passing div account_num for multiple use ~ as a seprator for eg. div1~div2 :
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
	Desc = This function is used to valaccount_numation for the empty field 
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

function init_table(mode,account_num)
{
	//alert(mode);
	if (mode == '')
	{
		requestInfo('showAccounts.php?mode=list','showAccounts','');
	}
	else
	{
		requestInfo('showAccounts.php?mode='+mode+'&account_num='+account_num,'showAccounts','');
	}
}
	
	function save_data() 
	{
		 
				 
			var username=document.getElementById("username").value;
			var password=document.getElementById("password").value;
			var first_name=document.getElementById("first_name").value;
			var last_name=document.getElementById("last_name").value;
			var phone_num=document.getElementById("phone_num").value;
			var address1=document.getElementById("address1").value;
			var address2=document.getElementById("address2").value;
			var city=document.getElementById("city").value;
			var state_id=document.getElementById("state_id").value;
			var zip=document.getElementById("zip").value;
			var email=document.getElementById("email").value;
			var website=document.getElementById("website").value; 			
			var access_level=document.getElementById("access_level").value; 
			var affiliation=document.getElementById("affiliation").value;
			var institution=document.getElementById("institution").value;
			var affil_role=document.getElementById("affil_role").value;
			var comments=document.getElementById("comments").value;
			
			
			 var checkValidation=emptyValidation('username~password');
	
	 if(checkValidation==true) 
	 {
		var url="showAccounts.php"
		url=url+"?mode=save_new" 
		url=url+"&username="+username
		url=url+"&password="+password
		url=url+"&first_name="+first_name
		url=url+"&last_name="+last_name
		url=url+"&phone_num="+phone_num
		url=url+"&address1="+address1
		url=url+"&address2="+address2
		url=url+"&city="+city
		url=url+"&state_id="+state_id
		url=url+"&zip="+zip
		url=url+"&email="+email
		url=url+"&website="+website
		url=url+"&access_level="+access_level
		url=url+"&affiliation="+affiliation
		url=url+"&institution="+institution
		url=url+"&affil_role="+affil_role
		url=url+"&comments="+comments
		url=url+"&sid="+Math.random()
		//prompt("",url);
		requestInfo(url,'showAccounts','');
	 }  
}
	
function update_data(account_num_update) 
{  
		
 /*
	var username_update="";
	var password_update="";
	var first_name_update="";
	var last_name_update="";
	var phone_num_update="";
	var email_update="";
	var website_update="";
	var access_level_update=""; 
	 */ 
	 	
	 
	
	 
	var username_update=document.getElementById("username").value;
	var password_update=document.getElementById("password").value;
	var first_name_update=document.getElementById("first_name").value;
	var last_name_update=document.getElementById("last_name").value;
	var phone_num_update=document.getElementById("phone_num").value;
	var address1_update=document.getElementById("address1").value;
	var address2_update=document.getElementById("address2").value;
	var city_update=document.getElementById("city").value;
	var state_id_update=document.getElementById("state_id").value;
	var zip_update=document.getElementById("zip").value;
	var email_update=document.getElementById("email").value;
	var website_update=document.getElementById("website").value;
	var access_level_update=document.getElementById("access_level").value; 
	var affiliation=document.getElementById("affiliation").value;
	var institution=document.getElementById("institution").value;
	var affil_role=document.getElementById("affil_role").value;
	var comments=document.getElementById("comments").value;
	 var checkValidation=emptyValidation('username~password'); 
	
	 if(checkValidation==true) 
	 {
		
		var url2="showAccounts.php";
		url2=url2+"?mode=update_data";
		url2=url2+"&account_num="+account_num_update;
		url2=url2+"&username="+username_update;
		url2=url2+"&password="+password_update;
		url2=url2+"&first_name="+first_name_update;
		url2=url2+"&last_name="+last_name_update;
		url2=url2+"&phone_num="+phone_num_update;
		url2=url2+"&address1="+address1_update;
		url2=url2+"&address2="+address2_update;
		url2=url2+"&city="+city_update;
		url2=url2+"&state_id="+state_id_update;
		url2=url2+"&zip="+zip_update;
		url2=url2+"&email="+email_update;
		url2=url2+"&website="+website_update;
		url2=url2+"&access_level="+access_level_update;
		url2=url2+"&affiliation="+affiliation
		url2=url2+"&institution="+institution
		url2=url2+"&affil_role="+affil_role
		url2=url2+"&comments="+comments
		url2=url2+"&sid="+Math.random();
		//alert(url2);
		
		requestInfo(url2,'showAccounts','');
	 }    
}
	
	
function confirmLink(theLink)
{
   
    var is_confirmed = confirm('Are you sure to delete this record?\n\nThis will permanently delete the Record!');
    if (is_confirmed) 
	{
        theLink.href += '';
    }

    return is_confirmed;
}
 