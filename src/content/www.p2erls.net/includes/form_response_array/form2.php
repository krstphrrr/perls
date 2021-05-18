<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>mootools demos - Ajax.Form</title>
	
	 
	
	<link rel="stylesheet" type="text/css" media="screen" href="response.css" />
	
	<script type="text/javascript" src="https://demos.mootools.net/demos/mootools.svn.js"></script>
	<script type="text/javascript" src="https://demos.mootools.net/scripts/demos.js"></script>
	
	<link rel="shortcut icon" href="https://demos.mootools.net/icon.png?v=1" type="image/x-icon" />
	
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

	
<div id="header">
	<div id="header-inside">
		<div id="logo">
			<h1><a href="/"><span>mootools</span></a></h1>
			<p>the compact javascript framework</p>
		</div>
		<p id="mediatemple"><span>in partnership with</span> <a href="https://mediatemple.net"><span>mediatemple</span></a></p>

		<ul id="menu">
			<li><a href="https://mootools.net">home</a></li>
			<li><a href="https://mootools.net/download">download</a></li>
			<li><a href="https://docs.mootools.net">docs</a></li>
			<li><a href="https://blog.mootools.net">blog</a></li>
			<li><a class="selected" href="https://demos.mootools.net">demos</a></li>

			<li><a href="https://dev.mootools.net">code</a></li>
		</ul>
	</div>
</div>


<div id="wrapper">
	<div id="container">
		<ul id="list">
		<li class="home"><a href="/">READ HERE FIRST</a></li><li><a href="/Accordion">Accordion</a></li><li><a href="/Ajax">Ajax</a></li><li><a href="/Ajax.Advanced">Ajax.Advanced</a></li><li><a href="/Ajax.Form"class="selected">Ajax.Form</a></li><li><a href="/Asset.css">Asset.css</a></li><li><a href="/Asset.images">Asset.images</a></li><li><a href="/Chain">Chain</a></li><li><a href="/Chain.Periodical">Chain.Periodical</a></li><li><a href="/DomReadyVS.Load">DomReadyVS.Load</a></li><li><a href="/Drag.Absolutely">Drag.Absolutely</a></li><li><a href="/Drag.Cart">Drag.Cart</a></li><li><a href="/DragDrop">DragDrop</a></li><li><a href="/Element.Event">Element.Event</a></li><li><a href="/Fx.Elements">Fx.Elements</a></li><li><a href="/Fx.Morph">Fx.Morph</a></li><li><a href="/Fx.Scroll">Fx.Scroll</a></li><li><a href="/Fx.Slide">Fx.Slide</a></li><li><a href="/Fx.Styles">Fx.Styles</a></li><li><a href="/Fx.Transitions">Fx.Transitions</a></li><li><a href="/Group">Group</a></li><li><a href="/Hash.Cookie">Hash.Cookie</a></li><li><a href="/Json.Remote">Json.Remote</a></li><li><a href="/Mousewheel">Mousewheel</a></li><li><a href="/MousewheelCustom">MousewheelCustom</a></li><li><a href="/Periodical">Periodical</a></li><li><a href="/Resizable">Resizable</a></li><li><a href="/Scroller">Scroller</a></li><li><a href="/Slider">Slider</a></li><li><a href="/Sortables">Sortables</a></li><li><a href="/Tips">Tips</a></li>		</ul>

		<div id="content">
			<h2>Ajax.Form</h2>
			<p id="info">
				Send a Form with Ajax.			</p>
	
			<p id="sourcelinks"><a href="#" id="docscode">docs references</a><a href="#" id="jscode">js code</a> | <a href="#" id="htmlcode">html code</a> | <a href="#" id="csscode">css code</a></p>

	
			<div id="source">
	
				<div class="code" id="docs">
					<h4>References to Documentation</h4><ol><li><a href="https://docs.mootools.net/Element/Element-Event.js#Element.addEvent">Element/Element-Event.js#Element.addEvent</a></li><li><a href="https://docs.mootools.net/Remote/Ajax.js#Element.send">Remote/Ajax.js#Element.send</a></li><li><a href="https://docs.mootools.net/Native/Element.js#Element.empty">Native/Element.js#Element.empty</a></li><li><a href="https://docs.mootools.net/Native/Element.js#Element.addClass">Native/Element.js#Element.addClass</a></li></ol>				</div>
				
				<div class="code" id="js">
					<pre class="javascript">$<span class="br0">&#40;</span><span class="st0">'myForm'</span><span class="br0">&#41;</span>.<span class="me1">addEvent</span><span class="br0">&#40;</span><span class="st0">'submit'</span>, <span class="kw2">function</span><span class="br0">&#40;</span>e<span class="br0">&#41;</span> <span class="br0">&#123;</span>

	<span class="coMULTI">/**
	 * Prevent the submit event
	 */</span>
	<span class="kw2">new</span> Event<span class="br0">&#40;</span>e<span class="br0">&#41;</span>.<span class="kw3">stop</span><span class="br0">&#40;</span><span class="br0">&#41;</span>;
