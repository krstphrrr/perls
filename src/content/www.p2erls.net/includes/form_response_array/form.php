<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>mootools demos - Ajax.Form</title>
	 

	
	<link rel="stylesheet" type="text/css" href="response.css" />
	<script type="text/javascript" src="mootools.js"></script>
	<script type="text/javascript" src="response.js"></script> 
	 
	<script type="text/javascript">
		window.addEvent('domready', function(){
			$('myForm').addEvent('submit', function(e) {
				/**
				 * Prevent the submit event
				 */
				new Event(e).stop();
			
				/**
				 * This empties the log and shows the spinning indicator
				 */
				var log = $('log_res').empty().addClass('ajax-loading');
			
				/**
				 * send takes care of encoding and returns the Ajax instance.
				 * onComplete removes the spinner from the log.
				 */
				this.send({
					update: log,
					onComplete: function() {
						log.removeClass('ajax-loading');
					}
				});
			});
		}); 
	</script>
	
</head>

<body>

 
 
				 

<form id="myForm" action="ajax_form.php" method="get" name="myForm">
	<div id="form_box">
		<div>
			<p>
				First Name:
			</p><input type="text" name="first_name" value="John" />
		</div>
		<div>
			<p>
				Last Name:
			</p><input type="text" name="last_name" value="Q" />

		</div>
		<div>
			<p>
				E-Mail:
			</p><input type="text" name="e_mail" value="john.q@mootools.net" />
		</div>
		<div>
			<p>
				MooTooler:
			</p><input type="checkbox" name="mootooler" value="yes" checked="checked" />

		</div>
		<div>
			<p>
				New to Mootools:
			</p><select name="new">
				<option value="yes" selected="selected">
					yes
				</option>
				<option value="no">
					no
				</option>

			</select>
		</div>
		<div class="hr">
			<!-- spanner -->
		</div><input type="submit" name="button" id="submitter" /> <span class="clr">
		<!-- spanner --></span>
	</div>
</form>
<div id="log">

	<h3>
		Ajax Response
	</h3>
	<div id="log_res">
		<!-- spanner -->
	</div>
</div><span class="clr"><!-- spanner --></span>			 
  

</body>
</html>