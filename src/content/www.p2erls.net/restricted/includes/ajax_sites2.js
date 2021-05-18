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
	
	function update_data(prev_site_id) {
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