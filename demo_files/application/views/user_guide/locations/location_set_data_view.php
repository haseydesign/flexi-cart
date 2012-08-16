<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Location Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting location data in flexi cart."/> 
	<meta name="keywords" content="setting location data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Location Session Data</h1>
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
		
			<h2>Set Location Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/location_index">Location Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_session_data">Get Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_helper_data">Get Location Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_admin">Location Admin Data</a>

			<div class="anchor_nav">
				<h6>Set Location Data to Session</h6>
				<p>
					<a href="#update_shipping_location">update_shipping_location()</a> | <a href="#update_tax_location">update_tax_location()</a> | <a href="#update_location">update_location()</a>
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
			
			<a name="update_shipping_location"></a>
			<div class="w100 frame">
				<h3 class="heading">update_shipping_location()</h3>
				
				<p>
					Updates the carts shipping locationUpdates the carts shipping location.<br/>
					The location can then be used to calculate shipping rates for specific locations and zones.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires location database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_shipping_location(locations, update_shipping, recalculate_cart)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>locations</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against location ids and names within the location table.</td>
						</tr>
						<tr>
							<td>update_shipping</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Defines whether the carts shipping option and rate should be updated.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
					
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function compares the submitted location data to the carts current shipping data, if it is different, the new shipping location is updated.</p>
					<p>The function then checks the 'update_shipping' parameter for whether the cart shipping option and rate should also be updated.</p>
					<p>If no location data is submitted, the function will use the default shipping location defined via the database or config file.</p>
				</div>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If setting location data as a location name, ensure the value is of a string data type.<br/>
						If a location name is numeric, like a zip code, the function may confuse the zip code as a location id.<br/>
						This can be prevented by type casting the location name like this <code>(string)'10101'</code>, see the example section below.
					</p>
					<hr/>
					<p>Zone names or ids cannot be set as a location, as the cart internally checks which zone the current location is related to.</p>
					<hr/>
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Not Updated:</strong>FALSE | A status message will be set.</p>
					<p><strong class="spacer_75">Updated:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example #1 : Update the location using a <strong class="uline">string</strong> or an <strong class="uline">int</strong>.</span>

$location_data = 'New York';

$this->flexi_cart->update_shipping_location($location_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the location using an <strong class="uline">array</strong> of strings and ints.</span>

<span class="comment">// Type cast numeric locations (i.e. Zip Codes) as strings to prevent the function using 
// the number as a table row id.</span>
$location_data = array(
'New York', 
(string)'10101', <span class="comment">// Zip Code example.</span>
10 <span class="comment">// Table row id example.</span>
);

$this->flexi_cart->update_shipping_location($location_data);
</pre>
			</div>

			<a name="update_tax_location"></a>
			<div class="w100 frame">
				<h3 class="heading">update_tax_location()</h3>
				
				<p>
					Updates the carts tax location.<br/>
					The location can then be used to calculate tax rates for specific locations and zones.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires location database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_tax_location(locations, update_tax, recalculate_cart)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>locations</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against location ids and names within the location table.</td>
						</tr>
						<tr>
							<td>update_tax</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Defines whether the carts tax rate should be updated.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
									
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function compares the submitted location data to the carts current tax data, if it is different, the new tax location is updated.</p>
					<p>The function then checks the 'update_tax' parameter for whether the cart tax rate should also be updated.</p>
					<p>If no location data is submitted, the function will use the default tax location defined via the database or config file.</p>
				</div>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If setting location data as a location name, ensure the value is of a string data type.<br/>
						If a location name is numeric, like a zip code, the function may confuse the zip code as a location id.<br/>
						This can be prevented by type casting the location name like this <code>(string)'10101'</code>, see the example section below.
					</p>
					<hr/>
					<p>Zone names or ids cannot be set as a location, as the cart internally checks which zone the current location is related to.</p>
					<hr/>
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Not Updated:</strong>FALSE | A status message will be set.</p>
					<p><strong class="spacer_75">Updated:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example #1 : Update the location using a <strong class="uline">string</strong> or an <strong class="uline">int</strong>.</span>

$location_data = 'New York';

$this->flexi_cart->update_tax_location($location_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the location using an <strong class="uline">array</strong> of strings and ints.</span>

<span class="comment">// Type cast numeric locations (i.e. Zip Codes) as strings to prevent the function using 
// the number as a table row id.</span>
$location_data = array(
'New York', 
(string)'10101', <span class="comment">// Zip Code example.</span>
10 <span class="comment">// Table row id example.</span>
);

$this->flexi_cart->update_tax_location($location_data);
</pre>
			</div>

			<a name="update_location"></a>
			<div class="w100 frame">
				<h3 class="heading">update_location()</h3>
				
				<p>
					Updates the carts shipping and tax data to the same location.<br/>
					The location can then be used to calculate shipping and tax rates for specific locations and zones.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires location database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_location(locations, update_dependents, recalculate_cart)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>locations</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against location ids and names within the location table.</td>
						</tr>
						<tr>
							<td>update_dependents</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Defines whether the carts shipping option and tax rate should be updated.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
									
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function compares the submitted location data to the carts current shipping and tax data, if it is different, the new location is updated.</p>
					<p>The function then checks the 'update_tax' parameter for whether the cart tax rate should also be updated.</p>
					<p>If no location data is submitted, the function will use the default shipping and tax locations defined via the database or config file.</p>
				</div>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If setting location data as a location name, ensure the value is of a string data type.<br/>
						If a location name is numeric, like a zip code, the function may confuse the zip code as a location id.<br/>
						This can be prevented by type casting the location name like this <code>(string)'10101'</code>, see the example section below.
					</p>
					<hr/>
					<p>Zone names or ids cannot be set as a location, as the cart internally checks which zone the current location is related to.</p>
					<hr/>
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Not Updated:</strong>FALSE | A status message will be set.</p>
					<p><strong class="spacer_75">Updated:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example #1 : Update the location using a <strong class="uline">string</strong> or an <strong class="uline">int</strong>.</span>

$location_data = 'New York';

$this->flexi_cart->update_location($location_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the location using an <strong class="uline">array</strong> of strings and ints.</span>

<span class="comment">// Type cast numeric locations (i.e. Zip Codes) as strings to prevent the function using 
// the number as a table row id.</span>
$location_data = array(
'New York', 
(string)'10101', <span class="comment">// Zip Code example.</span>
10 <span class="comment">// Table row id example.</span>
);

$this->flexi_cart->update_location($location_data);
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