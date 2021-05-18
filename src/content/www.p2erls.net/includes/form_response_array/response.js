
window.addEvent('domready', function(){
	var divs = $$(['docs', 'js', 'html', 'css']);
	divs.each(function(div){
		var link = $(div.id + 'code');
		div.setStyle('display', 'none');
		link.addEvent('click', function(e){
			e = new Event(e);
			divs.each(function(other){
				if (other != div) other.setStyle('display', 'none');
			});
			div.setStyle('display', (div.getStyle('display') == 'block') ? 'none' : 'block');
			e.stop();
		});
	});
});

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

