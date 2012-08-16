<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Currency Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting currency data in flexi cart."/> 
	<meta name="keywords" content="setting currency data, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Setting Currency Session Data</h1>
				<p>Data is set to the cart session by using functions primarily from flexi carts standard library.</p>
				<p>The data that can be set in the cart session includes data of items added to the cart, user localisation data and cart configuration settings.</p>
				<p>
					Since many of flexi carts features can be set using either manually submitted data, or data retrieved from the database; there are often two versions of a function to set session data. Functions that update session data using the database are prefixed with the function name 'update_xxx', whilst functions that use manually set data are prefixed with the name 'set_xxx'.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Set Currency Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/currency_index">Currency Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_config">Currency Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_session_data">Get Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_helper_data">Get Currency Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_admin">Currency Admin Data</a>

			<div class="anchor_nav">
				<h6>Set Currency Data to Session</h6>
				<p>
					<a href="#update_currency">update_currency()</a> | <a href="#set_currency">set_currency()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Setting Session Data Functions</h3>
				
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p><strong>Name</strong>: The name of the function (method).</p>
					<p>
						<strong>Data Type</strong>: The data type that is expected by the function.
						<ul>
							<li><em>bool</em> : Requires a boolean value of 'TRUE' or 'FALSE'.</li>
							<li><em>string</em> : Requires a textual value.</li>
							<li><em>int</em> : Requires a numeric value. It does not matter whether the value is an integer, float, decimal etc.</li>
							<li><em>array</em> : Requires an array.</li>
						</ul>
					</p>
					<p><strong>Required</strong>: Defines whether the parameter requires a value to be submitted.</p>
					<p><strong>Default</strong>: Defines the default parameter value that is used if no other value is submitted.</p>
				</div>
			</div>

			<a name="update_currency"></a>
			<div class="w100 frame">
				<h3 class="heading">update_currency()</h3>
				
				<p>Looks-up the currency database table and tries to match a currency with the submitted currency id or name.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires currency database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_currency(currency_identifier)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>currency_identifier</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>The id or name of the currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function will check if the 'currency_identifier' is numeric or a string and run an SQL SELECT query filtered to match the identifier either with a currency id or name.</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example #1 : Update the currency using a currency id.</span>

$currency_identifier = 101;

$this->flexi_cart->update_currency($currency_identifier);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the currency using a currency name.</span>

$currency_identifier = 'GBP';

$this->flexi_cart->update_currency($currency_identifier);
</pre>
			</div>

			<a name="set_currency"></a>
			<div class="w100 frame">
				<h3 class="heading">set_currency()</h3>
				
				<p>Manually sets the cart currency without querying a database table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_currency(currency_data)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>currency_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the data that is to update the carts currency data.<br/>
								See the documentation and examples below for further information.									
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function loops through the 'currency_data' array and sets any data from the following array keys to the cart currency data.</p>
					<p>The valid array keys are 'name', 'exchange_rate', 'symbol', 'symbol_suffix', 'thousand_separator' and 'decimal_separator'.</p>
					<ul>
						<li><strong>'name'</strong> - The name of the currency.</li>
						<li><strong>'exchange_rate'</strong> - The exchange rate between the currency and the carts internal currency.</li>
						<li><strong>'symbol'</strong> - The currency sybmol.</li>
						<li><strong>'symbol_suffix'</strong> - Define whether to suffix the currency symbol rather than prefix it.</li>
						<li><strong>'thousand_separator'</strong> - Define the 'thousand' separator character.</li>
						<li><strong>'decimal_separator'</strong> - Define the 'decimal' separator character.</li>
					</ul>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$currency_data = array(
'name' => 'example_name',
'exchange_rate' => 1.65,
'symbol' => '&pound;',
'symbol_suffix' => FALSE,
'thousand_separator' => ',',
'decimal_separator' => '.'
);

$this->flexi_cart->set_currency($currency_data);
</pre>
			</div>
			
		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>