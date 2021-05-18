/*********************************************************************
				Version 4.0 --> modified Jun 6, 2007
*********************************************************************/

// This is the function you would use to require certain fields to be filled in when submitting a form.
// PLEASE NOTE: If you wish to have another field required, copy/paste the if statement for one of the
// other fields (e.g. first_name) and change the information to match the appropriate field.

function validate(form) {
	var e = form.elements, m = '';
	
	if(!e['first_name'].value) {
		m += '- First name is required.\n\n';
	}
	if(!e['last_name'].value) {
		m += '- Last name is required.\n\n';
	}
	if(!e['email'].value) {
		m += '- Email is required.\n\n';
	} 
	if(e['email'].value) {
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '- E-Mail address is not valid.\n\n';
		}
	}
	if(!e['comments'].value) {
		m += '- Questions/Comments is required.\n\n';
	}
	if(!e['s_image'].value) {
		m += '- Security Code is required.\n\n';
	}
	if(e['s_image'].value) {
		var str2 = e['s_image'].value;
		var reg2 = new RegExp("([a-z]{4})");
	
		if (!reg2.test(str2)) {
			m += '- Security Code must have 4 characters.\n\n';
		}
	}
	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function validate_admin(form) {
	var e = form.elements, m = '';
		
	if(!e['email'].value) {
		m += '- Email is required.\n\n';
	} 
	if(e['email'].value) {
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '- E-Mail address is not valid.\n\n';
		}
	}
 	
	if(!e['username'].value) {
		m += '- Username is required.\n\n';
	} 

	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
}

function validate_login(form) 
{
	var e = form.elements, m = '';
		
	if(!e['email'].value) 
	{
		m += '- Email is required.\n\n';
	} 
	if(e['email'].value) 
	{
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '- E-Mail address is not valid.\n\n';
		}
	}
 	
	if(!e['password'].value) {
		m += '- Password is required.\n\n';
	} 

	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
}

function validate_forgot_password(form) 
{
	var e = form.elements, m = '';
		
	if(!e['email'].value) 
	{
		m += '- Email is required.\n\n';
	} 
	
	if(e['email'].value) 
	{
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '- E-Mail address is not valid.\n\n';
		}
	}
 	
	if(m) 
	{
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	
	return true;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function validate_registration(form) {
	var e = form.elements, m = '';
	
	if(!e['first_name'].value) {
		m += '- First name is required.\n\n';
	}
	if(!e['last_name'].value) {
		m += '- Last name is required.\n\n';
	}
	if(!e['email'].value) {
		m += '- Email is required.\n\n';
	} 
	if(e['email'].value) {
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '- E-Mail address is not valid.\n\n';
		}
	}
	if(!e['username'].value) {
		m += '- Username is required.\n\n';
	}
	if(!e['password'].value) {
		m += '- Password is required.\n\n';
	}
	if(!e['confirm_password'].value) {
		m += '- Confirm password is required.\n\n';
	}
	if(e['password'].value != e['confirm_password'].value) {
		m += '- Confirm password must match password.\n\n';
	}
	if(!e['s_image'].value) {
		m += '- Security Code is required.\n\n';
	}
	if(e['s_image'].value) {
		var str2 = e['s_image'].value;
		var reg2 = new RegExp("([a-z]{4})");
	
		if (!reg2.test(str2)) {
			m += '- Security Code must have 4 characters.\n\n';
		}
	}
	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
}

function validate_update_account(form) {
	var e = form.elements, m = '';
	 
	if(!e['first_name'].value) {
		m += '- First name is required.\n';
	}
	if(!e['last_name'].value) {
		m += '- Last name is required.\n';
	} 
	
	if(!e['email'].value) {
		m += '<p>&bull; E-Mail address</p>';
	}
	if(e['email'].value) {
		var str = e['email'].value;
		var reg = new RegExp("([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})");
				
		if (!reg.test(str))
		{
			m += '<p>&bull; E-Mail address is not valid.</p>';
		}
	}
	
	if(!e['username'].value) {
		m += '- Username is required.\n';
	}
	if(!e['password'].value) {
		m += '- Password is required.\n';
	}
	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
} 

//
function validate_top_login(form) 
{
	var e = form.elements, m = '';
	 
	if(!e['username'].value) {
		m += '- Username is required.\n';
	}
	if(!e['password'].value) {
		m += '- Password is required.\n';
	} 
	if(m) {
		alert('The following error(s) occurred:\n\n' + m);
		return false;
	}
	return true;
	
}
