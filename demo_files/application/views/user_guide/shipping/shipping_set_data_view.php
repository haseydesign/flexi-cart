<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Shipping Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting shipping data in flexi cart."/> 
	<meta name="keywords" content="setting shipping data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Shipping Session Data</h1>
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
					
			<h2>Set Shipping Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_session_data">Get Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data">Get Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_admin">Shipping Admin Data</a>

			<div class="anchor_nav">
				<h6>Set Shipping Data to Session</h6>
				<p>
					<a href="#update_shipping">update_shipping()</a> | <a href="#set_shipping">set_shipping()</a>
				</p>
				<h6>Set Shipping Location Data to Session</h6>
				<p>
					<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_shipping_location">update_shipping_location()</a>
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
			
			<a name="update_shipping"></a>
			<div class="w100 frame">
				<h3 class="heading">update_shipping()</h3>
				
				<p>Looks-up the shipping database table and tries to match shipping rate options with the current shipping id and shipping location.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the shipping database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_shipping(shipping_id, location, recalculate_cart)</code>
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
							<td>shipping_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>The shipping option id that the cart will use to try and to match a suitable shipping rate tier against the current cart totals.</td>
						</tr>
						<tr>
							<td>location</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Can be either a string, int, or an array of values matching either the id or name of locations in the location table.<br/>
								The data will be used to update the carts current shipping location.
							</td>
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
					<p>If location data is submitted, the function will first update the carts current shipping location.</p>
					<p>
						The function will then filter the shipping id against all shipping options that match the current shipping location, ordering them by the most specific location first.<br/>
						On success, it will then check the current weight and total value of the cart against the shipping rate tiers, when a match is found, the shipping rate is applied to the cart.
					</p>
					<p>If no shipping rates can be found, the function will disregard the shipping id and apply the first shipping option that matches the current location and cart weight and value.</p>
					<p>If no shipping option can still be matched, the function will fall back to the default shipping option defined via the database and then the default shipping values set via the config file.</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If setting location data as a location name, ensure the value is of a string data type.<br/>
						If a location name is numeric, like a zip code, the function may confuse the zip code as a location id.<br/>
						This can be prevented by type casting the location name like this <code>(string)'10101'</code>, see the example section below.
					</p>
					<p>
						This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example #1 : Update the shipping option using only a shipping id, no location data.</span>

$shipping_id = $this->input->post('shipping_id');

$this->flexi_cart->update_shipping($shipping_id);
</pre>

<pre>
<span class="comment bold">// Example #2 : Update the shipping option using a shipping id, and update the shipping location using a <strong class="uline">string</strong>.</span>

$shipping_id = $this->input->post('shipping_id');

$location_data = 'New York';

$this->flexi_cart->update_shipping($shipping_id, $location_data);
</pre>
<pre>
<span class="comment bold">// Example #3 : Update the shipping option using a shipping id, and update the shipping location using a <strong class="uline">array</strong>.</span>

$shipping_id = $this->input->post('shipping_id');

<span class="comment">// Type cast numeric locations (i.e. Zip Codes) as strings to prevent the function using 
// the number as a table row id.</span>
$location_data = array(
	'New York', 
	(string)'10101', <span class="comment">// Example of type casting a zip code (Must be a string)</span>
	10 <span class="comment">// Example of setting a table row id (Must be an int)</span>
);

$this->flexi_cart->update_shipping($shipping_id, $location_data);
</pre>
			</div>

			<a name="set_shipping"></a>
			<div class="w100 frame">
				<h3 class="heading">set_shipping()</h3>
				
				<p>Manually sets shipping data without querying a database table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_shipping(shipping_data, recalculate_cart)</code>
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
							<td>shipping_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the data that is to update the carts shipping data.<br/>
								See the documentation and examples below for further information.									
							</td>
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
					<p>The function loops through the 'shipping_data' array and sets any data from the following array keys to the cart shipping data.</p>
					<p>The valid array keys are 'id', 'value', 'tax_rate' 'name' and 'description'.</p>
					<ul>
						<li><strong>'id'</strong> - The id to reference the shipping option by when updating shipping.</li>
						<li><strong>'value'</strong> - The value of the shipping option. Submitted values must be numeric.</li>
						<li><strong>'tax_rate'</strong> - Tax rate applied to the shipping rate, the carts tax value is used if no value is submitted. Submitted values must be numeric.</li>
						<li><strong>'name'</strong> - The name of the shipping option.</li>
						<li><strong>'description'</strong> - The description of the shipping option.</li>
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
$shipping_data = array(
	'id' => 'example_id',
	'value' => 4.95, <span class="comment">// &pound;4.95</span>
	'tax_rate' => 20, <span class="comment">// 20% tax</span>
	'name' => 'Example Shipping Option',
	'description' => 'Example Description'
);

$this->flexi_cart->set_shipping($shipping_data);
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