&nbsp;
	<span class="coMULTI">/**
	 * This empties the log and shows the spinning indicator
	 */</span>
	<span class="kw2">var</span> log = $<span class="br0">&#40;</span><span class="st0">'log_res'</span><span class="br0">&#41;</span>.<span class="me1">empty</span><span class="br0">&#40;</span><span class="br0">&#41;</span>.<span class="me1">addClass</span><span class="br0">&#40;</span><span class="st0">'ajax-loading'</span><span class="br0">&#41;</span>;

&nbsp;
	<span class="coMULTI">/**
	 * send takes care of encoding and returns the Ajax instance.
	 * onComplete removes the spinner from the log.
	 */</span>
	<span class="kw1">this</span>.<span class="me1">send</span><span class="br0">&#40;</span><span class="br0">&#123;</span>
		update: log,
		onComplete: <span class="kw2">function</span><span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="br0">&#123;</span>
			log.<span class="me1">removeClass</span><span class="br0">&#40;</span><span class="st0">'ajax-loading'</span><span class="br0">&#41;</span>;
		<span class="br0">&#125;</span>

	<span class="br0">&#125;</span><span class="br0">&#41;</span>;
<span class="br0">&#125;</span><span class="br0">&#41;</span>;</pre>				</div>
		
				<div class="code" id="html">
					<pre class="html4strict"><span class="sc2"><span class="kw2">&lt;h3&gt;</span></span>
	Send a Form with Ajax
<span class="sc2"><span class="kw2">&lt;/h3&gt;</span></span>
<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
	<span class="sc2"><span class="kw2">&lt;a</span> <span class="kw3">href</span>=<span class="st0">&quot;demos/Ajax.Form/ajax.form.phps&quot;</span><span class="kw2">&gt;</span></span>See ajax.form.phps<span class="sc2"><span class="kw2">&lt;/a&gt;</span></span>

