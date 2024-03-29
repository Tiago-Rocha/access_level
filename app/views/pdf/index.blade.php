@extends('layouts.scaffold')

@section('main')

<html dir="ltr" lang="en" class="js"><head><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width">

<title>sprSimple Invoice</title>

<link rel="stylesheet" href="reset.css" media="screen">
<link rel="stylesheet" href="style.css" media="screen">

<!-- give life to HTML5 objects in IE -->
<!--[if lte IE 8]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- js HTML class -->
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

</head>
<body>
<!-- begin markup -->



<div id="invoice" class="new">


	<div class="this-is">
		<strong>Invoice</strong>
	</div><!-- invoice headline -->


	<header id="header">
		<div class="invoice-intro">
			<h1>The Romulan Empire</h1>
			<p>Building a Better Tomorrow Through Your Destruction</p>
		</div>

		<dl class="invoice-meta">
			<dt class="invoice-number">Invoice #</dt>
			<dd>6859</dd>
			<dt class="invoice-date">Date of Invoice</dt>
			<dd>01-24-2012</dd>
			<dt class="invoice-due">Due Date</dt>
			<dd>02-10-2012</dd>
		</dl>
	</header>
	<!-- e: invoice header -->


	<section id="parties">

		<div class="invoice-to">
			<h2>Invoice To:</h2>
			<div id="hcard-Hiram-Roth" class="vcard">
				<a class="url fn" href="http://memory-alpha.org">Hiram Roth</a>
				<div class="org">United Federation of Planets</div>
				<a class="email" href="mailto:president.roth@ufop.uni">president.roth@ufop.uni</a>
				
				<div class="adr">
					<div class="street-address">2269 Elba Lane</div>
					<span class="locality">Paris</span>
					<span class="country-name">France</span>
				</div>

				<div class="tel">888-555-2311</div>
			</div><!-- e: vcard -->
		</div><!-- e invoice-to -->


		<div class="invoice-from">
			<h2>Invoice From:</h2>
			<div id="hcard-Admiral-Valdore" class="vcard">
				<a class="url fn" href="http://memory-alpha.org">Admiral Valdore</a>
				<div class="org">Romulan Empire</div>
				<a class="email" href="mailto:admiral.valdore@theempire.uni">admiral.valdore@theempire.uni</a>
				
				<div class="adr">
					<div class="street-address">5151 Pardek Memorial Way</div>
					<span class="locality">Krocton Segment</span>
					<span class="country-name">Romulus</span>
				</div>

				<div class="tel">000-555-9988</div>
			</div><!-- e: vcard -->
		</div><!-- e invoice-from -->


		<div class="invoice-status">
			<h3>Invoice Status</h3>
			<strong>Invoice is <em>Unpaid</em></strong>
		</div><!-- e: invoice-status -->

	</section><!-- e: invoice partis -->


	<section class="invoice-financials">

		<div class="invoice-items">
			<table>
				<caption>Your Invoice</caption>
				<thead>
					<tr>
						<th>Item &amp; Description</th>
						<th>Quantity</th>
						<th>Price (GPL)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Romulan Warbird</th>
						<td>1</td>
						<td>$36,000</td>
					</tr>
					<tr>
						<th>Romulan Troops</th>
						<td>10</td>
						<td>$7,650</td>
					</tr>
					<tr>
						<th>Kestrel-class Shuttle</th>
						<td>1</td>
						<td>$10,220</td>
					</tr>
					<tr>
						<th>Clocking Device</th>
						<td>1</td>
						<td>$50,000</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">Amounts in bars of Gold Pressed Latinum</td>
					</tr>
				</tfoot>
			</table>
		</div><!-- e: invoice items -->


		<div class="invoice-totals">
			<table>
				<caption>Totals:</caption>
				<tbody>
					<tr>
						<th>Subtotal:</th>
						<td></td>
						<td>$103,850</td>
					</tr>
					<tr>
						<th>Tax:</th>
						<td>5%</td>
						<td>$5,192</td>
					</tr>
					<tr>
						<th>Total:</th>
						<td></td>
						<td>$109,042</td>
					</tr>
				</tbody>
			</table>

			<div class="invoice-pay">
				<h5>Pay with...</h5>
				<ul>
					<li>
						<a href="#" class="gcheckout">Checkout with Google</a>
					</li>
					<li>
						<a href="#" class="acheckout">Checkout with Amazon</a>
					</li>
				</ul>
			</div>
		</div><!-- e: invoice totals -->


		<div class="invoice-notes">
			<h6>Notes &amp; Information:</h6>
			<p>This invoice contains a incomplete list of items destroyed by the Federation ship Enterprise on Startdate 5401.6 in an unprovked attacked on a peaceful &amp; wholly scientific mission to Outpost 775.</p>
			<p>The Romulan people demand immediate compensation for the loss of their Warbird, Shuttle, Cloaking Device, and to a lesser extent thier troops.</p>
			<p>Failure to provide adequate compensation for the above losses will result in an immediate increase in Neutral Zone patrols &amp; a formal complaint will be filed in the form of increased aggresion on human populated worlds within the neutral zone.</p>
		</div><!-- e: invoice-notes -->

	</section><!-- e: invoice financials -->


	<footer id="footer">
		<p>
			Crafted with Romulan State Required Levels of Attention by <a href="http://sprresponsive.com">sprResponsive</a>.
		</p>
	</footer>


</div><!-- e: invoice -->



</body></html>
@stop