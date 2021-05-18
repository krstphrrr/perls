var myHost = ""; 

var docroot = "http://www.p2erls.net/web/";	



		function processForm(){
			dojo.style(dojo.byId('inputField'),"display","none");
			dojo.style(dojo.byId('progressField'),"display","inline"); 
			dojo.byId('status').innerHTML = "Uploading ..."; 

			dojo.io.iframe.send({
				url:"insert_pdf.php",
				method: "post",
				handleAs: "text",
				form: dojo.byId('add_pdf_form'),
				handle: function(data,ioArgs){
					var transmit = dojo.fromJson(data);
					if (transmit.status == "success"){
						dojo.style(dojo.byId('inputField'),"display","inline");
						dojo.byId('inputField').value = '';
						dojo.style(dojo.byId('progressField'),"display","none"); 
						dojo.byId('uploadedFiles').innerHTML += "success: File: " + transmit.details.name + " size: " + transmit.details.size +"<br>"; 
						dojo.byId('status').innerHTML = "File: "; 			
					}else{
						dojo.style(dojo.byId('inputField'),"display","inline");
						dojo.style(dojo.byId('inputField'),"display","none"); 
						dojo.byId('status').innerHTML = "Error, try again: "; 
					}	
				}
			});

		}	
		
		function process_updateForm(){
			dojo.style(dojo.byId('inputField'),"display","none");
			dojo.style(dojo.byId('progressField'),"display","inline"); 
			dojo.byId('status').innerHTML = "Uploading ..."; 

			dojo.io.iframe.send({
				url:"updated_photo.php",
				method: "post",
				handleAs: "text",
				form: dojo.byId('add_pdf_form'),
				handle: function(data,ioArgs){
					var transmit = dojo.fromJson(data);
					if (transmit.status == "success"){
						dojo.style(dojo.byId('inputField'),"display","inline");
						dojo.byId('inputField').value = '';
						dojo.style(dojo.byId('progressField'),"display","none"); 
						dojo.byId('uploadedFiles').innerHTML += "success: File: " + transmit.details.name + " size: " + transmit.details.size +"<br>"; 
						dojo.byId('status').innerHTML = "File: "; 			
					}else{
						dojo.style(dojo.byId('inputField'),"display","inline");
						dojo.style(dojo.byId('inputField'),"display","none"); 
						dojo.byId('status').innerHTML = "Error, try again: "; 
					}	
				}
			
			});
location.reload(true);
refresh_preview();
		}	

function GetXmlHttpObject(){ var xmlHttp=null; try { xmlHttp=new XMLHttpRequest(); } catch (e) { try  { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } } return xmlHttp; }

var xmlHttp;

function refresh_preview()
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	

	var site_id = document.getElementById("site_id").value;
	//var num = document.getElementById(floorplan_image).value;
	if (site_id != '')
	{

		var url = "http://www.p2erls.net/web/restricted/includes/pdf_prev_servlet.php"; 
		url	= url+"?site_id="+site_id;
		url = url+"&sid="+Math.random();
		//prompt("",url);
		
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.readyState == 4)
			{ 
				var result = xmlHttp.responseText;
				//prompt("",result);
				if(result != '')
				{
					document.getElementById("preview").innerHTML = result;
				}
				else
				{
					document.getElementById("preview").innerHTML = "No Picture Available";
					return;
				}
				
						
			}
		}
		 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	else
	{
		document.getElementById("preview").innerHTML = "";
		return;
	}
}


