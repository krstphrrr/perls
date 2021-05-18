function init_table()
{
	requestInfo('showEcosystems.php?mode=list','showEcosystems','');
}
	
function save_data()
{
	var ecosystem_id=document.getElementById("ecosystem_id").value; 
				var ecosystem_name=document.getElementById("ecosystem_name").value;
				var ecosystem_description=document.getElementById("ecosystem_description").value;
				var checkValidation=emptyValidation('ecosystem_id~ecosystem_name~ecosystem_description');
		
				if (checkValidation == true)
				{
					requestInfo('showEcosystems.php?mode=save_new&ecosystem_id='+ecosystem_id+'&ecosystem_name='+ecosystem_name+'&ecosystem_description='+ecosystem_description,'showEcosystems','');
				}
}
	
function update_data()
{
	var prev_ecosystem_id=document.getElementById("prev_ecosystem_id").value;
	var ecosystem_id=document.getElementById("ecosystem_id").value;
	var ecosystem_name=document.getElementById("ecosystem_name").value;
	var ecosystem_description=document.getElementById("ecosystem_description").value; 
	var checkValidation=emptyValidation('ecosystem_id~ecosystem_name~ecosystem_description');

	if(checkValidation==true)
	{
			requestInfo('showEcosystems.php?mode=update_data&ecosystem_id='+ecosystem_id+'&ecosystem_name='+ecosystem_name+'&ecosystem_description='+ecosystem_description+'&prev_ecosystem_id='+prev_ecosystem_id,'showEcosystems','');
		} 
	} 
	