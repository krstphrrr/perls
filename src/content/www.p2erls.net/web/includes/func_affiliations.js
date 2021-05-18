function toggle_affiliation()
{
	if(document.getElementById("institution_drop").value == "other")
	{	
		document.getElementById("other_affil").style.display = "block"; 
		document.getElementById("institution_drop").name = "";
		document.getElementById("institution_other").name = "institution";
	}
	else
	{
		document.getElementById("other_affil").style.display = "none"; 
		document.getElementById("institution_other").name = "";
		document.getElementById("institution_drop").name = "institution";
	}
}
function toggle_affiliation2()
{ 
	if(document.wrapper.elements[0].value == "other")
	{	
		document.wrapper.elements[1].style.display = "block"; 
		document.wrapper.elements[1].id = "institution";
		document.wrapper.elements[0].id = "";
		
	}
	else
	{
		document.wrapper.elements[1].style.display = "none"; 
		document.wrapper.elements[1].id = "";
		document.wrapper.elements[0].id = "institution";
	}
}

function toggle_affiliationma()
{ 
	if(document.my_account.elements[8].value == "other")
	{	
		document.my_account.elements[9].style.display = "block"; 
		document.my_account.elements[9].name = "institution";
		document.my_account.elements[8].name = "";
		
	}
	else
	{
		document.my_account.elements[9].style.display = "none"; 
		document.my_account.elements[9].name = "";
		document.my_account.elements[8].name = "institution";
	}
}