<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span>
<span class="sc2"><span class="kw2">&lt;form</span> <span class="kw3">id</span>=<span class="st0">&quot;myForm&quot;</span> <span class="kw3">action</span>=<span class="st0">&quot;demos/Ajax.Form/ajax.form.php&quot;</span> <span class="kw3">method</span>=<span class="st0">&quot;get&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;myForm&quot;</span><span class="kw2">&gt;</span></span>

	<span class="sc2"><span class="kw2">&lt;div</span> <span class="kw3">id</span>=<span class="st0">&quot;form_box&quot;</span><span class="kw2">&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
				First Name:
			<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span><span class="sc2"><span class="kw2">&lt;input</span> <span class="kw3">type</span>=<span class="st0">&quot;text&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;first_name&quot;</span> <span class="kw3">value</span>=<span class="st0">&quot;John&quot;</span> /<span class="kw2">&gt;</span></span>

		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
				Last Name:
			<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span><span class="sc2"><span class="kw2">&lt;input</span> <span class="kw3">type</span>=<span class="st0">&quot;text&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;last_name&quot;</span> <span class="kw3">value</span>=<span class="st0">&quot;Q&quot;</span> /<span class="kw2">&gt;</span></span>

		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
				E-Mail:
			<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span><span class="sc2"><span class="kw2">&lt;input</span> <span class="kw3">type</span>=<span class="st0">&quot;text&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;e_mail&quot;</span> <span class="kw3">value</span>=<span class="st0">&quot;john.q@mootools.net&quot;</span> /<span class="kw2">&gt;</span></span>

		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
				MooTooler:
			<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span><span class="sc2"><span class="kw2">&lt;input</span> <span class="kw3">type</span>=<span class="st0">&quot;checkbox&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;mootooler&quot;</span> <span class="kw3">value</span>=<span class="st0">&quot;yes&quot;</span> <span class="kw3">checked</span>=<span class="st0">&quot;checked&quot;</span> /<span class="kw2">&gt;</span></span>

		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;p&gt;</span></span>
				New to Mootools:
			<span class="sc2"><span class="kw2">&lt;/p&gt;</span></span><span class="sc2"><span class="kw2">&lt;select</span> <span class="kw3">name</span>=<span class="st0">&quot;new&quot;</span><span class="kw2">&gt;</span></span>

				<span class="sc2"><span class="kw2">&lt;option</span> <span class="kw3">value</span>=<span class="st0">&quot;yes&quot;</span> <span class="kw3">selected</span>=<span class="st0">&quot;selected&quot;</span><span class="kw2">&gt;</span></span>
					yes
				<span class="sc2"><span class="kw2">&lt;/option&gt;</span></span>
				<span class="sc2"><span class="kw2">&lt;option</span> <span class="kw3">value</span>=<span class="st0">&quot;no&quot;</span><span class="kw2">&gt;</span></span>

					no
				<span class="sc2"><span class="kw2">&lt;/option&gt;</span></span>
			<span class="sc2"><span class="kw2">&lt;/select&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;div</span> <span class="kw3">class</span>=<span class="st0">&quot;hr&quot;</span><span class="kw2">&gt;</span></span>

			<span class="sc2"><span class="coMULTI">&lt;!-- spanner --&gt;</span></span>
		<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span><span class="sc2"><span class="kw2">&lt;input</span> <span class="kw3">type</span>=<span class="st0">&quot;submit&quot;</span> <span class="kw3">name</span>=<span class="st0">&quot;button&quot;</span> <span class="kw3">id</span>=<span class="st0">&quot;submitter&quot;</span> /<span class="kw2">&gt;</span></span> <span class="sc2"><span class="kw2">&lt;span</span> <span class="kw3">class</span>=<span class="st0">&quot;clr&quot;</span><span class="kw2">&gt;</span></span>

		<span class="sc2"><span class="coMULTI">&lt;!-- spanner --&gt;</span></span><span class="sc2"><span class="kw2">&lt;/span&gt;</span></span>
	<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>
<span class="sc2"><span class="kw2">&lt;/form&gt;</span></span>
<span class="sc2"><span class="kw2">&lt;div</span> <span class="kw3">id</span>=<span class="st0">&quot;log&quot;</span><span class="kw2">&gt;</span></span>
	<span class="sc2"><span class="kw2">&lt;h3&gt;</span></span>

		Ajax Response
	<span class="sc2"><span class="kw2">&lt;/h3&gt;</span></span>
	<span class="sc2"><span class="kw2">&lt;div</span> <span class="kw3">id</span>=<span class="st0">&quot;log_res&quot;</span><span class="kw2">&gt;</span></span>
		<span class="sc2"><span class="coMULTI">&lt;!-- spanner --&gt;</span></span>
	<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span>

<span class="sc2"><span class="kw2">&lt;/div&gt;</span></span><span class="sc2"><span class="kw2">&lt;span</span> <span class="kw3">class</span>=<span class="st0">&quot;clr&quot;</span><span class="kw2">&gt;</span></span><span class="sc2"><span class="coMULTI">&lt;!-- spanner --&gt;</span></span><span class="sc2"><span class="kw2">&lt;/span&gt;</span></span></pre>				</div>
		
				<div class="code" id="css">
					<pre class="css"><span class="re0">#form_box</span> <span class="br0">&#123;</span>
	<span class="kw1">float</span>: <span class="kw1">left</span>;
	<span class="kw1">width</span>: <span class="re3">290px</span>;
	<span class="kw1">background</span>: <span class="re0">#f8f8f8</span>;
	<span class="kw1">border</span>: <span class="re3">1px</span> <span class="kw2">solid</span> <span class="re0">#d6d6d6</span>;
	<span class="kw1">border-left-color</span>: <span class="re0">#e4e4e4</span>;
	<span class="kw1">border-top-color</span>: <span class="re0">#e4e4e4</span>;
	<span class="kw1">font-size</span>: <span class="re3">11px</span>;
	<span class="kw1">font-weight</span>: <span class="kw2">bold</span>;
	<span class="kw1">padding</span>: <span class="nu0">0</span><span class="re1"><span class="re3">.5em</span></span>;
	<span class="kw1">margin-top</span>: <span class="re3">10px</span>;
	<span class="kw1">margin-bottom</span>: <span class="re3">2px</span>;

<span class="br0">&#125;</span>
&nbsp;
<span class="re0">#form_box</span> div <span class="br0">&#123;</span>
	<span class="kw1">height</span>: <span class="re3">25px</span>;
	<span class="kw1">padding</span>: <span class="nu0">0</span><span class="re1"><span class="re3">.2em</span></span> <span class="nu0">0</span><span class="re1"><span class="re3">.5em</span></span>;

<span class="br0">&#125;</span>
&nbsp;
<span class="re0">#form_box</span> div<span class="re1">.hr</span> <span class="br0">&#123;</span>
	<span class="kw1">border-bottom</span>: <span class="re3">2px</span> <span class="kw2">solid</span> <span class="re0">#e2e2e1</span>;
	<span class="kw1">height</span>: <span class="re3">0px</span>;
	<span class="kw1">margin-top</span>: <span class="re3">0pt</span>;
	<span class="kw1">margin-bottom</span>: <span class="re3">7px</span>;

<span class="br0">&#125;</span>
&nbsp;
<span class="re0">#form_box</span> p <span class="br0">&#123;</span>
	<span class="kw1">float</span>: <span class="kw1">left</span>;
	<span class="kw1">margin</span>: <span class="re3">4px</span> <span class="re3">0pt</span>;
	<span class="kw1">width</span>: <span class="re3">120px</span>;

<span class="br0">&#125;</span>
&nbsp;
&nbsp;
<span class="re0">#log</span> <span class="br0">&#123;</span>
	<span class="kw1">float</span>: <span class="kw1">left</span>;
	<span class="kw1">padding</span>: <span class="nu0">0</span><span class="re1"><span class="re3">.5em</span></span>;
	<span class="kw1">margin-left</span>: <span class="re3">10px</span>;
	<span class="kw1">width</span>: <span class="re3">290px</span>;
	<span class="kw1">border</span>: <span class="re3">1px</span> <span class="kw2">solid</span> <span class="re0">#d6d6d6</span>;
	<span class="kw1">border-left-color</span>: <span class="re0">#e4e4e4</span>;
	<span class="kw1">border-top-color</span>: <span class="re0">#e4e4e4</span>;
	<span class="kw1">margin-top</span>: <span class="re3">10px</span>;

<span class="br0">&#125;</span>
&nbsp;
<span class="re0">#log_res</span> <span class="br0">&#123;</span>
	<span class="kw1">overflow</span>: <span class="kw2">auto</span>;
<span class="br0">&#125;</span>
&nbsp;
<span class="re0">#log_res</span><span class="re1">.ajax-loading</span> <span class="br0">&#123;</span>
	<span class="kw1">padding</span>: <span class="re3">20px</span> <span class="nu0">0</span>;
	<span class="kw1">background</span>: <span class="kw2">url</span><span class="br0">&#40;</span><span class="re4">https://demos<span class="re1">.mootools</span><span class="re1">.net</span>/demos/Group/spinner<span class="re1">.gif</span></span><span class="br0">&#41;</span> <span class="kw2">no-repeat</span> <span class="kw2">center</span>;

<span class="br0">&#125;</span></pre>				</div>
		
			</div>

			<div id="demo">
				<h3>
	Send a Form with Ajax
</h3>
<p>
	<a href="demos/Ajax.Form/ajax.form.phps">See ajax.form.phps</a>
</p>

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
</div><span class="clr"><!-- spanner --></span>			</div>
	
		</div>
		<span class="clr"></span>

	</div>
</div>


<div id="footer">
	<div id="footer-inside">
		<a href="https://mad4milk.net" class="copy"></a>
		<p>copyright &copy;2007 <a href="https://mad4milk.net">Valerio Proietti</a></p>
	</div>

</div>

</body>
</html>